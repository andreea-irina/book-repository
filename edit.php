<?php

$con = mysqli_connect("localhost", "root", "", "bookshelf");
if (!$con) {
    die('Could not connect: ' . mysqli_error());
}

if($_SERVER['REQUEST_METHOD'] === 'POST'){
    // Do whatever you want when POST request came in
    // Escape special characters, if any
    $title = mysqli_real_escape_string($con, $_POST['title']);
    $author = mysqli_real_escape_string($con, $_POST['author']);
    $genre = mysqli_real_escape_string($con, $_POST['genre']);
    $rating = mysqli_real_escape_string($con, $_POST['rating']);

    $duplicate = mysqli_query($con, "SELECT * FROM book WHERE title='$title' AND author='$author'");
    if (mysqli_num_rows($duplicate) > 0) {
        echo "<h2 style=\" font-weight: bold; text-transform: uppercase; color: red;\">";
        echo "This book already exists in the bookshelf!";
        echo "</h2>";
    }
    else {
        $sql="UPDATE book SET title='$title', author='$author', genre='$genre', rating='$rating'";
        if (mysqli_query($con, $sql)) {
            echo "<h2 style=\" font-weight: bold; text-transform: uppercase;\">";
            echo "Book updated successfully";
            echo "</h2>";
        } else {
            echo "Error: " . $sql . "<br>" . mysqli_error($con);
        }   
    }
}

mysqli_close($con);
?>

<!DOCTYPE html>
<html>

<head>
<link rel="stylesheet" type="text/css" href="style.css">
</head>

<body>

<div class="edit book-container">

    <h2 style="color: whitesmoke; text-align: center; font-size: 200%;"> EDIT THIS BOOK</h2>
    <br>
    <form class="form" method="POST" action="edit.php">

        <label for="b-title"><b>Title of The Book</b></label>
        <input id="b-title" class="form-input" type="text" placeholder="Title..." name="title" required/>

        <label for="b-author"><b>Author of The Book</b></label>
        <input id="b-author" class="form-input" type="text" placeholder="Author..." name="author" required/>

        <label for="b-genre"><b>Genre of The Book</b></label>
        <input id="b-genre" class="form-input" type="text" placeholder="Genre..." name="genre" required/>

        <label for="b-rating"><b>Personal Rating</b></label>
        <input id="b-rating" class="form-input" type="text" placeholder="Rate me..." name="rating" required/>

        <br>
        <input class="button" type="submit" name="edit" value="Edit Book" style="width: 150px;"/>
        <input class="button" type="button" value="Return" onclick="window.location.href = 'index.php';" style="width: 150px;"/>

    </form>
    
</div>

</body>

</html>