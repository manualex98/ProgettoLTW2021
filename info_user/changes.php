<?php
    session_start();

    $email = $_POST['email'];
    $username = $_POST['username'];
    $password = $_POST['password'];

    $dbconn= pg_connect("host=localhost port=5432 dbname=Bookmark user=postgres password=postgres")
            or die('Could not connect:'. pg_last_error());

    $ql = 'select * from users where name=$1';
    $result=pg_query_params($dbconn,$ql,array($_SESSION['username']));
    $line= pg_fetch_array($result, null, PGSQL_ASSOC);

    if(isset($_POST['subemail'])){

        if($email==$line['email']){             //se non è stato cambiato nulla resta sulla pagina
            header("Location: account.php");
        }
        else{
            $ql="update users set email = $1 where name =$2";    //altrimenti aggiorna ed effettua il logout

            $result=pg_query_params($dbconn,$ql,array($email,$_SESSION['username']));
        
            //echo "nuova email: ".$_POST['email']."";
            unset($_SESSION['username']);
            header("Location: ../login/login.html");
        }
        
        
        
    }
    else if(isset($_POST['subuser'])){

        if($username==$line['name']){         //se non è stato cambiato nulla resta sulla pagina
            header("Location: account.php");
        }
        else{
            $ql="update users set name = $1 where email =$2";  //altrimenti aggiorna ed effettua il logout

            $result=pg_query_params($dbconn,$ql,array($username,$email));
        
            unset($_SESSION['username']);
            header("Location: ../login/login.html");
        }
        
    }
    else if(isset($_POST['subpass'])){
        
        if($password==$line['password']){           //se non è stato cambiato nulla resta sulla pagina
            header("Location: account.php");
        }
        else{
            $ql="update users set password = $1 where name =$2";   //altrimenti aggiorna ed effettua il logout

            $result=pg_query_params($dbconn,$ql,array($password,$_SESSION['username']));
        
            //echo "nuova password: ".$_POST['password']."";
            unset($_SESSION['username']);
            header("Location: ../login/login.html");
        }
        
        
    }
    
    
        
    

?>