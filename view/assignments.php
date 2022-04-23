<?php
session_start();
if(!isset($_SESSION["userType"])){
   header("location: index.php?signedIn=false");

   //webpage to  creat new assigments assignments
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Create Assignment</title>
</head>
<body>
    <h1>New Assignment</h1>
    <a href="Teacher.php">
        <button>Home</button>
    </a>

    <form action="assignment_inc.php" enctype="multipart/form-data" method="POST">
        <input type="text" name="title" placeholder="Title"><br>
        <input type="text" name="des" placeholder="Description"><br>
        <input type="date" name="dd" placeholder="Due Date">Due Date<br>
        <input type="file" name="myfile"/><br>
        <input type="submit" name="submit" value="Create"><br>
    </form>
</body>
</html>
