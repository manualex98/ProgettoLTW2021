<?php
session_start();
?>
<!DOCTYPE html>
<html>
    <head>
        <title>Bookmark</title>
        <meta name="viewport" content="width=device-width, initial−scale=1.0"></meta>
        <meta charset="utf-8"></meta>
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script> 
        <script src="../bootstrap/js/bootstrap.min.js" type="text/javascript" lang="javascript"></script>
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
        <link rel="stylesheet" type="text/css" href="../bootstrap/css/bootstrap.min.css"/>
        <link rel="stylesheet" type="text/css" href="../style.css"/>
        <script type="text/javascript" lan="javascript" src="account.js"></script> 
        
    </head>
    <body class='shop_background'>
        <!--Navbar-->
        <nav class="navbar navbar-expand-md navbar-expand-lg navbar-dark bg-dark sticky-top">
            <!--Logo-->
            <a class="navbar-brand" href="../homepage.php"><h5 class="navbarlogo">Bookmark</h5></a>
            <button class="navbar-toggler" data-toggle="collapse" data-target="#navbarResponsive">
                <span class="navbar-toggler-icon"></span>
            </button>
            <span class="collapse navbar-collapse" id="navbarResponsive">
                <!--Menù-->
                <ul class="navbar-nav ml-auto">
                    <li id="nav1" class="nav-item">
                        <a class="nav-link" href="../homepage.php">Home</a>
                    </li>
                    <li id="nav2" class="nav-item active">
                        <a class="nav-link" href="#">Shop</a>
                    </li>
                    <?php 
                        if(isset($_SESSION['username'])) {
                          echo "<li id='nav4' class='nav-item'> 
                          <div class='dropdown'>
                            <button class='dropbtn '>Ciao, ".$_SESSION['username']."</button>
                            <div class='dropdown-content'>
                              <a href='info_user/account.php'>Account</a>
                              <a href='../logout.php'>Logout</a>
                            </div>
                          </div>
                        </li>";
                        }
                        else{
                          echo "<li id='nav3' class='nav-item'>
                          <a class='nav-link' href='../login/login.html'>Login</a>
                          </li>";
                        }
                    ?>
                </ul>
            </span>
        </nav>
        <?php
            $dbconn= pg_connect("host=localhost port=5432 dbname=Bookmark user=postgres password=postgres")
            or die('Could not connect:'. pg_last_error());
        
            $ql="select * from users where name=$1";
            $result=pg_query_params($dbconn,$ql,array($_SESSION['username']));
            $line= pg_fetch_array($result, null, PGSQL_ASSOC);
        
            echo "<h2 class='h2-w font-weight-bolder'>This is your account,".$_SESSION['username']."</h2>";
        ?>
        <form action="changes.php" method="POST">

            <table class="table">
                <tr>
                    <td>
                        <b><h5 class="h5-w font-weight-bolder">Email address:</h5></b>
                    </td>
                    <td>
                        <?php
                            echo "<input class='input_search' name='email' type='email' value='".$line['email']."'></input>";
                        ?>
                    </td>
                    
                    <td>
                        <input class="change_button" type="submit" name="subemail" value="Change">
                    </td>
                </tr>
                <tr>
                    <td>
                        <b><h5 class="h5-w font-weight-bolder">Username:</h5></b>
                    </td>
                    <td>
                        <?php
                            echo "<input class='input_search' name='username' type='text' value='".$line['name']."'></input>";
                        ?>
                    </td>
                    <td>
                        <input class="change_button" type="submit" name="subuser" value="Change">
                    </td>
                </tr>
                <tr>
                    <td>
                        <b><h5 class="h5-w font-weight-bolder">Password:</h5></b>
                    </td>
                    <td>
                        <?php
                            $pass=md5($line['password']);
                            echo "<input id='password1' name='password' class='input_search' type='password' value='".$pass."' onclick='clean()'></input>";
                        ?>
                        <button class="mycheckbox" type="button" id="ckbox" name="ckbox" onclick="show1()" disabled>
                            <i id="icon" class="fa fa-eye-slash"></i>
                        </button>
                    </td>
                    <td>
                        <input class="change_button" type="submit" name="subpass" value="Change">
                    </td>
                </tr>
            </table>


        </form>
        
        <!--Footer-->
        <footer class="text-center text-lg-start bg-dark text-muted">
            <br>
            <p>  Powered by <a href="https://www.uniroma1.it/it/pagina-strutturale/home" title="LaSapienza" target="_blank">Università La Sapienza</a> – Linguaggi e Tecnologie per il Web</p>
            <br>
        </footer>
    </body>
</html>