<?php
 session_start();

 function url($dis){

  return   $txt = "http://".$_SERVER['HTTP_HOST']."/E-Store/Dashboard/".$dis;


 }
?>