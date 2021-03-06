<?php include 'database.php'; ?>

<?php

if (isset($_POST['tags'])) {
	$tags = explode("|", $_POST['tags']);
	$numOfTags = count($tags);
	$query = "SELECT video_id, 
			    SUM(CASE WHEN video_id=video_id THEN 1 ELSE 0 END) AS hits 
			    FROM (
			        SELECT videos.id AS video_id, tags.name AS tag FROM relations
			            JOIN videos
			            ON relations.video_id = videos.id
			            JOIN tags
			            ON relations.tag_id = tags.id
			            WHERE ";

	for ($i=0; $i < $numOfTags - 1; $i++) { 
		$query.="tags.name = ? OR ";
	};
	$query.="tags.name = ?
			) AS results
		    GROUP BY video_id 
		    ORDER BY hits 
		    DESC;";

	$types = "";
	$params = array();
	for ($i=0; $i < $numOfTags; $i++) { 
		$types.="s";
		array_push($params, $tags[$i]);
	};

	$stmt = mysqli_prepare($conn, $query);
	call_user_func_array( "mysqli_stmt_bind_param", array_merge(array($stmt, $types), refValues($params)));

	mysqli_stmt_execute($stmt);
    mysqli_stmt_bind_result($stmt, $result, $hits);

    $video_ids = array();
    while (mysqli_stmt_fetch($stmt)) {
    	array_push($video_ids, $result);
    };
    mysqli_stmt_close($stmt);

    echo '<ul id="videoResults">';
    foreach ($video_ids as $id) {
		$query = "SELECT tag AS tags 
					FROM(
				        SELECT videos.id AS video_id, 
				            tags.name AS tag 
				            FROM relations
				            JOIN videos
				            ON relations.video_id = videos.id
				            JOIN tags
				            ON relations.tag_id = tags.id
				        ) AS results 
					WHERE video_id =".$id.";";
		$stmt = mysqli_query($conn, $query);
		echo '<li class=videoResult><h3>File ID: '.$id.'</h3><h4>Tags:</h4><ul class="tagResults">';
		while( $row = mysqli_fetch_assoc($stmt) ){
			echo '<li class="tagResult">'.$row['tags']."</li>";
		};
		echo "</ul></li>";
	}
	echo '</ul><div style="clear: both"></div>';




    mysqli_close($conn);
}

// erase any HTML tags and then escape all quotes
function sanitizeMySQL($conn, $var) {
    $var = strip_tags($var);
    $var = mysqli_real_escape_string($conn, $var);
    return $var;
}

// Following function courtesty of bitWorking (http://stackoverflow.com/users/1948627/bitworking)
function refValues($arr){
    if (strnatcmp(phpversion(),'5.3') >= 0) //Reference is required for PHP 5.3+
    {
        $refs = array();
        foreach($arr as $key => $value)
            $refs[$key] = &$arr[$key];
        return $refs;
    }
    return $arr;
}
// End courtesy

?>