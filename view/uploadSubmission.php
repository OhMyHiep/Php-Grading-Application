<?php
session_start();
if(!isset($_SESSION["userType"])){
    header("location: index.php?signedIn=false");
    exit;
}
$id=$_GET["ID"];
$_SESSION["AssignmentID"]=$id;
$title=$_GET["title"];
$_SESSION["hwTitle"]=$title;
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Upload Assignment Page</title>
</head>
<body>
    <?php
    echo "<p> ".$title.": <p>";
    ?>
    <a href="gradePeer.php">
        <input type="button" value="Grade Peer"></input>
    </a><br>
    <?php
    echo "<a href='downloadAsgnDes.php".$asignID."'> Download Assignment Description</a>";
    
    ?>
<p> Submit Your Assignment<p>
    <form action="upload_submission_inc.php?" enctype="multipart/form-data" method="POST">
        <input type="file" name="myfile"/><br>
        <input type="submit" name="submit" value="Submit"><br>
    </form>


</body>
</html>