<?php

class LoginController extends LoginModel{
    private $username;
    private $pwd;

     //Pre; user submited inputs to login
     //Post: LoginController obj created with username and password as attributes
    public function __construct($username,$pwd){
        $this->username=$username;
        $this->pwd=$pwd;
    }

    //Pre; user submited inputs to login
    //Post: validate inputs and logs user in if valid
    public function loginUser(){
        if($this->validChar() && $this->notEmpty() && $this->validPwd() && $this->validUsername()){
            $userArray=$this->getUser($this->username);
            session_start();
        
            $_SESSION["username"]=$this->username;
            //echo "username set<br>";
            $_SESSION["userType"]=$userArray[0]["userType"];
            
            if (array_key_exists("student_ID",$userArray[0])){
                $_SESSION["userID"]= $userArray[0]["student_ID"];
            }
            else{
                $_SESSION["userID"]=$userArray[0]["teacher_ID"];
            }
        }
        else{
            header("location: ../view/index.php?error=invalidIputs");
            exit();
        }
    }

    //Pre; user submited inputs to login
    //Post: return false if there are invalide characters else return true
    private function validChar(){
        $result;
        if (!preg_match("/^[a-zA-Z0-9.]*$/",$this->username)){
            $result=false;
        }
        else{
            $result=true;
        }
        return $result;
    }

    //Pre; user submited inputs to login
    //Post: return false if input field is empty else return true
    private function notEmpty(){
        $result;
        if (empty( $this->username) || empty($this->pwd)){
            $result=false;
        }
        else{
            $result=true;
        }
        return $result;
    }

    //Pre: user submited inputs to login
    //Post: returns true/false if password matches or doesn't match the one in database
    private function validPwd(){
        $loginArray=$this->getLogin($this->username);
        return password_verify($this->pwd,$loginArray[0]["password"]);
    }

    //Pre: user submited inputs to login
    //Post: returns true if username match the one in the database else false
    private function validUsername(){
        $loginArray=$this->getLogin($this->username);
        return $loginArray[0]["username"]==$this->username;
    }


}