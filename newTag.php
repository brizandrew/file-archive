<?php include 'database.php'; ?>

<?php

if (isset($_POST['tagName'])) {
	$tagName = $_POST['tagName'];

	$query = "INSERT INTO tags(name) VALUES(?)";
	$stmt = mysqli_prepare($conn, $query);
    mysqli_stmt_bind_param($stmt, 's', $tagName);
    mysqli_stmt_execute($stmt);
	mysqli_stmt_close($stmt);
	mysqli_close($conn);

	echo '"'.$tagName.'" succesfully added.';
}

function sanitizeMySQL($conn, $var) {
    $var = strip_tags($var);
    $var = mysqli_real_escape_string($conn, $var);
    return $var;
}

?>