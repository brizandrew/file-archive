<?php include 'database.php'; ?>

<?php
	$query = "SELECT id FROM videos ORDER BY ID DESC LIMIT 1";
	$stmt = mysqli_query($conn, $query);
	$row = mysqli_fetch_assoc($stmt);
	$result = $row['id'];
	mysqli_close($conn);
	echo $result;
?>