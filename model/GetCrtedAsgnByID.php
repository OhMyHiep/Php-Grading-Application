<?php

class GetCrtedAsgnByID extends Dbh{

    //Pre: need get an assignment that was created by teacher
    //Post: GetCrtedAsgnByID obj created
    public function __construct(){
       // echo "hw des";
    }

    //Pre: has the created assigment id
    //Post: returns the assignment in an associtive array
    public function getAssigment($created_assigment_ID){
        $sql="SELECT * FROM `Created_Assignments` WHERE `created_assignment_ID`=?;";
        $stmt=$this->connect()->prepare($sql);
        $stmt->execute(array($created_assigment_ID));
        $result=$stmt->fetchAll();
        return $result;
    }



}