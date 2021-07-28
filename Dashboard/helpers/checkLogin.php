<?php 


if(!isset($_SESSION['useremail'])){

    header("Location: ".url('login.php'));
}

?>