<?php

class LoginModel extends Dbh{

    //Pre: has username input
    //Post: returns an associtive array of the same username if it exist
    protected function getLogin($username){
        $sql= "SELECT * FROM `Login` WHERE `username`=?;";
        $stmt=$this->connect()->prepare($sql);
        echo "stmt login prep<br>";

        if(!$stmt->execute(array($username))){
            //echo "failed getlogin stmt";
            header("location: ../view/index.php?error=stmtFailed");
            exit();
        }
        elseif($stmt->rowCount()==0){
            //echo "user not found";
            header("location: ../view/index.php?error=invalidIputs");
            exit();
        }
        $loginArr=$stmt->fetchAll();
        $stmt=null;
        return $loginArr;
    }

    //Pre: need login information of user
    //Post: return login information as associtive array
    protected function getUser($username){
       // echo "getting user<br>";
        $id=$this->getLogin($username)[0]["login_ID"];
        //echo "pizza";
        $sqlTeacher= "SELECT * FROM `Teacher` WHERE `login_ID`=?;";
        $sqlStudent= "SELECT * FROM `Student` WHERE `login_ID`=?;";
        
        $stmtTeacher=$this->connect()->prepare($sqlTeacher);
        $userArray;
        //echo "execute t";
        if(!$stmtTeacher->execute(array($id))){
            //echo "error: stmt get teacher failed";
            header("location: ../view/index.php?error=stmtFailed");
            $stmtTeacher=null;
            exit();
        }
        elseif($stmtTeacher->rowCount()>0){
            $userArray=$stmtTeacher->fetchAll();
        }
        $stmtTeacher=null;

        $stmtStudent=$this->connect()->prepare($sqlStudent);
        if(!$stmtStudent->execute(array($id))){
            //echo "error: stmt get Student failed";
            header("location: ../view/index.php?error=stmtFailed");
            exit();
        }
        elseif($stmtStudent->rowCount()>0){
            $userArray=$stmtStudent->fetchAll();
        }
        $stmtStudent=null;

        return $userArray;
    }
    

}