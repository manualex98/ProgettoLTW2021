<?php
    session_start();
	
	/* Suddivido la pagina in due parti: quella che viene caricata inviato il form */
	/* e quella richiamata invece da ajax, come se fossero due pagine diverse */
	
	/* Connessione al db: viene condivisa da entrambe le pagine */
	$dbconn = pg_connect("host=localhost port=5432 dbname=Bookmark user=postgres password=postgres")
                      or die ('Could not connect: '.pg_last_error());
					  
	/* Handler per Ajax */
    if (isset($_POST['ajax'])) 
    {
		/* Controllo dell'username */
		if ( $_POST['ajax'] == 'check_username' ) {
            
			$used = false;
			
			/* Parametri */
			$name = strtolower($_POST['user']);
			
            /* Eseguo la query al database */
            $q = "SELECT name FROM users WHERE lower(name)=$1";
			$check_query = pg_query_params($dbconn, $q, array($name));
			
			/* Se ci sono risultati */
			if ($check = pg_fetch_array( $check_query, null, PGSQL_ASSOC)) {
				$used = true;
			}

			/* Fornisco l'output JSON per ajax */
			header('Content-type: application/json');
			echo json_encode(['is_used' => $used]);
			exit;
		}
	}
	
	/* Pagina signup: */
	else {
?>

<!DOCTYPE html>
<html>
    <head>
        <link rel='shortcut icon' type='image/x-icon' href='../icon.ico'/>
        <link rel="stylesheet" href="../style.css" type="text/css"/>
        <script type="text/javascript" src="signup.js"></script>
    </head>
    <body class="background">
        <?php

            if (!(isset($_POST['signupButton']))) {        //se questa pagina php non è stata chiamata dopo la registrazione del bottone
                header("Location: ../homePage/homepage.php");   //reindirizza alla home  
            }
            else {
                $email = $_POST['inputEmail'];                          //ottieni l'email scritta nel form
                $q1 = "SELECT * FROM users WHERE email=$1";             //sostituisci un valore a $1 (se ne servivano di più si usavano anche $2, $3 ecc)
                $result = pg_query_params($dbconn, $q1, array($email)); //lancia la query sostituendo array($email) al parametro $1 (i parametri vanno passati come array)

                if ($line = pg_fetch_array($result, null, PGSQL_ASSOC)) {   //se l'utente è già registrato
                    echo '<form action="../loginPage/login.html" class="box-error" method="post" name="formErr">';
                    echo '<img src="../loginPage/l-images/ancient-book.png" width="180" height="130">';
                    echo '<h1 style="letter-spacing:0px">Sorry, you are already a registred user</h1><br><br>';
                    echo '<button class="button" type="submit">Click here to login</button>';
                    echo '</form>';
                }
                else {
                    $name = $_POST['inputName'];
                    $password = md5($_POST['inputPassword']);   //md5 è una funzione di hash per nascondere la psw

                    $q2 = "INSERT into users values ($1, $2, $3)";
                    $data = pg_query_params($dbconn, $q2, array($name, $email, $password));
            
                    if ($data) {
                        $_SESSION["username"] = $name;          // fai il login
                        header("Location: ../account/account.php");
                    }
                }
            }
        ?>
    </body>
</html>

<?php
	/* Fine dell'if sull'handler */
	}
?>