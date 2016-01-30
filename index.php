<?php include 'database.php'; ?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name=viewport content="width=device-width, initial-scale=1">
    <title>File Archive</title>
    <link rel="stylesheet" href="css/style.css">
    <link rel="stylesheet" href="js/jquery-ui/jquery-ui.min.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.4/jquery.min.js"> </script>
	<script src="js/jquery-ui/jquery-ui.min.js"></script>
    <script src="js/Tag.js"></script>
    <script src="js/main.js"></script>
</head>

<body>
<div id="container">

<h1>File Archive</h1>
<div id="tabs">
    <div id="retrieveTab" class="tab selectedTab"><h2>Lookup</h2></div>
    <div id="insertTab" class="tab"><h2>Archive</h2></div>
    <div style="clear: both"></div>
</div>
<br>

<div id="retrieveFormDesc" class="retrieve">
    <p>
        Welcome to the file footage lookup system. 
        Below you can insert search tags to narrow down the file results.
        Separate each tag with a comma.
        If your tag does not exist, you will receive an error.
        For a full list of tags click the "Browse" button.
    </p>
</div>

<div id="insertFormDesc" class="insert hide">
    <h3 id="videoId">File ID: ERROR!</h3>
    <p>
        Welcome to the file footage archive system.
        Please save your file on the server with the file ID shown above.
        Below you can insert search tags that apply to your file.
        Separate each tag with a comma.
        If your tag does not exist, you will receive an error.
        To request that a new tag be added click the "Request Tag" button.
        For a full list of tags click the "Browse" button.
    </p>
</div>
  
<div id="tagsLabel">Type tags (seperate by comma)</div>
<br>
<div id="inputField">
    <div id="enteredTags"></div>
    <input id="insertTags" type="text" name="tags" id="tags" autocomplete="off" maxlength="20">
</div>
<br>

<button id="displayAllTags">Browse</button>
<div id="retrieveFormDiv" class="retrieve">
    <form id="retrieveForm" class="submitForm" method="post" action="index.php">
        <input type="submit" id="submit" value="Submit">
    </form>
</div>

<div id="insertFormDiv" class="insert hide">
    <form id="insertForm" class="submitForm" method="post" action="index.php">
        <input type="submit" id="submit" value="Submit">
    </form>
    <button id="requestTag">Request Tag</button>
</div>
<div style="clear: both"></div>

<div id="formResults">
</div>

<div style="clear: both"></div>

<div id="allTags" class="hide">
    <h3>All Tags</h3>
</div>

<div style="clear: both"></div>

<div id="errorAlert" class="hideOpacity">
    <img src="img/errorIcon.gif">
    <p>Error!</p>
</div>
<div id="adminLogin">Admin Login</div>
</div> <!-- close container -->



<div id="requestTagContainer" class="hide">
    <div id="requestTagFormContainer">
        <div class="X" id="closeRequestTag">X</div>
        <h1>Request Tag</h1>
        <form id="requestTagForm" method="POST" action="admin.php">
            <label for="videoId_Request">Video ID </label>
            <input type="number" name="videoId_Request" id="videoId_Request" max="9999" step="1" required>

            <label for="requester_Request">Your Name </label>
            <input type="text" name="requester_Request" id="requester_Request" maxlength="50" required>

            <label for="tags_Request">Tag(s) </label>
            <p>Separate multiple tags with a comma</p>
            <input type="text" name="tags_Request" id="tags_Request" required>
          
            <input type="submit" id="submit" value="Submit">
        </form>
        <div id="requestFormResult" class="hide">
        </div>
    </div>
</div>

<div id="adminLoginContainer" class="hide">
    <div id="adminLoginFormContainer">
        <div class="X" id="closeAdminLogin">X</div>
        <h1>Admin Login</h1>
        <form id="adminLoginForm" method="POST" action="admin.php">
            <label for="password">Password </label>
            <input type="password" name="password" id="password" required>
          
            <input type="submit" id="submit" value="Submit">
        </form>
    </div>
</div>


</body>
</html>
