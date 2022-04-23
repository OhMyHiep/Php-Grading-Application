<?php
class RegisterModel extends Dbh{

    //Pre: ipnuts to insert new user validated
    //Post: user inserted into database
    protected function setUser($firstName,$lastName,$username,$pwd,$userType){
        $this->setLogin($username,$pwd);
        $sql;
        $id=$this->getUserID($username);
        if($userType=="teacher"){
            $sql="INSERT INTO `Teacher` (`teacher_ID`, `first_name`, `last_name`, `login_ID`, `userType`) VALUES (NULL,?,?,?,?);";
        }
        else{
            $sql="INSERT INTO `Student` (`student_ID`, `first_name`, `last_name`, `login_ID`, `userType`) VALUES (NULL,?,?,?,?);";
        }
        //echo $id;
        $stmt=$this->connect()->prepare($sql);
        if(!$stmt->execute(array($firstName,$lastName,$id,$userType))){
            $stmt=null;
            header("location: ../view/index.php?error=failedSetUser");
            exit();
        }
    }
    
    //Pre: need the login id of the username
    //Post: returns id as an int
    protected function getUserID($username){
        $sql= "SELECT `login_ID` FROM `Login` WHERE `username`=?;";
        $stmt=$this->connect()->prepare($sql);
        if(!$stmt->execute(array($username))){
            $stmt=null;
            header("location: ../view/index.php?error=failedGetID");
            exit();
        }
        else{
            $result=$stmt->fetchAll();
            $id=(int)$result[0]["login_ID"];
        }
        $stmt=null;
        //echo gettype($id)."<br>";
        //echo $id;
        return $id;
    }

    //Pre: has username and password
    //Post: insert the username and password into database
    private function setLogin($username,$pwd){
        $hashedPwd=password_hash($pwd,PASSWORD_DEFAULT);
        $sql="INSERT INTO `Login` (`login_ID`, `username`, `password`) VALUES (NULL, ?, ?);";
        $stmt=$this->connect()->prepare($sql);
        if(!$stmt->execute(array($username,$hashedPwd))){
            $stmt=null;
            header("location: ../view/index.php?error=failedSetLogin");
            exit();
        }
    }
    

}

