<?php
    session_start();

    if (isset($_SESSION['username'])) {
        $name = $_SESSION['username'];
        $dbconn = pg_connect("host=localhost port=5432 dbname=Bookmark user=postgres password=postgres") 
        or die ('Could not connect: ' . pg_last_error());
        $q1 = "DELETE FROM usersbooks where name='$name'";
        $result = pg_query($q1) or die('Query failed: '. pg_last_error());
        $q2 = "DELETE FROM users where name='$name'";
        $result2 = pg_query($q2) or die('Query failed: '. pg_last_error());
    
        unset($_SESSION['username']);                                           // Fai il logout

        if ($result && $result2)
            header('Location: ../homePage/homepage.php');
    }
?>
