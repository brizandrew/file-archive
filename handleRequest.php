<?php include 'database.php'; ?>

<?php
if (isset($_POST['id']) && isset($_POST['name']) && isset($_POST['boolean']) && isset($_POST['videoId'])) {

	$id = $_POST['id'];
	$name = $_POST['name'];
	$boolean = $_POST['boolean'];
	$videoId = $_POST['videoId'];

	if($boolean == "true"){
		//add approved tag to tags table
		$query = "INSERT INTO tags(name) VALUES(?)";
		$stmt = mysqli_prepare($conn, $query);
	    mysqli_stmt_bind_param($stmt, 's', $name);
	    mysqli_stmt_execute($stmt);
		mysqli_stmt_close($stmt);

		//retrieve tag id
		$query = "SELECT id FROM tags ORDER BY ID DESC LIMIT 1";
		$stmt = mysqli_query($conn, $query);
		$row = mysqli_fetch_assoc($stmt);
		$tagId = $row['id'];

		//add tag to requested video
		$query = "INSERT INTO relations VALUES(?, ?)";
		$stmt = mysqli_prepare($conn, $query);
	    mysqli_stmt_bind_param($stmt, 'ii', $videoId, $tagId);
	    mysqli_stmt_execute($stmt);
		mysqli_stmt_close($stmt);

		//delete approved tag from requests table
		$query = "DELETE FROM requests WHERE id=?";
		$stmt = mysqli_prepare($conn, $query);
	    mysqli_stmt_bind_param($stmt, 'i', $id);
	    mysqli_stmt_execute($stmt);
		mysqli_stmt_close($stmt);

		echo $videoId.$tagId;

		mysqli_close($conn);

	}
	else if($boolean == "false"){
		//delete declined tag from requests table
		$query = "DELETE FROM requests WHERE id=?";
		$stmt = mysqli_prepare($conn, $query);
	    mysqli_stmt_bind_param($stmt, 'i', $id);
	    mysqli_stmt_execute($stmt);
		mysqli_stmt_close($stmt);
		mysqli_close($conn);
	}
}
?>