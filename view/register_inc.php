<?php
//Script to  register new user
if (isset($_POST["submit"])){
    include "../model/Dbh.php";
    include "../model/RegisterModel.php";
    include "../controller/RegisterController.php";

    $firstName=$_POST["firstName"];
    $lastName=$_POST["lastName"];
    $username=$_POST["userName"];
    $pwd=$_POST["pwd"];
    $pwdRepeat=$_POST["pwdRepeat"];
    $userType=$_POST["userType"];

    //Initilize RegisterController class 
    $user=new RegisterController( $firstName, $lastName,$username,$pwd,$pwdRepeat,$userType);
    //Run Error Handlers and Register User
    $user->registerUser();
    echo "newhere";

    //Go back to Front page
    header("location: index.php?error=none");

}