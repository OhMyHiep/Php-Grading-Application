<?php

//script to download assigment description
session_start();
$created_assignment_ID=$_SESSION["AssignmentID"];

include "../model/Dbh.php";
include "../model/GetCrtedAsgnByID.php";

$hw=new GetCrtedAsgnByID();
$result= $hw->getAssigment($created_assignment_ID);
$fileName=$result[0]["title"];
$location=$result[0]["location"];
$contents=file_get_contents($location);
$type=mime_content_type($location);
header("Content-type: $type");
header("Content-Disposition: attachment; filename=$fileName");
ob_clean();
flush();
echo $contents;