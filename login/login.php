<html>
    <head></head>
    <body>
        <?php
            $dbconn= pg_connect("host=localhost port=5432 dbname=Bookmark user=postgres password=postgres")
                or die('Could not connect: '. pg_last_error());
                if (!(isset($_POST['loginButton']))){        
                    header("Location: ../homepage.html");
                }
                else{
                    $email=$_POST['inputEmail'];
                    $q1="select * from users where email=$1";
                    $result=pg_query_params($dbconn, $q1, array($email));
                    if (!($line=pg_fetch_array($result, null, PGSQL_ASSOC))){
                        echo "<h1> Sorry, you are not a registered user</h1>
                        <a href=../signup/signup.html>Click here to register</a>";
                    }
                    else{
                        $password=md5($_POST['inputPassword']);
                        $q2="select * from users where email=$1 and password=$2";
                        $result=pg_query_params($dbconn, $q2, array($email, $password));
                        if (!($line=pg_fetch_array($result, null, PGSQL_ASSOC))){
                            echo "<h1>This password is erroneus</h1>
                            <a href=../login/login.html> Click here to login </a>";
                        }
                        else{
                            $nome=$line['nome'];
                            header("Location: ../homepage.html");
                        }
                    }
                }
        ?>
    </body>
</html>