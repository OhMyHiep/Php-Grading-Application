<?php

class UploadAssessmentModel extends Dbh{

    //Pre: need to upload assesment of peer
    //Post: insert assesment of peer into database
    protected function uploadAns($upldAsgnId,$choiceId){
        $sql="INSERT INTO `Answers` (`Uploaded_Assignment_ID`, `choice_ID`) VALUES ( ?, ?);";
        $stmt=$this->connect()->prepare($sql);
        $stmt->execute(Array($upldAsgnId,$choiceId));
    }

    //Pre: need to upload grade into database
    //Post: grade uploaded into database
    protected function uploadPeerGrade($grade,$upldAsgnId){
        $sql="UPDATE `Uploaded_Assignment` SET `peer_grade` = ? WHERE `uploaded_assignment_ID` = ?;";
        $stmt=$this->connect()->prepare($sql);
        $stmt->execute(Array($grade,$upldAsgnId));
    }

    //Pre: need id of a submission, has peer id & created assigment id
    //Post: returns submission id as an int
    protected function getAssigmentID(){
        session_start();
        $sql="SELECT ua.uploaded_assignment_ID FROM `Uploaded_Assignment` ua WHERE created_assigment_ID=? AND peer_ID=?;";
        $stmt=$this->connect()->prepare($sql);
        $stmt->execute(Array($_SESSION["AssignmentID"],$_SESSION["userID"]));
        $result=$stmt->fetchAll();
        //var_dump($result);
        $stmt=null;
        return (int)$result[0]["uploaded_assignment_ID"];
    }


}