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
        <link rel="stylesheet" type="text/css" href="bootstrap/css/bootstrap.min.css"/>
        <link rel="stylesheet" type="text/css" href="style.css"/>
        
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
                    <?php 
                        if(isset($_SESSION['username'])) {
                          echo "<li id='nav4' class='nav-item'> 
                          <div class='dropdown'>
                            <button class='dropbtn '>Ciao, ".$_SESSION['username']."</button>
                            <div class='dropdown-content'>
                              <a href='info_user/account.php'>Account</a>
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
        <!--Header-->
        <header style="max-width:1600px; min-width:500px; position:relative; top:-25px;" id="home">
            <img class="img-fluid" src="images/Bookmark.jpg" alt="Bookshell"/>
        </header>
        <hr>
        <div class="text-center slide">
            <p>"I do believe </p>
            <p>something very magical </p>
            <p>can happen when you read a good book"</p>
            <p>J.K.Rowling</p>
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
                    <p>Inserire testo qui</p>
                    
                </div>
            </div>
        </div>
        <br><br>
        <!----- Sezione F.A.Q  ------>
        <hr><br>
        <h4><strong>Le domande più frequenti</strong> </h4>
        <br>
        <ul class="pagination justify-content-center">
          <div class="accordion" id="accordionExample">
            <div class="card">
              <div class="card-header" id="headingOne">
                <h2 class="mb-0">
                  <button class="btn btn-link" type="button" data-toggle="collapse" data-target="#collapseOne" aria-expanded="true" aria-controls="collapseOne">
                    A cosa serve Bookmark?
                  </button>
                </h2>
              </div>
          
              <div id="collapseOne" class="collapse show" aria-labelledby="headingOne" data-parent="#accordionExample">
                <div class="card-body">
                  Bookmark è un portale che ti permette di cercare i tuoi libri preferiti e scoprire le librerie dove poterli acquistare.
                </div>
              </div>
            </div>
            <div class="card">
              <div class="card-header" id="headingTwo">
                <h2 class="mb-0">
                  <button class="btn btn-link collapsed" type="button" data-toggle="collapse" data-target="#collapseTwo" aria-expanded="false" aria-controls="collapseTwo">
                    Come posso cercare un libro?
                  </button>
                </h2>
              </div>
              <div id="collapseTwo" class="collapse" aria-labelledby="headingTwo" data-parent="#accordionExample">
                <div class="card-body">
                  Ti basterà visitare la sezione "Shop" ed effettuare la tua ricerca inserendo titolo, autore e genere del libro.
                </div>
              </div>
            </div>
            <div class="card">
              <div class="card-header" id="headingThree">
                <h2 class="mb-0">
                  <button class="btn btn-link collapsed" type="button" data-toggle="collapse" data-target="#collapseThree" aria-expanded="false" aria-controls="collapseThree">
                    Domanda 3
                  </button>
                </h2>
              </div>
              <div id="collapseThree" class="collapse" aria-labelledby="headingThree" data-parent="#accordionExample">
                <div class="card-body">
                  Risposta 3
                </div>
              </div>
            </div>
            <div class="card">
              <div class="card-header" id="headingFour">
                <h2 class="mb-0">
                  <button class="btn btn-link collapsed" type="button" data-toggle="collapse" data-target="#collapseFour" aria-expanded="false" aria-controls="collapseFour">
                    Domanda 4
                  </button>
                </h2>
              </div>
              <div id="collapseFour" class="collapse" aria-labelledby="headingFour" data-parent="#accordionExample">
                <div class="card-body">
                  Risposta 4
                </div>
              </div>
            </div>
            <div class="card">
              <div class="card-header" id="headingFive">
                <h2 class="mb-0">
                  <button class="btn btn-link collapsed" type="button" data-toggle="collapse" data-target="#collapseFive" aria-expanded="false" aria-controls="collapseFive">
                    Domanda 5
                  </button>
                </h2>
              </div>
              <div id="collapseFive" class="collapse" aria-labelledby="headingFive" data-parent="#accordionExample">
                <div class="card-body">
                  Risposta 5
                </div>
              </div>
            </div>
          </div>
      </ul>
      <br><br>
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
    </body>
</html>