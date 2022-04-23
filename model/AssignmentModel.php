<?php

class AssignmentModel extends Dbh{

    //Pre: user inputs validated to create a new assignmnet
    //Post: insert the created assignment into database
    protected function setAssignment($title,$dd,$location,$des){
        echo "in model<br>";
        $sql="INSERT INTO `Created_Assignments` (`created_assignment_ID`, `title`, `due_date`, `location`, `description`,`teacher_ID`) VALUES ( ?, ?, ?, ?, ?, ?);";
        $stmt=$this->connect()->prepare($sql);
        echo "stmt assignment prep<br>";
        $teacherID=(int)$_SESSION["userID"];
        
        try{
            if(!$stmt->execute(array(Null,$title,$dd,$location,$des,$teacherID))){
                //echo "failed getlogin stmt";
                header("location: ../view/assignments.php?error=stmtFailed");
                exit();
            }
            //echo "after execution";
            $stmt=null;
        }
        catch(Exception $e){
            header("location: ../view/assignments.php?error=sqlException");
            print "Error: ".$e->getMessage()."<br/>";
            exit();
        }
    }
}
