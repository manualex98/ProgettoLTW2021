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
            <a class="navbar-brand" href="../homepage.html"><h5 class="navbarlogo">Bookmark</h5></a>
            <button class="navbar-toggler" data-toggle="collapse" data-target="#navbarResponsive">
                <span class="navbar-toggler-icon"></span>
            </button>
            <span class="collapse navbar-collapse" id="navbarResponsive">
                <!--Menù-->
                <ul class="navbar-nav ml-auto">
                    <li id="nav1" class="nav-item active">
                        <a class="nav-link" href="../homepage.html">Home</a>
                    </li>
                    <li id="nav2" class="nav-item">
                        <a class="nav-link" href="#">Shop</a>
                    </li>
                    <li id="nav3" class="nav-item">
                        <a class="nav-link" href="../login/login.html">Login</a>
                    </li>
                </ul>
            </span>
        </nav>
        <br><br>
        <!--Search form-->
        <form action="shop.php" class="box_search" style="margin-top:3%" method="post" name="shopForm">
            <input type="text" name="inputTitle" placeholder="Title" size="20" class="input_search" required autofocus>
            <input type="text" name="inputAuthor" placeholder="Author" size="20" class="input_search">
            <select size="1" class="custom-select-sm" name="inputGenre">
                <option selected value="none">-
                <option value="Romance">Romance
                <option value="Adventure">Adventure
                <option value="fantasy">Fantasy
                <option value="Historical">Historical
                <option value="Thriller">Thriller
                <option value="Novel">Novel
                <option value="Horror">Horror
                <option value="Mystery">Mystery
                <option value="Fiction">Fiction
                <option value="Scientific">Scientific
            </select>
            
            <input type="submit" name="searchButton" value="Search" class="input_search_button">
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
                    $ql="select img from books";
                    $result=pg_query($ql) or die('Query failed: '. pg_last_error());
                    

                    while($line= pg_fetch_array($result, null, PGSQL_ASSOC)){
                        echo "\t<div>\n" ;
                        foreach($line as $col_value) {
                            $title = str_replace(" ","-",$title);
                            $author = str_replace(" ","-",$author);
                            echo "<a href=details.php?title=$title&author=$author&genre=$genre>
                            <img class='img img_found' src='../images/covers/".$col_value."'></a>";
                        }
                        echo "\t</div>\n" ;
                    }
                    
                    echo "<br><br>" ;
                }
            }
            else{
                $ql="select img from books";
                    $result=pg_query($ql) or die('Query failed: '. pg_last_error());
                    while($line= pg_fetch_array($result, null, PGSQL_ASSOC)){
                    foreach($line as $col_value) {
                        $title = str_replace(" ","-",$title);
                        $author = str_replace(" ","-",$author);
                        echo "<span class='shop'";
                        echo "<a href=details.php?title=$title&author=$author&genre=$genre>
                        <img class='img' src='../images/covers/".$col_value."'></a>";
                        echo "</span>";
                    }
                }
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
            