<?php

    /* in questa parte vengono stabiliti i valori delle variabili */
    $from = $_POST['Email'];
    $title = $_POST['Title'];
    $author = $_POST['Author'];
    $publisher = $_POST['Publisher'];
    $year = $_POST['Year'];

    $message = "Title: " . $title . "\n" . "Author: " . $author . "\n" . "Publisher: " . $publisher . "\n" . "Edition's year: " . $year;

    $to = "bookshell_it@hotmail.com";

    $headers  = "MIME-Version: 1.0" . "\r\n";
    $headers .= "Content-type: text/html; charset=iso-8859-1" . "\r\n";
    $headers .= "From: ". trim($from) . "\r\n";         //trim rimuove gli spazi bianchi all'inizio e alla fine
    $headers .= "Reply-To: ". trim($from). "\r\n";
    $headers .= "X-Mailer: PHP/" . phpversion();
    $headers .= "X-Priority: 1" . "\r\n";

    /* invio mail */
    if(mail($to, "Book to add", $message, $headers)) {
        echo '<body class="background"';
        echo '<div class="box">';
        echo '<h1>Mail sent successfully! Thank you for your suggestion</h1><br>';
        echo '<div><a href="../loginPage/login.html">click here</a> to return to Homepage.</div><br>';
        echo '</div>';
        echo '</body>';
    }
    else {
        echo "<script type='text/javascript'>alert('An error occurred while sending');</script>";
    }
?>
