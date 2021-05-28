<!DOCTYPE html>
<html>
    <head>
        <title>Bookmark</title>
        <meta name="viewport" content="width=device-width, initial−scale=1.0"></meta>
        <meta charset="utf-8"></meta>
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script> 
        <script src="../bootstrap/js/bootstrap.min.js" type="text/javascript" lang="javascript"></script>
        <link rel="stylesheet" type="text/css" href="../bootstrap/css/bootstrap.min.css"/>
        <link rel="stylesheet" type="text/css" href="../style.css"/>
        
    </head>
    <body>
        <!--Navbar-->
        <nav class="navbar navbar-expand-md navbar-expand-lg navbar-dark bg-dark sticky-top">
            <!--Logo-->
            <a class="navbar-brand" href="#"><h5 class="navbarlogo">Bookmark</h5></a>
            <button class="navbar-toggler" data-toggle="collapse" data-target="#navbarResponsive">
                <span class="navbar-toggler-icon"></span>
            </button>
            <span class="collapse navbar-collapse" id="navbarResponsive">
                <!--Menù-->
                <ul class="navbar-nav ml-auto">
                    <li id="nav1" class="nav-item active">
                        <a class="nav-link" href="homepage.php">Home</a>
                    </li>
                    <li id="nav2" class="nav-item">
                        <a class="nav-link" href="shop/shop.php">Shop</a>
                    </li>
                    <li id='nav4' class='nav-item'> 
                          <div class='dropdown'>
                            <button class='dropbtn '>Ciao,<?php$_SESSION['username']?></button>
                            <div class='dropdown-content'>
                              <a href='info_user/account.html'>Account</a>
                              <a href='logout.php'>Logout</a>
                            </div>
                          </div>
                        </li>
                    
                </ul>
            </span>
        </nav>
        <!--Header-->
        <header style="max-width:1600px; min-width:500px; position:relative; top:-25px;" id="home">
            <img class="img-fluid" src="images/Bookmark.jpg" alt="Bookshell"/>
        </header>
        
        <?php
        $dbconn= pg_connect("host=localhost port=5432 dbname=Bookmark user=postgres password=postgres")
                or die('Could not connect:'. pg_last_error());

        $name = $_POST['name'];
        $title = $_POST['title'];

        $q2="insert into users lovesbook ($1, $2)";
        $data= pg_query_params($dbconn, $q2, array($name, $title));
        if ($data){
            echo "Dati salvati correttamente";
        }
        else{
            echo "ERRORE";
        }
        ?>

        
        <!--Footer-->
        <footer class="text-center text-lg-start bg-dark text-muted">
            <br>
            <p>  Powered by <a href="https://www.uniroma1.it/it/pagina-strutturale/home" title="LaSapienza" target="_blank">Università La Sapienza</a> – Linguaggi e Tecnologie per il Web</p>
            <br>
        </footer>
    </body>
</html>