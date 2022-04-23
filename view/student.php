<?php
session_start();
if(!isset($_SESSION["userType"])){
    header("location: index.php?signedIn=false");
    exit;
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Student</title>
</head>
    <h1>Student Page</h1>
<body>
    <a href="logout_inc.php">
        <input type="button" value="Logout"></input>
    </a><br>

    <form action="assignmentsList.php" enctype="multipart/form-data" method="POST">
        <input type="text" name="name" placeholder="Teacher's Last Name"><br>
        <input type="submit" name="submit" value="search Assignments"><br>
    </form>    

</body>

</html>