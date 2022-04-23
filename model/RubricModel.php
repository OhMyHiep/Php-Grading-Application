<?php
session_start();
class RubricModel extends Dbh{

    //Pre: inputs to create rubric is validated
    //Post: rubric inserted into database
    protected function setRubric($questArray,$ansArray,$grdArray){
        $nbrQuestions=count($questArray);
        $crtedAsignId=$_SESSION["crtedAsignID"];
        for ($questNum=1;$questNum<=$nbrQuestions;$questNum++){
            $stmt=$questArray[$questNum];
            $result=$this->uploadQuestion($crtedAsignId,$questNum,$stmt);
            $questId=(int)$result[0]["LAST_INSERT_ID()"];
            $answers=count($ansArray[$questNum]);
            for($ansNum=1;$ansNum<=$answers;$ansNum++){
                $choice=$ansArray[$questNum][$ansNum];
                $grade=$grdArray[$questNum][$ansNum];
                $this->uploadAns($questId,$grade,$choice);  
            }
        }
        echo "Rubric Submitted";
    }  
   
    //Pre: need to insert a rubric question into database
    //Post: returns id of the inserted question 
    private function uploadQuestion($crtedAsignId,$questNum,$stmt){
        $insertSql="INSERT INTO `RubricQuestions` (`question_ID`, `created_assignment_ID`, `question_number`, `Question_statement`) VALUES (NULL, ?, ?, ?);";

        $getSql="SELECT LAST_INSERT_ID();";

        $con= $this->connect();
        $insertStmt= $con->prepare($insertSql);
        $getStmt=$con->prepare($getSql);
        try{
            if($insertStmt->execute(Array($crtedAsignId,$questNum,$stmt))){
                $getStmt->execute();
            }
            $id=$getStmt->fetchAll();
            $con=null;
            return $id;
            
        }catch(Exception $e){
            print "Error: ".$e->getMessage()."<br/>";
            die();
        }
    }

    //Pre: has id of the question
    //Piost: insert the choice mapped to the id
    private function uploadAns($questId,$grade,$choiceStmt){
        $sql="INSERT INTO `Choices` (`Choice_ID`, `question_ID`, `grade`, `statement`) VALUES (?, ?, ?, ?);";
        $insertStmt=$this->connect()->prepare($sql);
        try{
            $insertStmt->execute(Array(Null,$questId,$grade,$choiceStmt));
            $insertStmt=Null;
        }catch(Exception $e){
            print "Error: ".$e->getMessage()."<br/>";
            die();
        }
        
    }
    



 }

?>