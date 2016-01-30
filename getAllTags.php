<?php include 'database.php'; ?>

<?php
	$query = "SELECT name FROM tags ORDER BY name";
	$stmt = mysqli_query($conn, $query);
	$results = array();
	while( $row = mysqli_fetch_assoc($stmt) ){
		array_push($results, $row['name']);
	};
	mysqli_close($conn);
	echo json_encode($results);

?>