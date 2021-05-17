<?php
    session_start();
?>

<html>
    <head>
        <link rel='shortcut icon' type='image/x-icon' href='../icon.ico'/>
        <link rel="stylesheet" href="../style.css" type="text/css"/>
        <title>Book already saved</title>
    </head>

    <body class="background">

        <div class="box-error" style="height:350px; margin-top:10%">
            <img src="../loginPage/l-images/ancient-book.png" width="180" height="130">
            <br><br><br>
            <h1 style="letter-spacing:0px; font-size: 32px;">
                <?php
                    if (isset($_SESSION['username'])) {
                        $name = $_SESSION['username'];
                        echo "Hi $name, this book is already in your private  
                        <a href='../account/account.php'><u>BookShell</u></a>!";
                    }
                ?>
            </h1>
            <br><br>
        </div>
    </body>
</html>