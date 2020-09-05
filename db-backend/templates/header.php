<?php
$lihtml = "<li><form action='index.php' method='post'><button type='submit' name='navbutton' class='btn brand' value='index.php'>Your Videos</button></form></li><li><form action='index.php' method='post'><button type='submit' name='navbutton' class='btn brand' value='addVideo.php'>Add User</button></form></li>";
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <title>Backend</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/materialize/1.0.0/css/materialize.min.css">
    <style type=text/css> form{margin:0 !important; padding:0px 5px !important} .brand { background: #ADD8E6 !important; } .brand-text { color:#ADD8E6 !important; } form{ margin: 20px auto; padding:20px; max-width: 460px;}</style> 
</head>
<body class="grey lighten-4">
    <nav>
        <div class="container">
            <a href="index.php" class="brand-logo brand-text">Login System
            </a>
            <ul id="nav-mobile" class="right hide-on-small-and-down">
                <?php echo $lihtml ?>
            </ul>
        </div>
    </nav>