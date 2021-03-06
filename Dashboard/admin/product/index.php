<?php
include '../helpers/functions.php';
include '../helpers/checkLogin.php';
include '../helpers/checkPrem.php';
include '../helpers/dbconnection.php';


$sql = "SELECT `product`.*,`product`.`id` as `product_id`,`brand`.`brandName`, `categoreis`.categoryname  FROM `product` join `categoreis` on `product`.`product_cat_id` = `categoreis`.`id` join `brand` on `product`.`product_brand_id`=`brand`.`brand_Id` ORDER BY `product`.`id` desc  ";

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
                            <li class="breadcrumb-item active">Product Data</li>
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
                                            <th>Product Name </th>
                                            <th>Category </th>
                                            <th>Brand</th>
                                            <th>Product Status</th>
                                            <th>Featured </th>
                                            <th>Product Details </th>
                                            <th> Product Images </th>
                                            <th> Product Colors </th>
                                            <th> Product Sizes </th>

                                            <th>Action</th>

                                        </tr>
                                    </thead>


                                    <tbody>

                                        <?php

                                        while ($result = mysqli_fetch_assoc($op)) {


                                        ?>
                                            <tr>
                                                <td><?php echo $result['product_id']; ?></td>
                                                <td><?php echo $result['productname']; ?></td>
                                                <td><?php echo $result['categoryname']; ?></td>
                                                <td><?php echo $result['brandName']; ?></td>
                                                <td><?php echo $result['product_status']; ?></td>
                                                <td><?php echo $result['featured']; ?></td>
                                                <td> <a href='../productdetails/index.php' class='btn btn-primary m-r-1em'>Details</a> </td>
                                                <td> <a href='../productimages/index.php' class='btn btn-primary m-r-1em'>Images</a> </td>

                                                <td> <a href='../productcolor/index.php' class='btn btn-primary m-r-1em'>Colors</a></td>

                                                <td> <a href='../productSizes/index.php' class='btn btn-primary m-r-1em'>Sizes</a> </td>

                                                <td>

                                                    <a href='delete.php?id=<?php echo $result['product_id']; ?>' class='btn btn-danger m-r-1em'>Delete</a>
                                                    <a href='edit.php?id=<?php echo $result['product_id']; ?>' class='btn btn-primary m-r-1em'>Edit</a>



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