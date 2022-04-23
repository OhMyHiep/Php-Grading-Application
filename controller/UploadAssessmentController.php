<?php

class UploadAssessmentController extends UploadAssessmentModel{

    private $ans;//array

    //Pre: user submited inputs to upload the assessment of peer
    //Post: create UploadAssessmentController obj with array of answers as attributes
    public function __construct($ans){
        $this->ans=$ans;
    }

    //Pre: user submited inputs to upload the assessment of peer
    //Post: validate the inputs and submit the answers
    public function uploadAssessment(){
        if($this->isAnsValid()){
            //echo "valid";
            $grade=0;
            session_start();
            //var_dump($_SESSION);
            $upldAsgnId=$this->getAssigmentID();
            foreach($this->ans as $value){
                $val=explode(",",$value);
                $grade+=(int)$val[0];
                $choiceId=$val[1];
                $this->uploadAns($upldAsgnId,$choiceId);
            }
            $this->uploadPeerGrade($grade,$upldAsgnId);
        }
        else{
            echo "not valid";
            header("location: gradePeer.php");
            exit;
        }

    }

    //Pre: user submited inputs to upload the assessment of peer
    //Post: returns true if each question has an answer
    private function isAnsValid(){
        $result=true;
        session_start();
        for($i=1;$i<count($_SESSION["questNum"]);$i++){
            if($this->ans[$i]==null){
                $result=false;
            }
        }
        return $result;
    }

}