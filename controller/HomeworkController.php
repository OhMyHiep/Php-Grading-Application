<?php

class HomeworkController extends HomeworkModel{
    private $student_ID;
    private $created_assignment_ID;
    private $filePath;


    //Pre; user submited inputs to upload an assignment
    //Post: Homeworkcontroller obj created with inputs as attributes
    public function __construct($student_ID,$created_assignment_ID,$filePath){
        $this->created_assignment_ID=$created_assignment_ID;
        $this->student_ID=$student_ID;
        $this->filePath=$filePath;
        //echo $student_ID;
    }


    //Pre; user submited inputs to upload an assignment
    //Post: replace previous submission with this new one
    public function upload(){
        $destination= $this->filePath;
        if(move_uploaded_file($this->filePath, $destination)){

        $this->removePreviousHw($this->student_ID,$this->created_assignment_ID);

        $this->uploadHW($this->student_ID,$this->created_assignment_ID,$this->filePath);
        }
    }



}