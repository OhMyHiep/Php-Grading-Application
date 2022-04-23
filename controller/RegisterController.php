<?php

class RegisterController extends RegisterModel{

    private $firstName;
    private $lastName;
    private $username;
    private $pwd;
    private $pwdRepeat;
    private $userType;

    //Pre: user submited inputs to register
    //Post: Register obj created eith inputs as attributes
    public function __construct($firstName,$lastName,$username,$pwd,$pwdRepeat,$userType){
        $this->firstName=$firstName;
        $this->lastName=$lastName;
        $this->username=$username;
        $this->pwd=$pwd;
        $this->pwdRepeat=$pwdRepeat;
        $this->userType=$userType;
    } 

    //Pre: user submited inputs to register
    //Post: validates inputs and register user if inputs are valid
    public function registerUser(){
        if($this->validChar()&& $this->notEmpty() && $this->pwdMatch() && $this->validType()&& $this->newUsername()){
            $this->setUser( $this->firstName, $this->lastName, $this->username,$this->pwd,$this->userType);
        }
        else{
            header("location: ../view/index.php?error=invalidIputs");
            exit();
        }
    }

    //Pre: user submited inputs to register
    //Post: returns false if invalid characters else true
    private function validChar(){
        $result;
        if (!preg_match("/^[a-zA-Z' ]*$/",$this->firstName) || !preg_match("/^[a-zA-Z' ]*$/",$this->lastName) || !preg_match("/^[a-zA-Z0-9.]*$/",$this->username)){
            $result=false;
        }
        else{
            $result=true;
        }
        return $result;
    }

    //Pre: user submited inputs to register
    //Post: return false if input an input field is empty else return true
    private function notEmpty(){
        $result;
        if (empty($this->firstName) || empty($this->lastName)|| empty( $this->username) || empty($this->pwd) ||empty($this->userType)){
            $result=false;
        }
        else{
            $result=true;
        }
        return $result;
    }

    //Pre: user submited inputs to register
    //Post: return true if the repeated password and password matches else false
    private function pwdMatch(){
        $result;
        if($this->pwd != $this->pwdRepeat){
            echo "password: ".$this->pwd; 
            echo "repeat: ".$this->pwdRepeat;
            $result=false;
        }
        else{
            $result=true;
        }
        return $result;
    }

    //Pre: user submited inputs to register
    //Post: returns true if usertype is "student" or "teacher" else false
    private function validType(){
        $result;
        if( $this->userType!=="student" &&  $this->userType!=="teacher"){
            $result=false;
        }
        else{
            $result=true;
        }
        return $result;
    }

    //Pre: user submited inputs to register
    //Post: returns true if username does not exist in database else returns false
    private function newUsername(){
        $result;
        if($this->getUserID($this->username)==0){
            $result=true;
        }
        else{
            $result=false;
        }
        return $result;
    }

}

?>