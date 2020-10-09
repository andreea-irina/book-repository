<?php

$con = mysqli_connect("localhost", "root", "", "bookshelf");
if (!$con) {
    die('Could not connect: ' . mysqli_error());
}

$id = $_POST['id'];

// $sql="SELECT * FROM book WHERE id = '$id'";
// mysqli_query($con,$sql);
// $row = mysqli_fetch_array($sql,MYSQLI_ASSOC);

// echo $row['status'];    

$sql="UPDATE book SET 'status'='lent' WHERE id = '$id'";
mysqli_query($con,$sql);

    
mysqli_close($con);
?>
