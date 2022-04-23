<?php
session_start();
if(!isset($_SESSION["userType"])){
    header("location: index.php?signedIn=false");
}

//script to create new assignment
$teacherID=$_SESSION["userID"];

include "../model/Dbh.php";
include "../model/AssignmentModel.php";
include "../controller/AssignmentController.php";


$title=$_POST["title"];
$des=$_POST["des"];
$dd=$_POST["dd"];
$fileName = $_FILES['myfile']['name'];
$filePath=$_FILES["myfile"]["tmp_name"];
$fileSize = $_FILES['myfile']['size'];
$exp = explode(".", $fileName);
$ext = end($exp);
$title = date("Y-m-d h-i-s")."|".$title;
$destination = "/Applications/XAMPP/xamppfiles/temp/".$title;

$asgn=new AssignmentController($title,$dd,$des,$filePath,$destination);
$asgn->createHW();//?'true'."<br>":'false'."<br>";

header("location: assignments.php?success");
