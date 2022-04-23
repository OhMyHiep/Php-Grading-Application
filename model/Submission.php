<?php

class Submission extends Dbh{

    //Pre: need a list of students and their submissions, has created assigment id
    //Post: students and their submissions returned as associtive array
   public function getSubmission($asignID){
        $sql = 'SELECT s.first_name,s.last_name,ca.title, ua.uploaded_assignment_ID, ua.peer_ID ,ua.peer_grade, ua.location FROM `Uploaded_Assignment` ua JOIN `Created_Assignments` ca ON ua.created_assigment_ID = ca.created_assignment_ID JOIN `Student` s ON s.student_ID = ua.student_ID WHERE ca.created_assignment_ID=?;';
        
        try{
            $stmt=$this->connect()->prepare($sql);
            $stmt->execute(Array($asignID));
            $result=$stmt->fetchAll();
            //echo "hey";
            //var_dump($result);
            $stmt=null;
           return $result;
           
        }catch(Exception $e){
             print "Error: ".$e->getMessage()."<br/>";
            die();
        }
       // echo $sql;
    }    

    //Pre: need the specific student, has the student id
    //Post: returns associtive array of the student
    public function getGrader($graderID){
        $sql="SELECT first_name,last_name FROM `Student` WHERE student_ID = ?;";
        try{
            $stmt=$this->connect()->prepare($sql);
            $stmt->execute(Array($graderID));
            $result=$stmt->fetchAll();
            //var_dump($result);
            $stmt=null;
           return $result;
        }catch(Exception $e){
             print "Error: ".$e->getMessage()."<br/>";
            die();
        }   
    }

    //Pre: need a specific submission, has the submission id
    //Post: return submission in associtive array
    public function getSubmissionById($submissionId){
        $sql="SELECT * FROM `Uploaded_Assignment` WHERE uploaded_assignment_ID = ?;";
        $stmt=$this->connect()->prepare($sql);
        $stmt->execute(Array($submissionId));
        $result=$stmt->fetchAll();
        $stmt=null;
        return $result;
    }
}


?>