<?php
    session_start();

    $dbconn= pg_connect("host=localhost port=5432 dbname=Bookmark user=postgres password=postgres")
            or die('Could not connect:'. pg_last_error());

    if(isset($_POST['subemail'])){
        $email = $_POST['email'];
        $ql="update users set email = $1 where name =$2";

        $result=pg_query_params($dbconn,$ql,array($email,$_SESSION['username']));
        if($line= pg_fetch_array($result, null, PGSQL_ASSOC)){
            //echo "nuova email: ".$_POST['email']."";
            header("Location: account.php");
        }
        else{
            echo "ERROR OCCURED WHILE CHANGING EMAIL";
        }
        
    }
    else if(isset($_POST['subuser'])){
        $username = $_POST['username'];
        $email = $_POST['email'];
        $ql="update users set name = $1 where email =$2";

        $result=pg_query_params($dbconn,$ql,array($_SESSION['username'],$email));
        if($line= pg_fetch_array($result, null, PGSQL_ASSOC)){
            //echo "nuovo username: ".$_POST['username']."";
            header("Location: account.php");
        }
        else{
            echo "ERROR OCCURED WHILE CHANGING USERNAME";
        }
    }
    else if(isset($_POST['subpass'])){
        $password = md5($_POST['password']);

        $ql="update users set password = $1 where name =$2";

        $result=pg_query_params($dbconn,$ql,array($password,$_SESSION['username']));
        if($line= pg_fetch_array($result, null, PGSQL_ASSOC)){
            //echo "nuova password: ".$_POST['password']."";
            header("Location: account.php");
        }
        else{
            echo "ERROR OCCURED WHILE CHANGING PASSWORD";
        }
    }
    
    
        
    

?>