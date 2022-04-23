<?php

class StudentAssessmentModel extends Dbh{

    //Pre: need to get assessment of a student
    //Post: StudentAssessmentModel obj created
    public function __construct(){
        session_start();
        //var_dump($_SESSION);
    }

    //Pre: has submission id of student
    //Post: returns assessment in associative array
    public function getAssessment($submissionID){
        $sql="SELECT * FROM `RubricQuestions` rq JOIN `Choices` c ON rq.question_ID = c.question_ID JOIN `Answers` ans ON c.Choice_ID = ans.choice_ID WHERE rq.created_assignment_ID=? AND ans.Uploaded_Assignment_ID = ? ORDER BY rq.question_number;";

        $stmt=$this->connect()->prepare($sql);
        $stmt->execute(Array($_SESSION["crtedAsignID"],$submissionID));

        $result=$stmt->fetchAll();
        return $result;
        //var_dump($result);
    }


}