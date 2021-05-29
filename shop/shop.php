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
        <script src="shop.js" type="text/javascript" lang="javascript"></script>
        <link rel="stylesheet" type="text/css" href="../bootstrap/css/bootstrap.min.css"/>
        <link rel="stylesheet" type="text/css" href="../style.css"/>
        
    </head>
    <body class='shop_background'>
        <!--Navbar-->
        <nav class="navbar navbar-expand-md navbar-expand-lg navbar-dark bg-dark">
            <!--Logo-->
            <a class="navbar-brand" href="../homepage.php"><h5 class="navbarlogo">BOOKMARK</h5></a>
            <button class="navbar-toggler" data-toggle="collapse" data-target="#navbarResponsive">
                <span class="navbar-toggler-icon"></span>
            </button>
            <span class="collapse navbar-collapse" id="navbarResponsive">
                <!--Menù-->
                <ul class="navbar-nav ml-auto">
                    <li id="nav1" class="nav-item">
                        <a class="nav-link" href="../homepage.php">HOME</a>
                    </li>
                    <li id="nav2" class="nav-item active">
                        <a class="nav-link" href="#">SHOP</a>
                    </li>
                    <li id="nav3" class="nav-item">
                        <a class="nav-link" href="../faq/faq.php">FAQ</a>
                    </li>
                    <?php 
                        if(isset($_SESSION['username'])) {
                            echo "<li class='nav-item dropdown'>
                            <a class='nav-link dropdown-toggle' href='#' id='navbarDropdownMenuLink' role='button' data-toggle='dropdown' aria-haspopup='true' aria-expanded='false'>
                            CIAO, ".$_SESSION['username']."
                            </a>
                            <div class='dropdown-menu' aria-labelledby='navbarDropdownMenuLink'>
                              <a class='dropdown-item' href='../info_user/account.php'>Account</a>
                              <div class='dropdown-divider'></div>
                              <a class='dropdown-item' href='../logout.php'>Logout</a>
                            </div>
                          </li>"; 
                          }
                          else{
                            echo "<li id='nav3' class='nav-item'>
                            <a class='nav-link' href='../login/login.html'>LOGIN</a>
                            </li>";
                        }
                    ?>
                </ul>
            </span>
        </nav>

        <!--Search form-->
        <form action="shop.php" class="box_search" style="margin-top:1%" method="post" name="shopForm">
            <input type="text" name="inputTitle" placeholder="Title" size="20" class="input_search" required autofocus>
            <input type="text" name="inputAuthor" placeholder="Author" size="20" class="input_search">
            <select size="1" class="custom-select-sm custom_select" name="inputGenre">
                <option selected value="none">-
                <option value="Romance">Romance
                <option value="Adventure">Adventure
                <option value="Fantasy">Fantasy
                <option value="Historical">Historical
                <option value="Thriller">Thriller
                <option value="Novel">Novel
                <option value="Horror">Horror
                <option value="Mystery">Mystery
                <option value="Fiction">Fiction
                <option value="Scientific">Scientific
            </select>
            <button type="submit" name="searchButton" class="btn btn-outline-light" data-toggle="button" aria-pressed="false">Search <i class='fa fa-search'></i></button>
        </form>

        <!--Sezione copertine-->
        <?php
            $dbconn= pg_connect("host=localhost port=5432 dbname=Bookmark user=postgres password=postgres")
                or die('Could not connect:'. pg_last_error());
            
            $title = $_POST['inputTitle'];
            $author = $_POST['inputAuthor'];
            $genre = $_POST['inputGenre'];
            $ql="select * from books where name=$1 and author=$2 and genre=$3";
            $result=pg_query_params($dbconn, $ql, array($title,$author,$genre));

            if ((isset($_POST['searchButton']))){
                if(!($line= pg_fetch_array($result, null, PGSQL_ASSOC))){
                    echo "<br><h1> Sorry, this book doesn't exist</h1>";
                }
                else{
                    $ql="select img from books where name=$1 and author=$2 and genre=$3";
                    $result=pg_query_params($dbconn,$ql, array($title,$author,$genre));
                    while($line= pg_fetch_array($result, null, PGSQL_ASSOC)){
                        echo "<div>" ;
                        foreach($line as $col_value) {
                            $title = str_replace(" ","-",$title);
                            $author = str_replace(" ","-",$author);
                            echo "<a href=details.php?title=".$title."&author=".$author."&genre=".$genre."&img=".$col_value.">
                            <img class='img img_found' src='../images/covers/".$col_value."'></a>";
                        }
                        //$line["img"]
                        echo "\t</div>\n" ;
                    }
                    
                    echo "<br>" ;
                }
            }
            else{

                echo "<div class='container text-center'>";
                echo "<div class='row'>";
                $ql="select * from books";
                    $result=pg_query($ql) or die('Query failed: '. pg_last_error());
                    while($line= pg_fetch_array($result, null, PGSQL_ASSOC)){
                        $title = str_replace(" ","-",$line['name']);
                        $author = str_replace(" ","-",$line['author']);
                        echo "<div class='col-sm'>";
                        echo "<a href=details.php?title=".$title."&author=".$author."&img=".$line["img"].">
                        <img class='img' src='../images/covers/".$line["img"]."'></a>"; 
                        echo "</div>";      
                }
                echo "</div></div>";
            }
            echo "<br><br><br>";
                
            pg_free_result($result);
            pg_close($dbconn) ;
        ?>
        <!--Footer-->
        <footer class="text-center text-lg-start bg-dark text-muted">
            <br>
            <p>  Powered by <a href="https://www.uniroma1.it/it/pagina-strutturale/home" title="LaSapienza" target="_blank">Università La Sapienza</a> – Linguaggi e Tecnologie per il Web</p>
            <br>
        </footer>
    </body>
</html>
            