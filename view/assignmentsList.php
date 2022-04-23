<?php
session_start();
if(!isset($_SESSION["userType"])){
    header("location: index.php?signedIn=false");
    exit;
}
$tName=$_POST["name"];
$_SESSION["teacherName"]=$tName;
include "../model/Dbh.php";
include "../model/FindTeacher.php";
include "../model/GetCrtedAsgmt.php";
$test= new FindTeacher($tName);
$teacher=$test->getTeacherID();
$id=$teacher[0]["teacher_ID"];
$hw= new GetCrtedAsgmt($id);
$result=$hw->getAsgnByTchrID();
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Your Homework</title>
</head>
<body>
    <h1>Your Homework</h1>
<?php
     //webpage to display list of assignments for students
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
                <th> <a href='uploadSubmission.php?ID=".$asignID."&title=".$title."'> ".$title."</a></th>
                </tr>";
        }
        echo "</table>";
    ?>
</body>
</html>