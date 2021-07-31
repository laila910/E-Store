<?php
include '../helpers/functions.php';
include '../helpers/checkLogin.php';
include '../helpers/checkPrem.php';
include '../helpers/dbconnection.php';

include '../header.php';



?>

<body class="sb-nav-fixed">
   <?php

include '../nav.php';
?>
    <div id="layoutSidenav">
<?php

include '../sidNave.php';
?>
        <div id="layoutSidenav_content">
            <main>
                <div class="container-fluid">
                    <h1 class="mt-4">Dashboard</h1>
                    <ol class="breadcrumb mb-4">
                       
                       <li class="breadcrumb-item active"> Add Orders</li>
                                   
                    </ol>
                <div class="container">
                   <div>
                         <h1> You cannot add Review  because it is not in your Power </h1>
                   </div>
                
                </div>

                </div>
            </main>
 <?php
include '../footer.php';
 ?>