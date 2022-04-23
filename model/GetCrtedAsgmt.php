<?php

class GetCrtedAsgmt extends Dbh{
    private $id;

    //Pre: need to get assignments created by the teacher
    //Post: GetCrtedAsgmt obj ceated with teacher's id as attribute 
    public function __construct($id){
      //echo "const";
      $this->id=$id;
    }

    //Pre: object with the the teacher's id initialized
    //Post: returns all assignments by that teacher in associtive array
    public function getAsgnByTchrID(){
        //session_start();
        $sql = "SELECT * FROM Created_Assignments WHERE teacher_ID=?;";
        $stmt=$this->connect()->prepare($sql);
        $stmt->execute(array($this->id));
        $result=$stmt->fetchAll();
        $stmt=null;
        return $result;
    }


    

}

?>