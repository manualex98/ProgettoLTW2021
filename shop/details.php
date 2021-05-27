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
        
    </head>
    <body class='shop_background'>
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
            
            $ql="select * from books,hasbook,libraries where books.name=$1 and author=$2 and books.name=book and libraries.name=library";
            $result=pg_query_params($dbconn,$ql,array($title,$author));

            while($line= pg_fetch_array($result, null, PGSQL_ASSOC)){
                echo "\t<div>\n";
                foreach($line as $col_value) {
                    echo $col_value;
                }
                echo "\t</div>\n";
            }

            echo "<div class='container'>
            <div class='row text-center'>
                <div class='col-md-6'>";
                    echo "<img class='img img_found' src='../images/covers/".$img."'>
                </div>
                <div class='col-md-6'>
                    <br><br>
                    <h5>Inserire testo qui</h5>
                </div>
            </div>
        </div>";
            
        
            pg_free_result($result);
            pg_close($dbconn);
        ?>
    </body>
</html>