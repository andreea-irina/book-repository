<?php

$con = mysqli_connect("localhost", "root", "", "bookshelf");
if (!$con) {
    die('Could not connect: ' . mysqli_error());
}

$id = $_POST['id'];
    
$sql="DELETE FROM book WHERE id = '$id'";
mysqli_query($con,$sql);

mysqli_close($con);
?>