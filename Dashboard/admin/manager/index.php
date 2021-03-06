<?php
include '../helpers/functions.php';
include '../helpers/checkLogin.php';
include '../helpers/checkPrem.php';
include '../helpers/dbconnection.php';





$sql = "SELECT `manager`.* ,`suppliers`.`companyname`,`product`.`productname`,`users`.`firstname`,`users`.`lastName` FROM `manager` join `suppliers` on `manager`.`supplierid` = `suppliers`.`id` join `product` on `product`.`id`=`manager`.`product_id` join `users` on `users`.`id`=`manager`.`userid` ORDER BY `manager`.`id_manager` desc  ";

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
                            <li class="breadcrumb-item active">Manager Data</li>
                        <?php } ?>



                    </ol>

                    <div class="card mb-4">
                        <div class="card-header">
                            <i class="fas fa-table mr-1"></i>
                            Manager Table
                        </div>
                        <div class="card-body">
                            <div class="table-responsive">
                                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                                    <thead>
                                        <tr>
                                            <th>#</th>
                                            <th>Company Name of supplier </th>
                                            <th>Product Name</th>
                                            <th>NO of Products </th>
                                            <th> Lack Of Products</th>
                                            <th>Supplier Name </th>

                                            <th>Action</th>

                                        </tr>
                                    </thead>


                                    <tbody>

                                        <?php

                                        while ($result = mysqli_fetch_assoc($op)) {


                                        ?>
                                            <tr>
                                                <td><?php echo $result['id']; ?></td>
                                                <td><?php echo $result['companyname']; ?></td>
                                                <td><?php echo $result['productname']; ?></td>
                                                <td><?php echo $result['noofproducts']; ?></td>
                                                <td><?php echo $result['lackOfProducts']; ?></td>
                                                <td><?php echo $result['firstName'] . ' ' . $result['lastName']; ?></td>

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