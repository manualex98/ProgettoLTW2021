<?php
session_start();
?>

<!DOCTYPE html>
<html>
  <head>
      <title>Bookmark - FAQ</title>
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
        <nav class="navbar navbar-expand-md navbar-expand-lg navbar-dark bg-dark">
            <!--Logo-->
            <a class="navbar-brand" href="../homepage.php"><h5 class="navbarlogo">BOOKMARK</h5></a>
            <button class="navbar-toggler" data-toggle="collapse" data-target="#navbarResponsive">
                <span class="navbar-toggler-icon"></span>
            </button>
            <span class="collapse navbar-collapse" id="navbarResponsive">
                <!--Menù-->
                <ul class="navbar-nav ml-auto d-flex align-items-end navbar-nav ml-lg-auto">
                    <li id="nav1" class="nav-item">
                        <a class="nav-link" href="../homepage.php">HOME</a>
                    </li>
                    <li id="nav2" class="nav-item">
                        <a class="nav-link" href="../shop/shop.php">SHOP</a>
                    </li>
                    <li id="nav2" class="nav-item active">
                        <a class="nav-link" href="#">FAQ</a>
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
                          <a class='nav-link' href='login/login.html'>LOGIN</a>
                          </li>";
                        }
                    ?>
                    
                </ul>
            </span>
        </nav>
        <!-- Sezione FAQ -->
        <br><br><h4><strong>Le domande più frequenti</strong> </h4>
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
                    Non riesco a trovare un libro, come posso fare?
                  </button>
                </h2>
              </div>
              <div id="collapseThree" class="collapse" aria-labelledby="headingThree" data-parent="#accordionExample">
                <div class="card-body">
                  Mandaci un email all'indirizzo <a href="mailto:bookmark.ltw@gmail.com">bookmark.ltw@gmail.com</a> per suggerirci quali libri aggiungere al catalogo.
                </div>
              </div>
            </div>
      </ul>
      <br><br><br><br><br><br><br><br><br><br><br><br>
      <!--Footer-->
      <footer class="text-center text-lg-start bg-dark text-muted">
            <br>
            <p>  Powered by <a href="https://www.uniroma1.it/it/pagina-strutturale/home" title="LaSapienza" target="_blank">Università La Sapienza</a> – Linguaggi e Tecnologie per il Web</p>
            <br>
        </footer>
</body>
</html>