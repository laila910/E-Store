<?php
include '../helpers/functions.php';
include '../helpers/checkLogin.php';
include '../helpers/checkPrem.php';
include '../helpers/dbconnection.php';





$sql = "SELECT `suppliers`.* ,`users`.`firstName`,`users`.`lastName` FROM `suppliers` join `users` on `users`.`id` = `suppliers`.`userid` ";

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
                            <li class="breadcrumb-item active">Suppliers Data</li>
                        <?php } ?>



                    </ol>

                    <div class="card mb-4">
                        <div class="card-header">
                            <i class="fas fa-table mr-1"></i>
                            Suppliers Table
                        </div>
                        <div class="card-body">
                            <div class="table-responsive">
                                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                                    <thead>
                                        <tr>
                                            <th>#</th>
                                            <th>SUPPLIER Name</th>
                                            <th>Company Name of supplier </th>
                                            <th>First Address</th>
                                            <th>city</th>
                                            <th>state</th>
                                            <th>Zip Code</th>
                                            <th>Fax</th>
                                            <th> URL</th>
                                            <th>Payment Methods</th>
                                            <th>Disount</th>
                                            <th>Disount Available</th>
                                            <th>Current Order</th>

                                            <th>Action</th>

                                        </tr>
                                    </thead>


                                    <tbody>

                                        <?php

                                        while ($result = mysqli_fetch_assoc($op)) {


                                        ?>
                                            <tr>
                                                <td><?php echo $result['id']; ?></td>
                                                <td><?php echo $result['firstName'] . ' ' . $result['lastName']; ?></td>
                                                <td><?php echo $result['companyname']; ?></td>
                                                <td><?php echo $result['firstaddress']; ?></td>
                                                <td><?php echo $result['city']; ?></td>
                                                <td><?php echo $result['state']; ?></td>
                                                <td><?php echo $result['zipCode']; ?></td>
                                                <td><?php echo $result['fax']; ?></td>
                                                <td><?php echo $result['URL']; ?></td>
                                                <td><?php echo $result['paymentmethods']; ?></td>
                                                <td><?php echo $result['discount']; ?></td>
                                                <td><?php echo $result['discountavailable']; ?></td>
                                                <td><?php echo $result['currentorder']; ?></td>

                                                <td>

                                                    <a href='delete.php?id=<?php echo $result['id']; ?>' class='btn btn-danger m-r-1em'>Delete</a>
                                                    <a href='edit.php?id=<?php echo $result['id']; ?>' class='btn btn-danger m-r-1em'>Edit</a>

                                                </td>

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