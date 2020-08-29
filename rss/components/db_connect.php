<?php

$db = mysqli_connect('localhost', 'LaPyae', 'La09799924744', 'loginapp');
if(!$db){
    echo "Connection Failed" . mysqli_connect_error();
}

?>