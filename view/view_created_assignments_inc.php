<?php
//script to get created assigments of the teacher
session_start();
if(!isset($_SESSION["userType"])){
   header("location: index.php?signedIn=false");
   exit;
}

include "../model/Dbh.php";
include "../model/GetCrtedAsgmt.php";

$test= new GetCrtedAsgmt($_SESSION["userID"]);
$result=$test->getAsgnByTchrID();

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>View Created Assignments</title>
</head>
<body>
    <h1> Assigments You've Assigned</h1>
    <?php
    //display the assigments
        echo "<table border='1'>";
        for($i=0;$i<count($result);$i++){
            $asignID=$result[$i]["created_assignment_ID"];
            $temp= $result[$i]["title"];
            $boom= explode("|",$temp);
            $title= end($boom);
            $dd=$result[$i]["due_date"];
            $des= $result[$i]["description"];
            echo $asignID==null;
            echo "<tr style='cursor: pointer; cursor: hand;'>
                <th> <a href='view_submissions.php?ID=".$asignID."'> ".$title."</a></th>
                </tr>";
        }
        echo "</table>";
    ?>

</body>
</html>








