<?php

class Dbh {

    //Pre: need to connect to database
    //Post: returns the connection obj
    protected function connect(){
        try{
            $username="root";
            $password="";
            $dbh= new PDO('mysql:host=localhost;dbname=capstone',$username,$password);
            $dbh->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE,PDO::FETCH_ASSOC);
            return $dbh;
        }
        catch(PDOException $e){
            print "Error: ".$e->getMessage()."<br/>";
            die();
        }
    }

}