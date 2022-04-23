<?php

class AssignGradersModel extends Dbh{

    //Pre: need to insert peer graders into database
    //Post: create AssignGradersModel obj
    public function __construct(){
       // echo "getting students";
    }

    //Pre: need students who submitted the assignment
    //Post: returns associtive array of students from database
    private function getStudents($crtedAssignId){
        $sql= "SELECT student_ID FROM `Uploaded_Assignment` WHERE created_assigment_ID = ?;";

        $stmt=$this->connect()->prepare($sql);
        $stmt->execute(Array($crtedAssignId));
        $result=$stmt->fetchAll();
        $stmt=null;
        return $result;
    }

    //Pre: need to insert peer graders into database
    //Post: randomize students and assign them to be a grader
    public function assignGraders(){
        session_start();
        $students= $this->getStudents($_SESSION["crtedAsignID"]);
        $sortedKeys=array_keys($students);
        $max = count($sortedKeys);
        $done = false;
        $numbers=$sortedKeys;
        while(!$done){
            shuffle($numbers);
            $done = true;
            for($i=0;$i<$max;$i++){
                if($sortedKeys[$i] == $numbers[$i]){
                    $done = false;
                    break;
                }
            }
        }
        $sql="UPDATE `Uploaded_Assignment` SET `peer_ID` = ? WHERE student_ID=? AND created_assigment_ID=?;";
        $stmt=$this->connect()->prepare($sql);
        for($i=0;$i<count($numbers);$i++){
            $theStudent=$students[$sortedKeys[$i]]["student_ID"];
            $peer=$students[$numbers[$i]]["student_ID"];
            $stmt->execute(Array($peer,$theStudent,$_SESSION["crtedAsignID"]));
        }
    }


}