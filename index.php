<!DOCTYPE html>
<html>

<head>
	<meta charset="UTF-8">

	<script src="http://code.jquery.com/jquery-3.3.1.min.js"></script>
	<!-- DELETE A BOOK -->
	<script>
		$(document).ready(function(){
			$('table').on('click', '.btn.delete', function () {
				var tr = $(this).closest('tr');
                var del_id = $(this).val(); 
				
				if(confirm("Are you sure you want to delete this?")){
					$.ajax({
						url: 'delete.php',
						type: 'POST',
						data: { id:del_id },
						success:function(result){
							tr.fadeOut(400, function(){
								$(this).remove();
							});
						}
					});
				}
				else{
					return false;
				}
			});
		});
	</script>

	<!-- LEND A BOOK -->
	<script>
		$(document).ready(function(){
			$('table').on('click', '#lend', function () {
				var tr = $(this).closest('tr');
                var lend_id = $(this).val(); 
				
				$.ajax({
					url: 'lendbook.php',
					type: 'POST',
					data: { id:lend_id }
				});
			});
		});
	</script>

	<!-- RECOVER A BOOK -->
	<script>
		$(document).ready(function(){
			$('table').on('click', '#recover', function () {
				var tr = $(this).closest('tr');
                var rec_id = $(this).val(); 
				
				$.ajax({
					url: 'recoverbook.php',
					type: 'POST',
					data: { id:rec_id }
				});
			});
		});
	</script>

	<!-- EDIT A BOOK
	<script>
        $(document).ready(function(){
			$('table').on('click', '.btn.edit', function () {
				var tr = $(this).closest('tr');
                var edit_id = $(this).val();

                $.ajax({
						url: 'edit.php',
						type: 'POST',
						data: { id:edit_id }
					});
            });

        });
    </script> -->

	<link rel="stylesheet" type="text/css" href="style.css">

</head>

<body>
	<br>
	<h2><b>MY BOOK COLLECTION </b></h2>
	
	<div id="container"></div>

    <!-- GET ALL BOOKS -->
	<?php
		$con = mysqli_connect("localhost", "root", "", "bookshelf");
		if (!$con) {
			die('Could not connect: ' . mysqli_error());
		}

		$result = mysqli_query($con, "SELECT * FROM book");

		echo "<table><tr><th>Title</th><th>Author</th><th>Genre</th><th>Rating</th><th>Status</th><th></th></tr>";

		while($row = mysqli_fetch_array($result)){
			echo "<tr>";
			$id = $row['id'];
			echo "<td>" . $row['title'] . "</td>";
			echo "<td>" . $row['author'] . "</td>";
			echo "<td>" . $row['genre'] . "</td>";
			echo "<td>" . $row['rating'] . "</td>";
			echo "<td id=\"status\">" . $row['status'] . "</td>";
			echo "<td><button class=\"btn edit\" value=\"$id\" onclick=\"window.location.href = 'edit.php';\">Edit</button>";
			echo "<button class=\"btn lend\" id=\"lend\" value=\"$id\">Lend</button>";
			echo "<button class=\"btn recover\" id=\"recover\" value=\"$id\">Recover</button>";
			echo "<button class=\"btn delete\" value=\"$id\">Delete</button></td>";
			echo "</tr>";
		}
		echo "</table>";

		mysqli_close($con);
	?>

	<br>
	
	<div id="button-container">
		<input class="button add" type="button" value="Add Book" onclick="window.location.href = 'insert.php';"/>
		<input class="button browse" type="button" value="Browse Books By Genre" onclick="window.location.href = 'filtergenre.php';"/>
		<input class="button browse-author" type="button" value="Browse Books By Author" onclick="window.location.href = 'filterauthor.php';"/>
	</div>
</body>

</html>