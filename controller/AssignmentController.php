<?php

class AssignmentController extends AssignmentModel{

    private $title;
    private $dd;
    private $des;
    private $filePath;
    private $destination;

//pre: user submited inputs to create an assignment
//post: assignment controller object created with inputs as attributes
   public function __construct($title,$dd,$des,$filePath,$destination){
        $this->title=$title;
        $this->des=$des;
        $this->dd=$dd;
        $this->filePath=$filePath;
        $this->destination=$destination;
   }

   //pre: user submited inputs to create an assignment
   //post: inputs are validated and put into database
    public function createHW(){
        if ($this->notEmpty() && $this->validChar() && $this->validFileSize() && $this->validDate()){
            echo "creating hw";
            try{
                if(move_uploaded_file($this->filePath, $this->destination)){
                $this->setAssignment($this->title,$this->dd,$this->destination,$this->des);
                }
            }
            catch(Exception $e){
                print "Error: ".$e->getMessage()."<br/>";
            }
            
        }
        else{
            //header("location: assignments.php?error=invalidInputs");
            exit();
        }
   }

//Pre: user submited inputs to create an assignment
//validate if input fields are empty
    private function notEmpty(){
    $result;
    if (empty($this->title) || empty($this->des)|| empty( $this->dd)){
        //echo "empty";
        $result=false;
    }
    else{
        $result=true;
    }
    return $result;
}

//Pre; user submited inputs to create an assignment
//Post: validate if the string has invalid characters
    private function validChar(){
        $ptrn="/^[a-zA-Z0-9.?,-| ]*$/";
        $result;
        if (!preg_match($ptrn,$this->title) || !preg_match($ptrn,$this->des)){
            echo "not valid char";
            $result=false;
        }
        else{
            $result=true;
        }
        return $result;
    }


    //Pre; user submited inputs to create an assignment
    //Post: validate if file is too large
    private function validFileSize(){
        $fileSize = filesize($this->filePath);
        $result;
        if ($fileSize>3145728){
            echo "file too large";
            $result=false;
        }
        else{
            $result=true;
        }
        return $result;
    }

    //Pre; user submited inputs to create an assignment
    //Post: validate if date is invalid
    private function validDate(){
        $dateArr= explode('-',$this->dd);
        //echo "date ".$this->dd;
        return checkdate($dateArr[1],$dateArr[2],$dateArr[0]);
    }


}