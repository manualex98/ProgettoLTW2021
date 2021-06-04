<?php
    session_start();

    $username = $_SESSION['username'];
    $book = $_GET['book'];
    $action = $_GET['action'];
    $author =$_GET['author'];
    $genre = $_GET['genre'];
    $img = $_GET['img'];

    $dbconn= pg_connect("host=localhost port=5432 dbname=Bookmark user=postgres password=postgres")
                or die('Could not connect:'. pg_last_error());

    //se l'azione è 'i' faccio l'inserimento tra i preferiti
    if($action=='i'){
        $q2="insert into lovesbook(username,book) values ($1, $2)";
        $data= pg_query_params($dbconn, $q2, array($username, $book));
        if ($data){
            header("Location: details.php?title=".$book."&author=".$author."&genre=".$genre."&img=".$img."");
        }
        else{
            echo "Error occured saving book to whishlist";
        }
    }

    //se l'azione è 'r' rimuovo il libro dai preferiti
    else if($action=='r'){
        $q2="delete from lovesbook where username=$1 and book=$2";
        $data= pg_query_params($dbconn, $q2, array($username, $book));
        if ($data){
            header("Location: details.php?title=".$book."&author=".$author."&genre=".$genre."&img=".$img."");
        }
        else{
            echo "Error occured deleting book from whishlist";
        }
    }
    
?>