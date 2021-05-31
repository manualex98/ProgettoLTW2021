<?php
    session_start();

    $today = date("H:i:s d/m/Y"); // stile:   17:03:17 03/10/2001

    $dbconn= pg_connect("host=localhost port=5432 dbname=Bookmark user=postgres password=postgres")
                or die('Could not connect:'. pg_last_error());

    $book = $_GET['book'];
    $library = $_GET['library'];
    $action = $_GET['action'];
    $author =$_GET['author'];
    $genre = $_GET['genre'];
    $img = $_GET['img'];
    $username = $_SESSION['username'];

    if($action=='i'){
        $ql = 'insert into booking(username,book,library,date) values ($1,$2,$3,$4)';
        $data= pg_query_params($dbconn, $ql, array($username, $book,$library,$today));
        if ($data){

            $ql = 'update hasbook set quantity=quantity-1 where book=$1 and library=$2';
            $data= pg_query_params($dbconn, $ql, array($book,$library));
            header("Location: details.php?title=".$book."&author=".$author."&genre=".$genre."&img=".$img."");
        }
        else{
            echo "Error occured while booking";
        }
    }
    else if($action=='r'){
        $ql="delete from booking where username=$1 and book=$2 and library=$3";
        $data= pg_query_params($dbconn, $ql, array($username, $book,$library));
        if ($data){

            $ql = 'update hasbook set quantity=quantity+1 where book=$1 and library=$2';
            $data= pg_query_params($dbconn, $ql, array($book,$library));
            header("Location: details.php?title=".$book."&author=".$author."&genre=".$genre."&img=".$img."");
        }
        else{
            echo "Error occured deleting booking";
        }
    }
?>