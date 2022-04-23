<?php

//script to display filled out form of the rubric by the grader
include "../model/Dbh.php";
include "../model/StudentAssessmentModel.php";
$submissionID=$_GET["submissionID"];
$assessment= new StudentAssessmentModel();
$rubric=$assessment->getAssessment($submissionID);
echo $_GET["name"]."'s grade";
for($i=0;$i<count($rubric);$i++){
    echo "<br>".$rubric[$i]["question_number"].") ".$rubric[$i]["Question_statement"]."<br>";
    echo "&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;".$rubric[$i]["statement"]." (".$rubric[$i]["grade"]." points)";
}

