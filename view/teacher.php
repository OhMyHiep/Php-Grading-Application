<?php
session_start();
if(!isset($_SESSION["userType"])){
   header("location: index.php?signedIn=false");
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Teacher Capstone</title>
</head>
<body>
    <h1>Teacher Page</h1>
    <a href="logout_inc.php">
        <input type="button" value="Logout"></input>
    </a><br>

    <a href="assignments.php">
        <input type="button" value="Create New Assignment"></input>
    </a><br>

    <a href="view_created_assignments_inc.php">
        <input type="button" value="View Assignment"></input>
    </a><br>

</body>
</html>