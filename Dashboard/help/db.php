<?php
$ServerName="localhost"; 
$dbUserName="root"; 
$dbPassword=""; 
$dbName="e-store";

$conn = mysqli_connect($ServerName,$dbUserName,$dbPassword,$dbName);
if(!$conn){
    die("Error".mysqli_connect_error());
}
?>