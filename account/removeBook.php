<?php
    session_start();

    $dbconn = pg_connect("host=localhost port=5432 dbname=BookShell user=postgres password=anna")
                      or die ('Could not connect: ' . pg_last_error());
					  
	/* Handler per Ajax */
    if (isset($_POST['ajax']) && isset($_SESSION['username'])) 
    {
        $pdf = $_POST['pdf'];
        $pdf = str_replace(' ', '', $pdf);
        $name = $_SESSION['username'];
        $name = str_replace(' ', '', $name);
        
		/* Elimino il libro */
		if ( $_POST['ajax'] == 'unsave' ) {
            $q = "DELETE FROM usersbooks WHERE name=$1 and pdf=$2";
            pg_query_params($dbconn,$q,array($name,$pdf));
        }
        /* Ricomincio il libro da capo*/
        else if ( $_POST['ajax'] == 'reload' ) { 
            $q = "UPDATE usersbooks SET page=1 WHERE name=$1 and pdf=$2";
            pg_query_params($dbconn,$q,array($name,$pdf));
        }
    }
?> 