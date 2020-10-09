<?php
	$con = mysqli_connect("localhost", "root", "", "bookshelf");
	if (!$con) {
		die('Could not connect: ' . mysqli_error());
	}

	$result = mysqli_query($con, "SELECT * FROM book");

	echo "<table border='1'><tr><th>ID</th><th>Name</th><th>Password</th><th>Group_id</th></tr>";

	while($row = mysqli_fetch_array($result)){
		echo "<tr>";
		echo "<td>" . $row['id'] . "</td>";
		echo "<td>" . $row['title'] . "</td>";
		echo "<td>" . $row['author'] . "</td>";
		echo "<td>" . $row['genre'] . "</td>";
		echo "</tr>";
	}
	echo "</table>";
	mysqli_close($con);
?>