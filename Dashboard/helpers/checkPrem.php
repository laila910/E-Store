<?php 
include './functions.php';
  include './checkLogin.php';
  include './dbconnection.php';

    if($_SESSION['User']['group_id'] == 2){ //login as admin

        header("Location: ".url('index.php'));
    }
   //remember to ask 3shan twdy el manager as example for some pages ,mean more than one page 


?>