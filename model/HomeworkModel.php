<?php

class HomeworkModel extends Dbh{


    //Pre: inputs to upload an assignment are validated
    //Post: upload the submission of the student into database
    protected function uploadHW($student_ID,$created_assignment_ID,$filePath){
        $sql= "INSERT INTO `Uploaded_Assignment` (`uploaded_assignment_ID`, `peer_grade`, `peer_ID`, `student_ID`, `created_assigment_ID`, `location`) VALUES (NULL, NULL, NULL, ?, ?, ?);";

        $stmt= $this->connect()->prepare($sql);
        //echo $created_assignment_ID;
        try{
            $stmt->execute(Array($student_ID,$created_assignment_ID,$filePath));
            echo "stmt executed";
        }catch(Exception $e){
            print "Error: ".$e->getMessage()."<br/>";
            die();
        }
    }

    //Pre: inputs to upload an assignment are validated
    //Post: get previous version of the submission & call dropHw to remove it
    protected function removePreviousHw($student_ID,$created_assignment_ID){
        $sqlGetPrev="SELECT ua.uploaded_assignment_ID FROM `Uploaded_Assignment` ua JOIN `Created_Assignments` ca ON ua.created_assigment_ID = ca.created_assignment_ID JOIN `Student`s ON s.student_ID = ua.student_ID WHERE s.student_ID=? AND ua.created_assigment_ID=?;";

        $Getstmt= $this->connect()->prepare($sqlGetPrev);
        try{
            $Getstmt->execute(Array($student_ID,$created_assignment_ID));
            $prevHw=$Getstmt->fetchAll();
            $this->dropHw($prevHw[0]["uploaded_assignment_ID"]);
        }catch(Exception $e){
            print "Error: ".$e->getMessage()."<br/>";
            die();
        }
    }

    //Pre: has id of the a submission
    //Post: drop the submission from database
    private function dropHw($hwId){
        $sql="DELETE FROM `Uploaded_Assignment` WHERE `Uploaded_Assignment`.`uploaded_assignment_ID` =?;";
        $stmt= $this->connect()->prepare($sql);
       // echo "hw id: ".$hwId;
        $stmt->execute(Array($hwId));
        //echo "executed";
    }

}

