<?php
//script to create rubric
if(isset($_POST["submit"])){
    $questArray=serialize($_POST["question"]);
    $ansArray=serialize($_POST["ans"]);
    $grdArray=serialize($_POST["grd"]);
    include "../model/Dbh.php";
    include "../model/RubricModel.php";
    include "../controller/RubricController.php";
    
   
    $rubric= new RubricController($questArray,$ansArray,$grdArray);
   
    $test=$rubric->checkAll();

  
    

}



