<?php
    session_start();

	$dbconn = pg_connect("host=localhost port=5432 dbname=BookShell user=postgres password=anna")
                      or die ('Could not connect: ' . pg_last_error());
					  
	/* Handler per Ajax */
    if (isset($_POST['ajax']) && isset($_SESSION['username'])) 
    {
		/* Controllo dell'username */
		if ( $_POST['ajax'] == 'check_password' ) {
            
			$correct = false;
			
			/* Parametri */
            $old_password = md5($_POST['old_psw']);
            $name = $_SESSION['username'];
			
            /* Eseguo la query al database */
            $q = "SELECT password FROM users WHERE name=$1 AND password=$2";
			$check_query = pg_query_params($dbconn, $q, array($name, $old_password));
			
			/* Se ci sono risultati */
			if ($check = pg_fetch_array( $check_query, null, PGSQL_ASSOC)) {       //se nel database c'è una riga con quell'utente e quella psw
				$correct = true;
			}

            /* Se la vecchia password inserita non è corretta  */
            if (!$correct) {
                /* Fornisco l'output JSON per ajax */
                header('Content-type: application/json');
                echo json_encode(['correct' => false]);
                exit;
            }
            
            else {
                $password = md5($_POST['new_psw']);
                $q2 = "UPDATE users SET password='$password' WHERE name='$name'";
                $data = pg_query($q2) or die('Query failed: '. pg_last_error());
                if($data){
                    header('Content-type: application/json');
                    echo json_encode(['correct' => true]);
                    exit;
                } 
            }
		}
	}
?>