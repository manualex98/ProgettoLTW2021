<?php
    session_start();

    $email = $_POST['email'];
    $username = $_POST['username'];
    $password = md5($_POST['password']);

    $dbconn= pg_connect("host=localhost port=5432 dbname=Bookmark user=postgres password=postgres")
            or die('Could not connect:'. pg_last_error());

    if(isset($_POST['subemail'])){
        $ql="update users set email = $1 where name =$2";

        $result=pg_query_params($dbconn,$ql,array($email,$_SESSION['username']));
        
        //echo "nuova email: ".$_POST['email']."";
        unset($_SESSION['username']);
        header("Location: ../login/login.html");
        
        
    }
    else if(isset($_POST['subuser'])){
        $ql="update users set name = $1 where email =$2";

        $result=pg_query_params($dbconn,$ql,array($username,$email));
        
        unset($_SESSION['username']);
        header("Location: ../login/login.html");
        
    }
    else if(isset($_POST['subpass'])){
        $ql="update users set password = $1 where name =$2";

        $result=pg_query_params($dbconn,$ql,array($password,$_SESSION['username']));
        
        //echo "nuova password: ".$_POST['password']."";
        unset($_SESSION['username']);
        header("Location: ../login/login.html");
        
    }
    
    
        
    

?>