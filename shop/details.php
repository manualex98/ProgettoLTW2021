<html>
    <head>
        <title>Bookmark-Details</title>
        <meta name="viewport" content="width=device-width, initial−scale=1.0"></meta>
        <meta charset="utf-8"></meta>
        <link rel="stylesheet" type="text/css" href="../bootstrap/css/bootstrap.min.css"/>
        <link rel="stylesheet" type="text/css" href="../style.css"/>
    </head>
    <body>
    <?php
            $title=$_GET['title'];
            $author=$_GET['author'];
            $genre=$_GET['genre'];
            $dbconn= pg_connect("host=localhost port=5432 dbname=Bookmark user=postgres password=postgres")
                or die('Could not connect:'. pg_last_error());

            
            $title = str_replace("-"," ",$title);
            $author = str_replace("-"," ",$author);

            $ql="select * from books,hasbook,libraries where books.name=$1 and author=$2 and books.name=book and libraries.name=library";
            $result=pg_query_params($dbconn,$ql,array($title,$author));

            while($line= pg_fetch_array($result, null, PGSQL_ASSOC)){
                echo "\t<div>\n";
                foreach($line as $col_value) {
                    echo "$col_value";
                }
                echo "\t</div>\n";
            }
            
            echo "<br><br>";
            pg_free_result($result);
            pg_close($dbconn);
        ?>
    </body>
</html>