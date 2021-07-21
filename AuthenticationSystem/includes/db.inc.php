<?php
$servername='localhost';
$dbusername='root';
$dbpassword='';
$dbname='e-store';

$conn = mysqli_connect($servername,$dbusername,$dbpassword,$dbname);

if(!$conn){
    die("Connection Faild :".mysqli_connect_error());
}


?>