<?php
    session_start();
?>
<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8"/>
        <meta name="viewport" content="width=device-width, initial-scale=1"/>
        <title>Account Details</title>
        <link rel='shortcut icon' type='image/x-icon' href='../icon.ico'/>
        <link rel="stylesheet" href="../style.css" type="text/css"/>
        <link rel="stylesheet" href="account.css" type="text/css"/>
        <script src="../jquery-3.5.1.min.js"></script>
        <script type="text/javascript" lang="javascript" src="details.js"></script>
        
    </head>
    <body class="background-catalog">
        <!-- Navbar (sit on top) -->
        <div class="top">   
            <div class="bar padding" style="letter-spacing:4px; height:40px">    
                <a href="../homePage/homepage.php" class="bar-item">Bookshell</a>
                <!-- <h1>Welcome to your account page</h1> -->
            
                <!-- Right-sided navbar links -->
                <div class="dropdown right">
                    <img src="https://icons-for-free.com/iconfiles/png/512/menu+icon-1320183704805381011.png" class="dropbtn bar-item"></img>
                    <div class="dropdown-content" style="letter-spacing:2px">
                        <a href="../catalog/catalog.php">Catalog</a>
                        <a href="account.php">Account page</a> 
                        <a href="finished.php">Your Finished Books</a>                          
                        <a href="../logout.php">Logout</a>
                        <a href="deleteAccount.php" onclick="return confirmDelete();">Delete your account</a>
                    </div>
                </div>
            </div>
        </div>
    <?php
        if (!isset($_SESSION['username'])) {
            header('Location: ../error.html');
        }
        else {
            $name = $_SESSION['username'];
            $dbconn = pg_connect("host=localhost port=5432 dbname=Bookmark user=postgres password=postgres") 
            or die ('Could not connect: ' . pg_last_error());
            $q1 = "SELECT * FROM users where name='$name'";
            $result = pg_query($q1) or die('Query failed: '. pg_last_error());
            while ($user=pg_fetch_array($result,null,PGSQL_ASSOC)){
                echo "<div class='box-error box-details'><table class='details'>
                    <caption><h3>$name's account details</h3><hr><br></caption>
                    <tr><td><h5>Username:</h5><hr></td><td><h5>$user[name]</h5><hr></td></tr>
                    <tr><td><h5>Email address: </h5><hr><br></td><td><h5>$user[email]</h5><hr><br></td></tr>
                    <tr rowspan='3'><td><h5 style='padding-bottom: 10%!important;'>Change password: </h5></td><td><br>
                        <input type='password' name='inputOldPassword' id='oldPsw' class='input margin' placeholder='Old Password' required'/><br><hr>
                        <input type='password' name='inputPassword' id='newPsw' class='input margin' placeholder='New Password' required onchange='checkPassword();'/><br><hr>
                        <input type='password' name='inputPasswordConfirm' id='newPswConfirm' class='input margin' placeholder='Confirm your new password' required onkeyup='checkPasswordConf();'/><br><hr>
                        <button class='pswButton' name='changePswButton' onclick='return changePassword();'>Change Password</button></td></tr>
                    </table></div>";
            }
        }
    ?>
    </body>
</html>