<?php
//script to login
include "../model/Dbh.php";
include "../model/LoginModel.php";
include "../controller/LoginController.php";

if(isset($_POST["submit"])){
    $username=$_POST["userName"];
    $pwd=$_POST["pwd"];
    $lC= new LoginController($username,$pwd);
    //echo "here";
    $lC->loginUser();

    header("location: index.php?error=none");
}
