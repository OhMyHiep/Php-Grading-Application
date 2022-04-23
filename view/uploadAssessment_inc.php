<?php

//Script to upload an assessment of peer
$ans=$_POST["ans"];

session_start();
include "../model/Dbh.php";
include "../model/UploadAssessmentModel.php";
include "../controller/UploadAssessmentController.php";


$obj=new UploadAssessmentController($ans);
$obj->uploadAssessment();

header("location: uploadSubmission.php?ID=".$_SESSION["AssignmentID"]."&title=".$_SESSION["hwTitle"]);