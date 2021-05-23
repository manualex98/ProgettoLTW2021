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
        <title>Your Finished Books</title>
    </head>

    <body class="background-catalog" onload="start();">

        <!-- Navbar (sit on top) -->
        <div class="top">   
            <div class="bar padding" style="letter-spacing:4px; height:40px">    
                <a href="../homePage/homepage.php" class="bar-item">Bookshell</a>
            
                <!-- Right-sided navbar links -->
                <div class="dropdown right">
                    <img src="https://icons-for-free.com/iconfiles/png/512/menu+icon-1320183704805381011.png" class="dropbtn bar-item"></img>
                    <div class="dropdown-content" style="letter-spacing:2px">
                        <a href="../catalog/catalog.php">Catalog</a>
                        <a href="account.php">Account page</a> 
                        <a href="details.php">Account details</a>                          
                        <a href="../logout.php">Logout</a>
                        <a href="deleteAccount.php" onclick="return confirmDelete();">Delete your account</a>
                    </div>
                </div>
            </div>
        </div>
        
        
        <div class="finished-books">
            <div id="finished-catalog"></div>
        </div>
        
        <!-- footer -->
        <div class="check-catalog">
            <h5>Go back to <a href="account.php" style="text-decoration:underlined!important">Account</a> to view your in reading and saved books</h5>
        </div>

        
        <?php
            $dbconn = pg_connect("host=localhost port=5432 dbname=Bookmark user=postgres password=postgres") or die ('Could not connect: ' . pg_last_error());

			if (!(isset($_SESSION['username']))) {         //se questa pagina php non è stata chiamata dopo l'accesso all'account
				header('Location: ../error.html');
			}
			else {
                
                $name=$_SESSION['username'];
				$finishedquery = "SELECT b.title, b.author, b.genre, b.pages, b.pdf, b.img FROM usersbooks u JOIN books b on u.pdf = b.pdf WHERE u.page=b.pages and name='$name'";
				$finishedresult = pg_query($finishedquery) or die('Query failed: '. pg_last_error());
                $finishedbooks=array();
                $num=0;
				while ($finishedbook=pg_fetch_array($finishedresult,null,PGSQL_ASSOC)){
                    $num+=1;
					$finishedbooks[]=$finishedbook;
                }
                if($num==1){
                    $books="book";
                }
                else{
                    $books="books";
                }
                
                
				$finishedbooksJson=json_encode($finishedbooks);
				
			
                echo    "<div class='numfin-books'><h5>$name, you've finished $num $books from our catalog : </h5></div>
                        <script type='text/javascript'>
                            insertBooksInStorage(-2,$finishedbooksJson);
                        </script>";
            }
        ?>
        <script type="text/javascript">
            drawBooks(-2,"finished");
        </script>

        <div class="modal">
            <div class="modal-content">
                <span class="close-button">&times;</span>
                <div id="modal-div"></div>
            </div>
        </div>
    </body>
</html>