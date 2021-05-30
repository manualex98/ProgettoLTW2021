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
        <script src="bootstrap/js/bootstrap.min.js" type="text/javascript" lang="javascript"></script>
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
        <link rel="stylesheet" type="text/css" href="bootstrap/css/bootstrap.min.css"/>
        <link rel="stylesheet" type="text/css" href="style.css"/>
        <script src="homepage.js" type="text/javascript" lang="javascript"></script>

    </head>
    <body>
        <!--Navbar-->
        <nav class="navbar navbar-expand-md navbar-expand-lg navbar-dark bg-dark">
            <!--Logo-->
            <a class="navbar-brand" href="#"><h5 class="navbarlogo">BOOKMARK</h5></a>
            <button class="navbar-toggler" data-toggle="collapse" data-target="#navbarResponsive">
                <span class="navbar-toggler-icon"></span>
            </button>
            <span class="collapse navbar-collapse" id="navbarResponsive">
                <!--Menù-->
                <ul class="navbar-nav ml-auto d-flex align-items-end navbar-nav ml-lg-auto">
                    <li id="nav1" class="nav-item active">
                        <a class="nav-link" href="#">HOME</a>
                    </li>
                    <li id="nav2" class="nav-item">
                        <a class="nav-link" href="shop/shop.php">SHOP</a>
                    </li>
                    <li id="nav3" class="nav-item">
                        <a class="nav-link" href="faq/faq.php">FAQ</a>
                    </li>
                    <?php 
                        if(isset($_SESSION['username'])) {


                          
                          echo "<li class='nav-item dropdown'>
                          <a class='nav-link dropdown-toggle' href='#' id='navbarDropdownMenuLink' role='button' data-toggle='dropdown' aria-haspopup='true' aria-expanded='false'>
                          CIAO, ".$_SESSION['username']."
                          </a>
                          <div class='dropdown-menu' aria-labelledby='navbarDropdownMenuLink'>
                            <a class='dropdown-item' href='info_user/account.php'>Account</a>
                            <div class='dropdown-divider'></div>
                            <a class='dropdown-item' href='logout.php'>Logout</a>
                          </div>
                        </li>"; 
                        }
                        else{
                          echo "<li id='nav3' class='nav-item'>
                          <a class='nav-link' href='login/login.html'>LOGIN</a>
                          </li>";
                        }
                    ?>
                    
                </ul>
            </span>
        </nav>
        <!--Header-->
        <header style="max-width:1600px; min-width:500px; position:relative;" id="home">
            <img class="img-fluid" src="images/Bookmark.jpg" alt="Bookshell"/>
        </header>
        <hr>

        <!-- Sezione Servizi   -->
        <div style="border-radius: 4px; background-color: #9fa6ac1f;" class="container">
        <br><h4><strong>I NOSTRI SERVIZI</strong></h4>
        <br>
        <ul class="pagination justify-content-center">
        <div class="row">
                <div class="col-sm-4 text-center">
                            <i class="fa fa-search fa-4x"></i>
                            <div class="card-body">
                                <br>
                                <p class="card-text">Cerca e <strong>scopri</strong> i tuoi libri preferiti consultando il nostro catalogo.</p>
                                <div class="dropdown">  <!-- aiuta col layout -->
                                </div> 
                            </div>
                </div>
              
                <div class="col-sm-4 text-center">
                            <i class="fa fa-map-marker fa-4x" aria-hidden="true"></i>
                            <div class="card-body">
                                <br>
                                <p class="card-text"><strong>Localizza</strong> le librerie intorno a te che hanno quel libro.</p> 
                            </div>
                </div>
              
                <div class="col-sm-4 text-center">
                            <i class="fa fa-eur fa-4x" aria-hidden="true"></i>
                            <div class="card-body">
                                    <br>
                                    <p class="card-text"><strong>Confronta i prezzi</strong> e scegli la soluzione più conveniente.</p>
                            </div>
                </div>
        </ul>
                      </div>
        <hr>

        <!--Page content-->
        <br>
        <div class="container">
            <div class="row text-center">
                <div class="col-md-6">
                    <img class="responsive" src="images/shop.jpg" width="518" height="750">
                </div>
                <div class="col-md-6">
                    <!--inserire testo affiancato all'immagine-->
                    <br><br><br>
                    <i class="fa fa-quote-left fa-3x fa-pull-left" aria-hidden="true"></i>
                    <br>
                    <span id="zonaDinamica">
                    <p class="quote">I do believe something very magical can happen when you read a good book</p>
                    <h4 style="font-weight: bold;">J.K. Rowling </h4>
                </span>
                    <i class="fa fa-quote-right fa-3x fa-pull-right" aria-hidden="true"></i><br><br><br>
                    <button type="button" id="quotes" class="btn btn-dark" onclick=caricaCitazione();>Genera una citazione casuale</button>
                </div>
            </div>
        </div>
        <br><br>
        <!----- Sezione F.A.Q  ------>
        <hr><br>
        
      <!-- Sezione Contattaci -->
      <div class="section clearfix" style="background-color: #9fa6ac1f;">
        <div class="container">
            <div class="row lp-section-content clearfix">
                <div class="col-sm-12">
                    <br>
                    <h3>Non riesci a trovare un libro? </h3>
                    <p>Scrivici per parlare con noi.</p>
                    <div class="calltoaction-right-panel text-center">
                        <a href="mailto:example@example.com" class="btn btn-primary btn-lg" role="button">Contattaci ora!</a>
                    </div>
                    <br>
                </div>      
            </div>     
        </div>
     </div>
        <!--Footer-->
        <footer class="text-center text-lg-start bg-dark text-muted">
            <br>
            <p>  Powered by <a href="https://www.uniroma1.it/it/pagina-strutturale/home" title="LaSapienza" target="_blank">Università La Sapienza</a> – Linguaggi e Tecnologie per il Web</p>
            <br>
        </footer>

        <script>
        var i=1;
        function caricaCitazione(e) {
          var httpRequest = new XMLHttpRequest();
          httpRequest.onreadystatechange = gestisciResponse;
          httpRequest.open("GET","quotes/quote"+i+".html", true);
          httpRequest.send();
        }
        function gestisciResponse(e) {
            if (e.target.readyState == XMLHttpRequest.DONE && e.target.status == 200) {
                document.getElementById("zonaDinamica").innerHTML= e.target.responseText;
                if(i==5){
                    i=1;
                }
                else{
                    i++;
                }
            }
        }
        </script>

    </body>
</html>