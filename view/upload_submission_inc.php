<?php

//Script to upload an assigment
session_start();
$created_assignment_ID=$_SESSION["AssignmentID"];
$student_ID=$_SESSION["userID"];


include "../model/Dbh.php";
include "../model/HomeworkModel.php";
include "../controller/HomeworkController.php";

$fileName = $_FILES['myfile']['name'];
$filePath=$_FILES["myfile"]["tmp_name"];
$fileSize = $_FILES['myfile']['size'];
$exp = explode(".", $fileName);
$ext = end($exp);

$hw= new HomeworkController($student_ID,$created_assignment_ID,$filePath);
$hw->upload();

header("location: uploadSubmission.php?ID=".$created_assignment_ID."&title=".$_SESSION["hwTitle"]);


?>