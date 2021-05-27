<html>
    <head></head>
    <body>
        <?php
            $dbconn= pg_connect("host=localhost port=5432 dbname=Bookmark user=postgres password=postgres")
                or die('Could not connect:'. pg_last_error());
                if (!(isset($_POST['signupButton']))){
                    header("Location:../homepage.php");
                }
                else{
                    $email = $_POST['inputEmail'];
                    $ql=" select * from users where email= $1";
                    $result=pg_query_params($dbconn, $ql, array($email));
                    if ($line= pg_fetch_array($result, null, PGSQL_ASSOC)){
                        echo "<h1> Sorry, you are already a registered user</h1>
                        <a href=../login/login.html>Click here to login</a>";
                    }
                    else {
                        $name=$_POST['inputName'];
                        $password=md5($_POST['inputPassword']);

                        $q2="insert into users values ($1, $2, $3)";
                        $data= pg_query_params($dbconn, $q2, array($name, $email, $password));
                        if ($data){
                            header("Location:../login/login.html");
                        }
                    }
                }
        ?>
    </body>
</html>
            