<?php
        $con = mysqli_connect("localhost", "root", "", "bookshelf");

        if (!$con) {
            die('Could not connect: ' . mysqli_error());
        }

        if($_SERVER['REQUEST_METHOD'] === 'POST'){
            // Do whatever you want when POST request came in
            // Escape special characters, if any
            $genre = mysqli_real_escape_string($con, $_POST['genre']);
        
            $result = mysqli_query($con, "SELECT * FROM book WHERE genre='$genre'");
            if (mysqli_num_rows($result) > 0) {
                echo "<table><tr><th>Title</th><th>Author</th><th>Genre</th><th>Rating</th><th>Status</th></tr>";
                while($row = mysqli_fetch_array($result)){
                    echo "<td>" . $row['title'] . "</td>";
                    echo "<td>" . $row['author'] . "</td>";
                    echo "<td>" . $row['genre'] . "</td>";
                    echo "<td>" . $row['rating'] . "</td>";
                    echo "<td>" . $row['status'] . "</td>";
                    echo "</tr>";
                }
                echo "</table>";
            } else {
                echo "<h2 style=\" font-weight: bold; text-transform: uppercase;\">";
                echo "There are no recorded books of this genre!";
                echo "</h2>";
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

    <div class="filter-genre book-container">
        
        <form class="form" method="POST" action="filtergenre.php">
        <?php
            $con = mysqli_connect("localhost", "root", "", "bookshelf");

            if (!$con) {
                die('Could not connect: ' . mysqli_error());
            }

            $result = mysqli_query($con, "SELECT DISTINCT book.genre FROM book");
            if (mysqli_num_rows($result) > 0) {
                echo "<div style=\"text-align: center;\"><label for=\"genres\"><b>Coose Genre: </b></label><select id=\"b-genre\" name=\"genre\">";
                while($row = mysqli_fetch_array($result)){
                    echo "<option>" . $row['genre'] . "</option>";
                    echo "</tr>";
                }
                echo "</select></div>";
            } else {
                echo "Error: " . $sql . "<br>" . mysqli_error($con);
            } 

            mysqli_close($con);
        ?>
            <br>
            <input class="button" type="submit" name="filter" value="Filter" style="width: 150px;"/>
            <input class="button" type="button" value="Return" onclick="window.location.href = 'Lab6_HW.php';" style="width: 150px;"/>

        </form>
                
    </div>

</body>

</html>