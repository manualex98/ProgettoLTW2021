<?php
    session_start();

    if (!isset($_POST['loginButton'])) {
        header("Location: ../homePage/homepage.php");
    }

    else {
        $email = $_POST['inputEmail'];
        $password = $_POST['inputPassword'];

        if (strlen($password) < 8 || strpos($password," ") != false) {              
            header('Location: loginError.html');                            // se la psw non può esistere è inutile cercarla nel database
        }
        else {
            $dbconn = pg_connect("host=localhost port=5432 dbname=BookShell user=postgres password=anna")
                        or die ('Could not connect: ' . pg_last_error());

            $q1 = "SELECT * FROM users WHERE email = $1";
            $result = pg_query_params($dbconn, $q1, array($email));

            if (!($line = pg_fetch_array($result, null, PGSQL_ASSOC))) {                // Se il login fallisce
                header('Location: loginError.html');
            }
            else {
                $password = md5($password);
                $q2 = "SELECT * FROM users WHERE email = $1 and password = $2";
                $result = pg_query_params($dbconn, $q2, array($email, $password));

                if (!($line = pg_fetch_array($result, null, PGSQL_ASSOC))) {
                    header('Location: loginError.html');
                }
                else {
                    $name = $line['name'];
                    $_SESSION["username"] = $name;
                    header("Location: ../account/account.php");
                }
            }
        }
    }
?>