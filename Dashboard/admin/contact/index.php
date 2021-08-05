<?php
include '../helpers/functions.php';
include '../helpers/checkLogin.php';
include '../helpers/checkPrem.php';
include '../helpers/dbconnection.php';





$sql = "SELECT `contact`.*,`users`.`firstName`,`users`.`lastName` FROM `contact` join `users` on `contact`.`userId`=`users`.`id` ORDER BY `contact`.`id` desc  ";

$op  = mysqli_query($conn, $sql);



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
                    <h1 class="mt-4">Tables</h1>
                    <ol class="breadcrumb mb-4">


                        <?php


                        if (isset($_SESSION['errors'])) {

                            foreach ($_SESSION['errors'] as $key =>  $value) {

                                echo '* ' . $key . ' : ' . $value . '<br>';
                            }

                            unset($_SESSION['errors']);
                        } else {
                        ?>

                            <li class="breadcrumb-item"><a href="index.html">Dashboard</a></li>
                            <li class="breadcrumb-item active">Categories Data</li>
                        <?php } ?>



                    </ol>

                    <div class="card mb-4">
                        <div class="card-header">
                            <i class="fas fa-table mr-1"></i>
                            Product Table
                        </div>
                        <div class="card-body">
                            <div class="table-responsive">
                                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                                    <thead>
                                        <tr>
                                            <th>#</th>
                                            <th>Customer Name </th>
                                            <th>Subject </th>
                                            <th>Message</th>

                                        </tr>
                                    </thead>


                                    <tbody>

                                        <?php

                                        while ($result = mysqli_fetch_assoc($op)) {


                                        ?>
                                            <tr>
                                                <td><?php echo $result['id']; ?></td>
                                                <td><?php echo $result['firstName'] . ' ' . $result['lastName']; ?></td>
                                                <td><?php echo $result['subject']; ?></td>
                                                <td><?php echo $result['message']; ?></td>


                                            </tr>
                                        <?php } ?>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </main>
            <?php
            include '../footer.php';
            ?>