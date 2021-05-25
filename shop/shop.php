<html>
    <head></head>
    <body>
        <?php
            $dbconn= pg_connect("host=localhost port=5432 dbname=Bookmark user=postgres password=postgres")
                or die('Could not connect:'. pg_last_error());
            
            $title = $_POST['inputTitle'];
            $author = $_POST['inputAuthor'];
            $genre = $_POST['inputGenre'];
            $ql="select * from books where name=$1 and author=$2 and genre=$3";

            $result=pg_query_params($dbconn, $ql, array($title,$author,$genre));
            
            /*if(!($line= pg_fetch_array($result, null, PGSQL_ASSOC))){
                echo "<br><h1> Sorry, this book doesn't exist</h1>
                <a href=../shop/shop.html>Click here to return to shop</a>";
            }*/
            echo "<table>\n" ;

            while($line= pg_fetch_array($result, null, PGSQL_ASSOC)){
                echo "\t<tr>\n" ;
                foreach($line as $col_value) {
                    echo "\t\t<td>$col_value</td>" ;
                }
                echo "\t</tr>\n" ;
            }
            echo "</table>\n" ;
                
            
            
            
            pg_free_result($result);
            pg_close($dbconn) ;
        ?>
    </body>
</html>
            