<?php
    include './help/fun.php';

    session_destroy();


    header("Location: ".urll('login.php'));
    
