<?php

//script to get the rubric
include "../model/Dbh.php";
include "../model/GetRubricModel.php";

$obj=new GetRubricModel();
$rubric=$obj->getRubric();
$questNum=array();
echo '<p>The Rubric <p>';
//display the rubric with radio buttons
if($rubric!=null){
    session_start();
    echo '<form method="POST" Action="uploadAssessment_inc.php">';
    for($i=0;$i<count($rubric);$i++){
        echo "<br>";
        if(in_array($rubric[$i]["question_number"],$questNum)){
        echo '<input type="radio" id="student" name="ans['.$rubric[$i]["question_number"].']" value="'.$rubric[$i]["grade"].','.$rubric[$i]["Choice_ID"].'"></input><label for="student">'.$rubric[$i]["statement"].'</label>'; 
        }
        else{
            $questNum[$i]=$rubric[$i]["question_number"];
            echo "question: ".$rubric[$i]["Question_statement"]."<br>";
            echo '<input type="radio" id="student" name="ans['.$rubric[$i]["question_number"].']" value="'.$rubric[$i]["grade"].','.$rubric[$i]["Choice_ID"].'"></input><label for="student">'.$rubric[$i]["statement"].'</label>'; 
        }
    }
    echo '<br><input type="submit" name="submit" value="Submit">';
    echo '</form>';
    $_SESSION["questNum"]=$questNum;
}
