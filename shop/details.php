<?php
  session_start();
?>
<!DOCTYPE html>
<html>
    <head>
        <title>Bookmark-Details</title>
        <meta name="viewport" content="width=device-width, initial−scale=1.0"></meta>
        <meta charset="utf-8"></meta>
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script> 
        <script src="../bootstrap/js/bootstrap.min.js" type="text/javascript" lang="javascript"></script>
        <link rel="stylesheet" type="text/css" href="../bootstrap/css/bootstrap.min.css"/>
        <link rel="stylesheet" type="text/css" href="../style.css"/>
        <script src="details.js" type="text/javascript" lang=javascript></script>

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
                    <li id="nav1" class="nav-item active">
                        <a class="nav-link" href="../homepage.php">Home</a>
                    </li>
                    <li id="nav2" class="nav-item">
                        <a class="nav-link" href="#">Shop</a>
                    </li>
                    <?php 
                        if(isset($_SESSION['username'])) {
                          echo "<li id='nav4' class='nav-item'> 
                          <div class='dropdown'>
                            <button class='dropbtn '>Ciao, ".$_SESSION['username']."</button>
                            <div class='dropdown-content'>
                              <a href='info_user/account.html'>Account</a>
                              <a href='logout.php'>Logout</a>
                            </div>
                          </div>
                        </li>";
                        }
                        else{
                          echo "<li id='nav3' class='nav-item'>
                          <a class='nav-link' href='login/login.html'>Login</a>
                          </li>";
                        }
                    ?>
                </ul>
            </span>
        </nav>
    <?php
            $title=$_GET['title'];
            $author=$_GET['author'];
            $genre=$_GET['genre'];
            $img=$_GET['img'];
            
            $dbconn= pg_connect("host=localhost port=5432 dbname=Bookmark user=postgres password=postgres")
                or die('Could not connect:'. pg_last_error());

            
            $title = str_replace("-"," ",$title);
            $author = str_replace("-"," ",$author);
            $img = str_replace("-"," ",$img);
            
            $ql="select * from hasbook,libraries where hasbook.book=$1 and libraries.name=library";
            $result=pg_query_params($dbconn,$ql,array($title));
            
        echo "<div class='container'>
            <div class='row text-left'>
                <div class='col-md-4'>";
                    echo "<img class='img img_found' src='../images/covers/".$img."' >
                </div>
                <div class='col-md-8'>
                    <br><br>
                    <h1 class='h1-w font-weight-bolder'>$title </h1><h5 class='h5-w font-weight-bolder'>$author</h5><br>
                    <h4 class='h4-w font-weight-bolder' >This book is available on these libraries:</h4>" ;
                    echo "\t<table class='table table-dark table-striped'>\n" ;
                    while($line= pg_fetch_array($result, null, PGSQL_ASSOC)){
                        echo "\t<tr><td>\n" ;
                        
                        echo "<h5 class='font-weight-bolder'>".$line['library']."  placed in ".$line['city']. "  address ".$line['address']."</h5><br>";
                        if($line['quantity']>0){
                            if($line['quantity']==1){
                                echo "<h5 class='h5-w font-weight-bolder'>Availability: <h5>".$line['quantity']."</h5> <h4 class='h4-r font-weight-bolder'>LAST ONE AVAILABLE!!! </h4><h4 class='h4-w font-weight-bolder'>Price: " .$line['price']."€</h4>";
                            }
                            else{
                                echo "<h5 class='h5-w font-weight-bolder'>Availability: </h5><h5>".$line['quantity']."</h5><h4 class='h4-w font-weight-bolder'>Price: " .$line['price']."€</h4>";
                            }
                            
                            
                        }
                        echo "</td>\t</tr>\n" ;
                    }
                    echo "\t</table>\n" ;
                "</div>
            </div>
        </div>";
            
        
            pg_free_result($result);
            pg_close($dbconn);
        ?>
    </body>
</html>