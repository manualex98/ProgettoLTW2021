<?php
    session_start();

    if (!(isset($_GET['pdf']))) {                                               // se non arriviamo qui cliccando il pulsante read
        header('Location: ../homePage/homepage.php');
    }
    
    else if (!isset($_SESSION['username'])) {                                   // se l'utente non è loggato
        header('Location: ../error.html');
    }
    
    else {
        $dbconn = pg_connect("host=localhost port=5432 dbname=BookShell user=postgres password=anna")
        or die ('Could not connect: ' . pg_last_error());
        
        $name = $_SESSION['username'];
        $name = str_replace(' ', '', $name);
        $pdf = $_GET['pdf'];

        $query = "SELECT name, pdf, page FROM usersbooks WHERE name='$name' and pdf='$pdf'";
        $result = pg_query($query) or die('Query failed: '. pg_last_error());

        if(($alreadyInUsersbooks = pg_num_rows($result)) > 0){                                  // se il libro era già salvato o in lettura
            $pagequery = "SELECT page FROM usersbooks WHERE name='$name' and pdf='$pdf'";
            $result = pg_query($pagequery) or die('Query failed: '. pg_last_error());
            $page=pg_fetch_row($result)[0];
            if($page!=-1){
                header('Location: pdfjs/web/viewer.html?file=../../pdfs/'. $pdf . '#page='.$page);
            }
            else{
                header('Location: pdfjs/web/viewer.html?file=../../pdfs/'. $pdf . '#page=1');
            }
        }
        else{                                                                                   // altrimenti, inseriscilo nel database
            $q1 = "insert into usersbooks values ($1, $2, $3)";
            $data = pg_query_params($dbconn, $q1, array($name, $pdf, 1));
            if ($data){
                header('Location: pdfjs/web/viewer.html?file=../../pdfs/'. $pdf . '#page=1');
            }
        }
    }
?>