<?php
  session_start();
?>
<!DOCTYPE html>
<html>
    <head>
        <title>Bookmark-Details</title>
        <meta name="viewport" content="width=device-width, initial−scale=1.0"></meta>
        <meta charset="utf-8"></meta>
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.4.0/css/font-awesome.min.css">
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script> 
        <script src="../bootstrap/js/bootstrap.min.js" type="text/javascript" lang="javascript"></script>
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
        <link rel="stylesheet" type="text/css" href="../bootstrap/css/bootstrap.min.css"/>
        <link rel="stylesheet" type="text/css" href="../style.css"/>
        <script src="details.js" type="text/javascript" lang="javascript"></script>
    </head>

    <body class='shop_background'>
        <!--Navbar-->
        <nav class="navbar navbar-expand-md navbar-expand-lg navbar-dark bg-dark sticky-top">
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
                        <a class="nav-link" href="shop.php">SHOP</a>
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
                    <h1 class='h1-w font-weight-bolder'>".$title."</h1><h5 class='h5-w font-weight-bolder'>".$author."</h5><br>
                    <h4 class='h4-w font-weight-bolder' >Questo libro è disponibile in queste librerie:</h4>";
                    echo "\t<table class='table table-dark table-striped'>\n" ;
                    while($line= pg_fetch_array($result, null, PGSQL_ASSOC)){
                        echo "\t<tr><td>\n" ;
                        
                        echo "<h5 class='font-weight-bolder'><b>".$line['library']."</b> situato in <b>".$line['city']. "</b>  in <b>".$line['address']."</b></h5><br>";
                        if($line['quantity']>0){
                            if($line['quantity']==1){
                                echo "<h5 class='h5-w font-weight-bolder'>Disponibilità: <h5><b>".$line['quantity']."</b></h5> <h4 class='h4-r font-weight-bolder'>ULTIMO DISPONIBILE!!! </h4><h4 class='h4-w font-weight-bolder'>Prezzo: <b>" .$line['price']."€</b></h4>";
                            }
                            else{
                                echo "<h5 class='h5-w font-weight-bolder'>Disponibilità: </h5><h5><b>".$line['quantity']."</b></h5><h4 class='h4-w font-weight-bolder'>Prezzo: <b>" .$line['price']."€</b></h4>";
                            }

                            if(isset($_SESSION['username'])){
                                $query="select * from booking where username=$1 and book=$2 and library=$3";
                                $risultato=pg_query_params($dbconn,$query,array($_SESSION['username'],$title,$line['library']));
                                if($line_book= pg_fetch_array($risultato, null, PGSQL_ASSOC)){
                                    echo "<a href='booking.php?book=$title&library=".$line['library']."&genre=$genre&author=$author&img=$img&action=r'><button name='bookbutton' class='btn btn-outline-light book-button' data-toggle='button'>Annulla</button></a>";
                                }
                                else{
                                    echo "<a href='booking.php?book=$title&library=".$line['library']."&genre=$genre&author=$author&img=$img&action=i'><button name='bookbutton' class='btn btn-outline-light book-button' data-toggle='button'>Prenota ora</button></a>";
                                }
                            }
                            else{
                                echo "<button name='bookbutton' class='btn btn-outline-light book-button' data-toggle='button' disabled>Prenota ora</button>";
                            }
                        }
                        else{
                            echo "<h5 class='h5-w font-weight-bolder'>Disponibilità: <h5><b>".$line['quantity']."</b></h5> <h4 class='h4-r font-weight-bolder'>TERMINATI!!!</h4><h4 class='h4-w font-weight-bolder'>Prezzo: <b>" .$line['price']."€</b></h4>";
                            if(isset($_SESSION['username'])){
                                $query="select * from booking where username=$1 and book=$2 and library=$3";
                                $risultato=pg_query_params($dbconn,$query,array($_SESSION['username'],$title,$line['library']));
                                if($line_book= pg_fetch_array($risultato, null, PGSQL_ASSOC)){
                                    echo "<a href='booking.php?book=$title&library=".$line['library']."&genre=$genre&author=$author&img=$img&action=r'><button name='bookbutton' class='btn btn-outline-light book-button' data-toggle='button'>Annulla</button></a>";
                                }
                                else{
                                    echo "<button name='bookbutton' class='btn btn-outline-light book-button' data-toggle='button' disabled>Prenota ora</button>";
                                }
                            
                            }
                            else{
                                echo "<button name='bookbutton' class='btn btn-outline-light book-button' data-toggle='button' disabled>Prenota ora</button>";
                            }
                            
                        }
                        echo "</td>\t</tr>\n" ;
                    }
                    echo "\t</table>\n" ;
                    
                    if(isset($_SESSION['username'])){
                        $ql="select * from lovesbook where username=$1 and book=$2";
                        $result=pg_query_params($dbconn,$ql,array($_SESSION['username'],$title));
                        if($line= pg_fetch_array($result, null, PGSQL_ASSOC)){
                            echo "<div class=text-center>
                            <a href='insert_wishlist.php?book=$title&genre=$genre&author=$author&img=$img&action=r'><h6 class='h6-w font-weight-bolder'><i class='fa fa-heart fa-red'></i></a>Aggiunto ai preferiti</h6>
                            </div> ";
                        }
                        else{
                            echo "<div class=text-center>
                            <a href='insert_wishlist.php?book=$title&genre=$genre&author=$author&img=$img&action=i'><h6 class='h6-w font-weight-bolder'><i class='fa fa-heart-o fa-white'></i></a>Aggiungi ai preferiti</h6>
                            </div> ";
                        }
                    }
                    
                    
                echo "</div>";
            echo "</div>";
        echo "</div>";
       
        

            
            pg_free_result($result);
            pg_close($dbconn);
        ?>
        <br>
        
        <!--Qui visualizzo la trama-->
        <button id="dettagli" style="margin-left:6.5%; margin-right: 6.5%;" onclick="caricaDocumento1()" class="btn btn-outline-light" data-toggle="button" aria-pressed="false"> Altri dettagli </button>
        <div id="zonaDinamica" class="section clearfix" style="background-color: #343a40; margin-left:6.5%; margin-right:6.5%; text-align:left;">
        </div>

        <!--Footer-->
        <footer class="text-center text-lg-start bg-dark text-muted">
            <br>
            <p>  Powered by <a href="https://www.uniroma1.it/it/pagina-strutturale/home" title="LaSapienza" target="_blank">Università La Sapienza</a> – Linguaggi e Tecnologie per il Web</p>
            <br>
        </footer>

        <div style="display:none" id="hiddentitle"><?php echo $_GET['title'];?></div>
        
        <!-- script alla fine così carica più in fretta-->
        <script>
        document.getElementById("dettagli").onclick=caricaDocumento1;
        function caricaDocumento1(e) {
          var httpRequest = new XMLHttpRequest();
          httpRequest.onreadystatechange = gestisciResponse1;
          httpRequest.open("GET","../trame/"+document.getElementById('hiddentitle').innerHTML+".html", true);
          httpRequest.send();
        }
        function gestisciResponse1(e) {
            if (e.target.readyState == XMLHttpRequest.DONE && e.target.status == 200) {
                document.getElementById("zonaDinamica").innerHTML= e.target.responseText;
            }
        }
        </script>
    </body>
</html>