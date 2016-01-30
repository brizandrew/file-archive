<?php include 'database.php'; ?>

<?php

if (isset($_POST['tags'])) {


	//Insert a new video entry and bind its id to $video_id
	$query = "INSERT INTO videos VALUES (NULL)";
	$stmt = mysqli_prepare($conn, $query);
	mysqli_stmt_execute($stmt);
	$result = mysqli_query($conn, "SELECT id FROM videos ORDER BY ID DESC LIMIT 1");
	$row = mysqli_fetch_assoc($result);
	$video_id = $row['id'];
	mysqli_stmt_close($stmt);


	//Retrieve relevant tag IDs
    $tags = explode("|",sanitizeMySQL($conn, $_POST['tags']));
    $tag_ids = array();

	for ($i=0; $i < count($tags); $i++) { 
		$query = "SELECT id FROM tags WHERE name=?";
		$stmt = mysqli_prepare($conn, $query);
	    mysqli_stmt_bind_param($stmt, 's', stripslashes($tags[$i]));
	    mysqli_stmt_execute($stmt);
	    $result;
	    mysqli_stmt_bind_result($stmt, $result);
	    mysqli_stmt_fetch($stmt);
	    array_push($tag_ids, $result);
	    mysqli_stmt_close($stmt);
	};

	//Insert new relations entries
	foreach ($tag_ids as $tag_id) {
		$query = "INSERT INTO relations VALUES ($video_id, $tag_id)";
		$stmt = mysqli_prepare($conn, $query);
		mysqli_stmt_execute($stmt);
		mysqli_stmt_close($stmt);
	};

	mysqli_close($conn);
	//confirmation
	echo "The following video has been added:";
	echo '<ul id="videoResults">';
	echo '<li class=videoResult><h3>File ID: '.$video_id.'</h3><h4>Tags:</h4><ul class="tagResults">';
	foreach ($tags as $tag) {
		echo '<li class="tagResult">'.stripslashes($tag)."</li>";
	}
	echo '</ul></li></ul><div style="clear: both"></div>';
}

// erase any HTML tags and then escape all quotes
function sanitizeMySQL($conn, $var) {
    $var = strip_tags($var);
    $var = mysqli_real_escape_string($conn, $var);
    return $var;
}
?>