<?php
//script to get all submissions for an assigments
$crtedAsignID=$_GET["ID"];
include "../model/Dbh.php";
include "../model/Submission.php";
$sub=new Submission();
$result=$sub->getSubmission($crtedAsignID);
session_start();
$_SESSION["crtedAsignID"]=$crtedAsignID;

?>
<!DOCTYPE html>
<html lang="en">
<head>
   <meta charset="UTF-8">
   <meta http-equiv="X-UA-Compatible" content="IE=edge">
   <meta name="viewport" content="width=device-width, initial-scale=1.0">
   <title>Document</title>
</head>
<body>
   <h1>Student Submissions</h1>
   <a href="rubric.php" >
        <input type="button" value="Create Rubric"></input>
    </a><br>
    <a href="assignGraders.php">
        <input type="button" value="Assign Graders"></input>
    </a>
   <?php
   echo "<table border='1'>";
   if($result==null){
      echo "no Submissions";
   }
   else{
      for($i=0;$i<count($result);$i++){
         $name=$result[$i]["first_name"]." ".$result[$i]["last_name"];
         $title=$result[$i]["title"];
         $graderID=$result[$i]["peer_ID"];
         $grade=$result[$i]["peer_grade"];
         $submissionID=$result[$i]["uploaded_assignment_ID"];
         if($graderID!=null){
            $graderInfo=$sub->getGrader($graderID);
            $grader=$graderInfo[0]["first_name"]." ".$graderInfo[0]["last_name"];
         }
         else{
            $grader="";
         }
         //display all submissions
         echo "<tr style='cursor: pointer; cursor: hand;'>
            <th> Student: ".$name."</th>
            <th> <a href='downloadSubmission.php?submissionID=".$submissionID."&name=".$name."&title=".$title."'> ".$title."</a></th>
            <th>grader:".$grader." </th>
            <th>grade:".$grade."</th>
            <th><a href='viewStudentAssessment.php?submissionID=".$submissionID."&name=".$name."'>View Assesment</a></th>
            </tr>";
      }
   }
   echo "</table>";
   ?>
</body>
</html>