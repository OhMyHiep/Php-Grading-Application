<?php
class GetRubricModel extends Dbh{

    //Pre: need to get rubric
    //Post: make GetRubric obj
    public function __construct(){
        
    }

    //Pre: need to get rubric
    //Post: returns the rubric questions and multiple choice in associative array
    public function getRubric(){
        $sql="SELECT rb.question_number,rb.Question_statement,c.statement,c.Choice_ID,c.grade FROM `RubricQuestions` rb JOIN `Choices` c ON rb.question_ID = c.question_ID WHERE created_assignment_ID=? ORDER BY rb.question_number;";
        session_start();
        $stmt=$this->connect()->prepare($sql);
        $stmt->execute(Array($_SESSION["AssignmentID"]));
        $result=$stmt->fetchAll();
        $stmt=null;
        return $result;
    }



}