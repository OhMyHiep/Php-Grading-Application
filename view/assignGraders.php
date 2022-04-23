<?php

//script to assign graders
include "../model/Dbh.php";
include "../model/AssignGradersModel.php";
$AssignGraders= new AssignGradersModel();
$students= $AssignGraders->assignGraders();
session_start();
header('location: view_submissions.php?ID='.$_SESSION["crtedAsignID"]);


