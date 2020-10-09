<?php

$con = mysqli_connect("localhost", "root", "", "bookshelf");
if (!$con) {
    die('Could not connect: ' . mysqli_error());
}

$id = $_POST['id'];

$sql="SELECT * FROM book WHERE id = '$id'";
mysqli_query($con,$sql);
$row = mysqli_fetch_array($sql);

if($row['status']=='lent') {
    $sql="UPDATE book SET 'status'='owned' WHERE id = '$id'";
    mysqli_query($con,$sql);
}
else {
    echo "<h2 style=\" font-weight: bold; text-transform: uppercase; color: red;\">";
    echo "This book has already been lent!";
    echo "</h2>";
}

    
mysqli_close($con);
?>