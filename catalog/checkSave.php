<?php
    session_start();

    if (!(isset($_GET['pdf']))) {                                               // se non arriviamo qui cliccando il pulsante save
        header("Location: ../homePage/homepage.php");
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

        if(($alreadyInUsersbooks = pg_num_rows($result)) > 0) {                                  // se il libro era già salvato o in lettura
            header('Location: alreadyInUsersBooks.php');
        }
        else {                                                                                   // altrimenti, inseriscilo nel database
            $q2 = "insert into usersbooks values ($1, $2, $3)";
            $data = pg_query_params($dbconn, $q2, array($name, $pdf,-1));
            if ($data){
                header("Location: catalog.php");
            }
        }
    }
?>