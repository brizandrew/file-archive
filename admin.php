<?php include 'database.php'; ?>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name=viewport content="width=device-width, initial-scale=1">
    <title>File Archive Admin</title>
    <link rel="stylesheet" href="css/style.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.4/jquery.min.js"></script>
    <script src="js/admin.js"></script>
</head>
<?php
    if (isset($_POST['password'])) :
        if($_POST['password'] == ""):
            $query = "SELECT * FROM requests";
            $requests = mysqli_query($conn, $query);
?>

<!DOCTYPE html>
<body>
<div id="container">
    <h1>File Admin</h1>
    <h5>Requests</h5>
        <div id="adminRequests">
            <form id="handleRequestForm" method="post" action="admin.php" >
                <table>
                    <tr>
                        <th>Tag</th>
                        <th>File ID</th>
                        <th>Requester</th>
                        <th>Approve</th>
                        <th>Decline</th>
                    </tr>
                    <?php while( $row = mysqli_fetch_assoc($requests) ) :  ?>
                    <tr id="<?php echo $row['id']; ?>">
                        <td class="leftAlign"><?php echo stripslashes($row['tag']); ?></td>
                        <td><?php echo $row['video_id']; ?></td>
                        <td class="leftAlign"><?php echo stripslashes($row['requester']); ?></td>
                        <td>
                            <button type="button" name="<?php echo $row['tag']; ?>" boolean="true" id="<?php echo $row['id']; ?>" videoId="<?php echo $row['video_id']; ?>">&#10003;
                            </button>
                        </td>
                        <td>
                            <button type="button" name="<?php echo $row['tag']; ?>" boolean="false" id="<?php echo $row['id']; ?>" videoId="<?php echo $row['video_id']; ?>">X
                            </button>
                        </td>
                    </tr>
                <?php endwhile;  ?>
                </table>
            </form>
        </div>
    <div id="gap" style="height:25px"></div>
    <h5>New Tag</h5> 
    <form id="newTagForm" method="post" action="admin.php" >
        <label for="tagName">Tag Name: </label>
        <input type="text" name="tagName" id="tagName" maxlength="50" required>
        <input type="submit" id="submit" value="Submit">
    </form>
    <div id="gap" style="height:5px"></div>
    <div id="newTagFormResult"></div>
    <div id="gap" style="height:20px"></div>
    <h5>All Tags</h5>    
    <div id="allTags">
    </div>
    <div style="clear: both"></div>
</div> <!-- close container -->
</body>
</html>

<?php
    else: //if arrived by post but input wrong password
?>

<body>
<div id="container">
    <h1>Invalid Password</h1>
</div>
</body>

<?php
    endif;
    else: //if didn't arrive by post
?>

<body>
<div id="container">
    <h1>404: Page Not Found</h1>
</div>
</body>

<?php
    endif;
?>
