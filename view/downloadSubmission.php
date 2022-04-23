<?php

//script for teacher to download student submissions
include "../model/Dbh.php";
include "../model/Submission.php";
$submissionId=$_GET["submissionID"];
$name=$_GET["name"];
$title=end(explode("|",$_GET["title"]));
$sub= new Submission();
$result=$sub->getSubmissionById($submissionId);
//var_dump($result);
$fileName=$name."_".$title;
$location=$result[0]["location"];
$contents=file_get_contents($location);
$type=mime_content_type($location);
//echo $location, $fileName;

header("Content-type: $type");
header("Content-Disposition: attachment; filename=$fileName");
ob_clean();
flush();
echo $contents;
