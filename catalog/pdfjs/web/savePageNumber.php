<?php
    session_start();
    if (isset($_POST['page'])) {
        $page=$_POST['page'];
        $url= $_SERVER['HTTP_REFERER'];
        $urlplus="http://localhost:3000/catalog/pdfjs/web/viewer.html?file=../../pdfs/";
        $pdf=str_replace($urlplus,"",$url);
        $dbconn = pg_connect("host=localhost port=5432 dbname=Bookmark user=postgres password=postgres")
        or die ('Could not connect: ' . pg_last_error());
        if(isset($_SESSION['username'])){
            $name = $_SESSION['username'];
            $name = str_replace(' ', '', $name);
            $query="UPDATE usersbooks SET page = $1 WHERE name='$name' and pdf='$pdf'";
            $data = pg_query_params($dbconn, $query,array($page));
        }
    }
?>