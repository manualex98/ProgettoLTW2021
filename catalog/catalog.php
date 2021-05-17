<?php
    session_start();
?>

<!DOCTYPE html>
<html>
    <head>
        <title>Catalog</title>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <link rel='shortcut icon' type='image/x-icon' href='../icon.ico'/>
        <link rel="stylesheet" href="../style.css" type="text/css"/>
        <link rel="stylesheet" href="catalog.css" type="text/css"/>
        <script type="text/javascript" src="catalog.js" lang="javascript"></script>
    </head>
    
    <body class="background-catalog" onload="start();">
        
        <!-- STRUTTURA PAGINA: -->

        <!-- Navbar (sit on top) -->
        <div class="top">   
            <div class="bar padding" style="letter-spacing:4px; height:40px">    
                <a href="../homePage/homepage.php" class="bar-item">Bookshell</a>   
                <!-- Right-sided navbar links -->
                <div class="right">
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

        <div class="container">
            
            <div class="left-col">
                
                <!-- FILTRI -->
                <h1>Filters</h1>
                <br/>
                <form name="filtersForm">
                    Genre:
                    <select size="1" class="select-css" name="genre">
                        <option selected value="none">-
                        <option value="Romance">Romance
                        <option value="Adventure">Adventure
                        <option value="Fantasy">Fantasy
                        <option value="Crime">Crime
                        <option value="Historical">Historical
                        <option value="Thriller">Thriller
                        <option value="Novel">Novel
                        <option value="Modern Novel">Modern Novel
                        <option value="Horror">Horror
                        <option value="Mystery">Mystery
                        <option value="Suspense">Suspense
                        <option value="Science Fiction">Science Fiction
                        <option value="Fiction">Fiction
                    </select>
                    <br/><br/>
                    Author:
                    <select size="1" name="author">
                        <option selected value="none">-
                        <?php
                            $dbconn = pg_connect("host=localhost port=5432 dbname=BookShell user=postgres password=anna")
                                        or die ('Could not connect: ' . pg_last_error());

                            $query = "SELECT DISTINCT author FROM books";
                            $result = pg_query($query) or die('Query failed: '. pg_last_error());
                            while ($row = pg_fetch_array($result, null, PGSQL_ASSOC)) {
                                $author = $row['author'];
                                echo '<option value="'.$author.'">'.$author;
                            }
                        ?>
                    </select>


                    <br/><br/>
                    Pages:
                    <select size="1" name="pages">
                        <option selected value="none">-
                        <option value="0-100">Less than 100
                        <option value="100-200">Between 100 and 200
                        <option value="200-350">Between 200 and 350
                        <option value="350-500">Between 350 and 500
                        <option value="500-10000">More than 500
                    </select>
                    <br/><br/>
                    <input type="button" id ="applyFiltersButton" class="filterButton" value="Apply filters"/>
                    <input type="reset" id ="resetFiltersButton" class="filterButton" value="Reset filters"/>
                </form>
            </div>

            <!-- LIBRI -->
            <div class="center-col" id="catalog">
            </div>

            <!-- BARRA DI RICERCA -->
            <div class="right-col">
                <!-- nota: senza form perché altrimenti cliccando invio si ricarica la pagina senza fare la ricerca -->
                <h1>Search</h1><br/>
                <div class="search">
                    <input type="text" id="searchField" class="searchTerm" maxlength="50" placeholder="Search by title or author"/>
                    <input type="button" id="searchButton" class="searchButton"/>
                </div>
            </div>
        </div>
        
        <footer class="light-grey padding-8" style="text-align:center;">
            <p>Powered by <a href="https://www.uniroma1.it/it/pagina-strutturale/home" title="LaSapienza" target="_blank">Università La Sapienza</a> – <a href="http://www.dis.uniroma1.it/rosati/ltw/" title="LTW" target="_blank">Linguaggi e Tecnologie per il Web 2019/20</a></p>
        </footer>


        <!-- leggi la tabella books dal database e inizializza books_array -->
        <?php
            $dbconn = pg_connect("host=localhost port=5432 dbname=BookShell user=postgres password=anna")
            or die ('Could not connect: ' . pg_last_error());

            $query = "SELECT * FROM books";
            $result = pg_query($query) or die('Query failed: '. pg_last_error());
            $books=array();
            while ($book=pg_fetch_array($result,null,PGSQL_ASSOC)){
                $books[]=$book;
            }
            $booksJson=json_encode($books);
            echo    '<script type="text/javascript">',
                        "insertBooksInStorage($booksJson);",
                    '</script>';
        ?>

        <!-- aggiungi i libri al div con id=catalog -->
        <script type="text/javascript">
            drawBooks();
        </script>
        

        <!-- MODAL: -->
        <div class="modal">
            <div class="modal-content">
                <span class="close-button">&times;</span>
                <div id="modal-div"></div>
            </div>
        </div>
    </body>
</html>