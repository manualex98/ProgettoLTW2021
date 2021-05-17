<?php
    session_start();
?> 

<!DOCTYPE html>
<html>
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <link rel='shortcut icon' type='image/x-icon' href='../icon.ico'/>
        <link rel="stylesheet" href="../style.css" type="text/css"/>
        <link rel="stylesheet" href="account.css" type="text/css"/>
        <script type="text/javascript" src="../jquery-3.5.1.min.js" lang="javascript"></script>
        <script type="text/javascript" src="account.js" lang="javascript"></script>
        <title>Account</title>
    </head>

    <body class="background-account" onload="start();">

        <!-- Navbar (sit on top) -->
        <div class="top">   
            <div class="bar padding" style="letter-spacing:4px; height:40px">    
                <a href="../homePage/homepage.php" class="bar-item">Bookshell</a>
            
                <!-- Right-sided navbar links -->
                <div class="dropdown right">
                    <img src="https://icons-for-free.com/iconfiles/png/512/menu+icon-1320183704805381011.png" class="dropbtn bar-item"></img>
                    <div class="dropdown-content" style="letter-spacing:2px">
                        <a href="../catalog/catalog.php">Catalog</a> 
                        <a href="details.php">Account details</a>  
                        <a href="finished.php">Your Finished Books</a>                        
                        <a href="../logout.php">Logout</a>
                        <a href="deleteAccount.php" onclick="return confirmDelete();">Delete your account</a>
                    </div>
                </div>
            </div>
        </div>
        
        <div class="reading-books">
            <img class="img-frame" src="a-images/reading.png" width="150px" height="auto"/>
            <div id="reading-catalog"></div>
        </div>
        
        <div class="saved-books">
            <img class="img-frame" src="a-images/saved.png" width="150px" height="auto"/>
            <div id="saved-catalog"></div>
        </div>
        
        <!-- footer -->
        <div class="check-catalog">
            <h5>Check our <a href="../catalog/catalog.php" style="text-decoration:underlined!important">catalog</a> to save more books in your account page</h5>
        </div>

        
        <?php
            $dbconn = pg_connect("host=localhost port=5432 dbname=BookShell user=postgres password=anna")
			or die ('Could not connect: ' . pg_last_error());

			if (!(isset($_SESSION['username']))) {         //se questa pagina php non è stata chiamata dopo l'accesso all'account
				header('Location: ../error.html');
			}
			else {
                
                $name=$_SESSION['username'];
				$savedquery = "SELECT b.title, b.author, b.genre, b.pages, b.pdf, b.img, u.page FROM usersbooks u JOIN books b on u.pdf = b.pdf WHERE page=-1 and name='$name'";
				$savedresult = pg_query($savedquery) or die('Query failed: '. pg_last_error());
                $savedbooks=array();
                
				while ($savedbook=pg_fetch_array($savedresult,null,PGSQL_ASSOC)){
					$savedbooks[]=$savedbook;
				}
				
				$readingquery = "SELECT b.title, b.author, b.genre, b.pages, b.pdf, b.img, u.page FROM usersbooks u JOIN books b on u.pdf = b.pdf WHERE NOT page=-1 AND NOT page=pages  and name='$name'";
				$readingresult = pg_query($readingquery) or die('Query failed: '. pg_last_error());
                $readingbooks=array();
                
				while ($readingbook=pg_fetch_array($readingresult,null,PGSQL_ASSOC)){
					$readingbooks[]=$readingbook;
				}
                
				$savedbooksJson=json_encode($savedbooks);
				$readingbooksJson=json_encode($readingbooks);
			
			    echo    "<script type='text/javascript'>
                            insertBooksInStorage(0,$savedbooksJson);
                            insertBooksInStorage(1,$readingbooksJson);
                        </script>";
            }
        ?>
        <script type="text/javascript">
            drawBooks(0,"saved");
            drawBooks(1,"reading");
        </script>

        <div class="modal">
            <div class="modal-content">
                <span class="close-button">&times;</span>
                <div id="modal-div"></div>
            </div>
        </div>
    </body>
</html>