<?php 
    session_start();
    if($_SESSION["userType"]=="student"){
        header("location: Student.php");
    }
    elseif($_SESSION["userType"]=="teacher"){
        header("location: Teacher.php");
    }
   
    //homepage
?>

<!DOCTYPE html>
<head>
<meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Capstone</title>
    <script ></script>
</head>

<body>
    <div>
    <p>Register</p>
        <form name="register" method="POST" Action="Register_inc.php">
            <input type="text" name="firstName" placeholder="First Name"><br>
            <input type="text" name="lastName" placeholder="Last Name"><br>
            <input type="text" name="userName" placeholder="Username"><br>
            <input type="password" name="pwd" placeholder="Password"><br>
            <input type="password" name="pwdRepeat" placeholder="Repeat Password"><br>
            <input type="radio" id="student" name="userType" value="student"></input><label for="student">Student</label> 
            <input type="radio" id="teacher" name="userType" value="teacher"><label for="teacher">Teacher</label> </input><br>
            <input type="submit" name="submit" value="Register"></input>
        </form> 
    </div>

    <div>
        <p>Login</p>
        <form name="login" method="POST" Action="Login_inc.php">
            <input type="text" name="userName" placeholder="Username"><br>
            <input type="password" name="pwd" placeholder="Password"><br>
        
            <input type="submit" name="submit" value="Login"></input>
        </form> 
    </div>

</body>
</html>
