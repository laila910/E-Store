<?php
include '../helpers/functions.php';
include '../helpers/checkLogin.php';
include '../helpers/checkPrem.php';
include '../helpers/dbconnection.php';





$sql = "SELECT `customers`.* ,`users`.`firstName` FROM `customers` join `users` on `customers`.`usersid` = `users`.`id` ORDER BY `customers`.`id` desc ";

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
                            <li class="breadcrumb-item active">Customers Data</li>
                        <?php } ?>



                    </ol>

                    <div class="card mb-4">
                        <div class="card-header">
                            <i class="fas fa-table mr-1"></i>
                            Customers Table
                        </div>
                        <div class="card-body">
                            <div class="table-responsive">
                                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                                    <thead>
                                        <tr>
                                            <th>#</th>
                                            <th>Customer Name </th>
                                            <th>address</th>
                                            <th>country</th>
                                            <th>city </th>
                                            <th>state </th>
                                            <th>zipCode</th>
                                            <th>anotheraddress</th>
                                            <th>creditcard</th>
                                            <th>creditcardtypeid </th>
                                            <th>cardExpMon</th>
                                            <th>cardExpYr </th>
                                            <th>shipaddress</th>
                                            <th>shipcountry</th>
                                            <th>shipcity </th>
                                            <th>shipstate</th>
                                            <th>shipzipcode </th>
                                            <th>dateRegistered </th>
                                            <th>billingaddress</th>
                                            <th>billingcountry</th>
                                            <th>billingcity</th>
                                            <th>billingstate</th>
                                            <th>billingzipcode</th>

                                            <th>Action</th>

                                        </tr>
                                    </thead>


                                    <tbody>

                                        <?php

                                        while ($result = mysqli_fetch_assoc($op)) {


                                        ?>
                                            <tr>
                                                <td><?php echo $result['id']; ?></td>
                                                <td><?php echo $result['firstName']; ?></td>
                                                <td><?php echo $result['address']; ?></td>
                                                <td><?php echo $result['country']; ?></td>
                                                <td><?php echo $result['city']; ?></td>
                                                <td><?php echo $result['state']; ?></td>
                                                <td><?php echo $result['zipCode']; ?></td>
                                                <td><?php echo $result['anotheraddress']; ?></td>
                                                <td><?php echo $result['creditcard']; ?></td>
                                                <td><?php echo $result['creditcardtypeid']; ?></td>
                                                <td><?php echo $result['cardExpMon']; ?></td>
                                                <td><?php echo $result['cardExpYr']; ?></td>
                                                <td><?php echo $result['shipaddress']; ?></td>
                                                <td><?php echo $result['shipcountry']; ?></td>
                                                <td><?php echo $result['shipcity']; ?></td>
                                                <td><?php echo $result['shipstate']; ?></td>
                                                <td><?php echo $result['shipzipcode']; ?></td>
                                                <td><?php echo $result['dateRegistered']; ?></td>
                                                <td><?php echo $result['billingaddress']; ?></td>
                                                <td><?php echo $result['billingcountry']; ?></td>
                                                <td><?php echo $result['billingcity']; ?></td>
                                                <td><?php echo $result['billingstate']; ?></td>
                                                <td><?php echo $result['billingzipcode']; ?></td>

                                                <td>

                                                    <a href='delete.php?id=<?php echo $result['id']; ?>' class='btn btn-danger m-r-1em'>Delete</a>

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