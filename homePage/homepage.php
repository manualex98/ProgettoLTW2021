<?php
  session_start();
?>

<!DOCTYPE html>
<html>
  <head>
    <title>Bookshell</title>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel='shortcut icon' type='image/x-icon' href='../icon.ico'/>
    <link rel="stylesheet" href="homepage.css" type="text/css">
    <script src="../jquery-3.5.1.min.js"></script>

    <script>
      $(document).ready(function(){
        $("#Federico").on({
          mouseenter: function(){
            $("#dev1").css("background-color","#f1f1f1");
          },
          mouseleave: function(){
            $("#dev1").css("background-color","initial");
          }
        });
        $("#Anna").on({
          mouseenter: function(){
            $("#dev2").css("background-color","#f1f1f1");
          },
          mouseleave: function(){
            $("#dev2").css("background-color","initial");
          }
        });
        $("#Mila").on({
          mouseenter: function(){
            $("#dev3").css("background-color","#f1f1f1");
          },
          mouseleave: function(){
            $("#dev3").css("background-color","initial");
          }
        });
      });
    </script>

  </head>
  <body>

    <!-- Navbar (sit on top) -->
    <div class="top">   
      <div class="bar padding" style="letter-spacing:4px;">    
        <a href="#home" class="bar-item">Bookshell</a>
        <!-- Right-sided navbar links -->
        <div class="right">
          <a href="#catalog" class="bar-item">Catalog</a>

          <?php
            if (isset($_SESSION['username'])) {
              echo '<a href="../account/account.php" class="bar-item">Account</a>';
              echo '<a href="../logout.php" class="bar-item">Logout</a>';
            }
            else {
              echo '<a href="../signupPage/signup.html" class="bar-item">Sign Up</a>';
              echo '<a href="../loginPage/login.html" class="bar-item">Login</a>';
            }
          ?>

        </div>
      </div>
    </div>

    <!-- Header -->
    <header style="max-width:1600px; min-width:500px; position:relative; top:-25px;" id="home">
      <img class="image" src="/homePage/h-images/bookshell.jpg" alt="Bookshell" width="1600" height="800"/>
    </header>

    <!-- Page content -->
    <div class="content">

      <!-- Catalog Section -->
      <div class="row padding-64" id="catalog">
        <div class="col padding-large">
          <img src="/homePage/h-images/catalog.jpg" class="image" width="600" height="750">
        </div>

        <div class="col padding-large">
          <h1 class="center">Catalog</h1><br>
          <h5 class="center">A collection of the most beautiful written books</h5>
          <p class="large">Our catalog offers many books in pdf format, selected from the best sellers of the period, some in Italian and others in English </p>
          <p class="large text-grey">Il nostro catalogo offre diversi libri in formato pdf, selezionati tra i best seller d'epoca, alcuni in italiano e altri in inglese</p>
          <p class="large center"><a href="../catalog/catalog.php" class="tag light-grey">Click here</a> to visit the catalog.</p>
        </div>
      </div>
      
      <hr>
      
      <!-- About Us Section -->
      <div class="row padding-64" id="aboutUs">
        <div class="col padding-large">
          <h1 class="center">Developers</h1><br>
          <h4 id="dev1">Federico Montanari</h4>
          <p class="text-grey">Computer engineering student, 23 years old, <a href="https://www.facebook.com/profile.php?id=100001714502494"><img src="h-images/facebook.png" class="social"></a>
             <br>Email: <a href="mailto:montanari.1762065@studenti.uniroma1.it">montanari.1762065@studenti.uniroma1.it</a></p><br>
        
          <h4 id="dev2">Anna Carini</h4>
          <p class="text-grey">Computer engineering student, 22 years old, <a href="https://www.facebook.com/anna.carini.98"><img src="h-images/facebook.png" class="social"></a>
             <br>Email: <a href="mailto:carini.1771784@studenti.uniroma1.it">carini.1771784@studenti.uniroma1.it</a></p><br>
        
          <h4 id="dev3">Mila Allerhand</h4>
          <p class="text-grey">Computer engineering student, 23 years old, <a href="https://www.facebook.com/mila.allerhand"><img src="h-images/facebook.png" class="social"></a>
            <br>Email: <a href="mailto:allerhand.1631223@studenti.uniroma1.it">allerhand.1631223@studenti.uniroma1.it</a></p><br>   
        </div>
        
        <div class="col padding-large" style="padding-top:100px">
        <div class="row">
          <img class="selfie" src="h-images/Federico.jpeg" class="image" id="Federico" style="float:left; margin-left:30px">
          <img class="selfie" src="h-images/Anna.jpg" class="image" id="Anna" style="float:right; margin-right:30px"><br>
        </div>
        <div class="row">
          <img class="selfie" src="h-images/Mila.jpg" class="image" id="Mila" style="margin-left:auto; margin-right:auto; margin-top:30px">
        </div>
        </div>
      </div>

      <hr>

      <!-- Contact Section -->
      <div class="padding-64" id="contact">
        <h1>Contact</h1><br>
        <p>Do you have a book to suggest not yet in our catalog?</p>
        <p class="text-blue-grey large"><b>We can fix it!</b></p>
        <p>You can contact us by email <a href="mailto:bookshell_it@hotmail.com">bookshell_it@hotmail.com</a>, or you can write the information of the book you are looking for directly below:</p>
        <form action="/homePage/sendEmail.php" method="POST" target="_blank">
          <p><input class="padding-16" type="email" placeholder="Your Email Address" name="Email"></p>
          <p><input class="padding-16" type="text" placeholder="Book's Title" required name="Title"></p>
          <p><input class="padding-16" type="text" placeholder="Author" required name="Author"></p>
          <p><input class="padding-16" type="text" placeholder="Publisher" required name="Publisher"></p>
          <p><input class="padding-16" type="number" placeholder="Edition's Year (Optional)" name="Year"></p>
          <br>
          <button class="padding light-grey" style="margin-bottom:16px" type="submit">SEND MESSAGE</button>
        </form>
      </div>
      
    <!-- End page content -->
    </div>

    <!-- Footer -->
    <footer class="center light-grey padding-32">
      <p>Powered by <a href="https://www.uniroma1.it/it/pagina-strutturale/home" title="LaSapienza" target="_blank">Università La Sapienza</a> – <a href="http://www.dis.uniroma1.it/rosati/ltw/" title="LTW" target="_blank">Linguaggi e Tecnologie per il Web 2019/20</a></p>
    </footer>

  </body>
</html>

