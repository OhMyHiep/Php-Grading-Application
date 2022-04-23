<?php

class RubricController extends RubricModel{

    private $questArray; 
    private $ansArray;
    private $grdArray;

    //Pre: user submited inputs to create a new rubric
    //Post: RubricController object created with inputs as attributes
    public function __construct($questArray,$ansArray,$grdArray){
        $this->questArray=unserialize($questArray);
        $this->ansArray=unserialize($ansArray);
        $this->grdArray=unserialize($grdArray);
    }

    //Pre: user submited inputs to create a new rubric
    //Post: validates inputs and create rubric if valid
    public function checkAll(){
        if($this->questArray!=null){
            $nbrQuestions=count($this->questArray);
            for ($questNum=1;$questNum<=$nbrQuestions;$questNum++){
                $stmt=$this->questArray[$questNum];
                $this->checkInput($stmt);
                if ($this->ansArray[$questNum]!=null){
                    $answers=count($this->ansArray[$questNum]);
                    for($ansNum=1;$ansNum<=$answers;$ansNum++){
                        $choice=$this->ansArray[$questNum][$ansNum];
                        $grade=$this->grdArray[$questNum][$ansNum];
                        $this->checkInput($choice);
                        $this->checkGrade($grade);
                    }
                }
                else{
                    echo "question without answers<br>";
                    exit;
                }
            }
        } 
        else{
            echo "empty rubric<br>";
            exit;
        }
        $this->setRubric( $this->questArray,$this->ansArray,$this->grdArray);
    }

    //Pre: user submited inputs to create a new rubric
    //Post: checks if inputs are empty
    private function checkInput($stmt){
        if(empty($stmt)){
            echo "an input is empty<br>";
            exit;
            }
        elseif($this->invalid($stmt)){
            echo "an input is invalid<br>";
            exit;
            }
    }

    //Pre: user submited inputs to create a new rubric
    //Post: check if the grade is a valid numeric
    private function checkGrade($stmt){
        if ($stmt==null){
            echo "grade is null<br>";
            exit;
        }
        elseif(!is_numeric($stmt)){
            echo "error: grade is not a number<br>";
            exit;
        }
        elseif(number_format($stmt)<0 || number_format($stmt)>100){
            echo "grade out of range<br>";
            exit;
        }
    }

    //Pre: user submited inputs to create a new rubric
    //Post: returns false if inputs contains invalid characters else returns true
    private function invalid($stmt){
        $result;
        if (!preg_match("/^[a-zA-Z0-9?., ]*$/",$stmt)){
            $result=true;
        }
        else{
            $result=false;
        }
        return $result;
    }

}
