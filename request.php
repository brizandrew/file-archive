<?php include 'database.php'; ?>

<?php


if (isset($_POST['videoId_Request'])  && isset($_POST['tags_Request']) && isset($_POST['requester_Request'])) {
	$videoId = sanitizeMySQL($conn, $_POST['videoId_Request']);
	$tags = explode(",",sanitizeMySQL($conn, $_POST['tags_Request']));
	$requester = sanitizeMySQL($conn, $_POST['requester_Request']);

	foreach ($tags as $tag) {
		$query = "INSERT INTO requests(video_id, requester, tag) VALUES(?, ?, ?)";
		$stmt = mysqli_prepare($conn, $query);
	    mysqli_stmt_bind_param($stmt, 'iss', 
	    	$videoId,
	    	$requester,
	    	$tag
	    );
	    mysqli_stmt_execute($stmt);
		mysqli_stmt_close($stmt);
	}

	mysqli_close($conn);	
	echo "Your request for the addition of the following tags has been submitted:<ul>";
	foreach ($tags as $tag) {
		echo "<li>".stripcslashes($tag)."</li>";
	}
	echo"</ul>";
	echo"<p id='resetRequestForm' onclick='resetRequestForm()'>Submit Another Request</p>";
}

function sanitizeMySQL($conn, $var) {
    $var = strip_tags($var);
    $var = mysqli_real_escape_string($conn, $var);
    return $var;
}

?>