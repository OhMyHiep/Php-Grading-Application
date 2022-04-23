<?php

class FindTeacher extends Dbh{

    private $tName;

    //Pre: user inputs teacher's name; $tName
    //Post: FindTecher obj created wit input as attribute
    public function __construct($tName){
        $this->tName=$tName;
       // echo "constructed";
    }

     //Pre: user inputs teacher's name; $tName
     //Post: returns an associative array of teacher's information
    public function getTeacherID(){
        $sql = "SELECT * FROM `Teacher` WHERE `last_name`=?;";
        $stmt=$this->connect()->prepare($sql);
        try{
            if($stmt->execute(Array($this->tName))&& $stmt->rowCount()>0){
               // var_dump($stmt->fetchAll());
                return $stmt->fetchAll();
            }
            else{
                echo "teacher not found";
            }
        }catch(Exception $e){
            print "Error: ".$e->getMessage()."<br/>";
            die();
        }
    }

}