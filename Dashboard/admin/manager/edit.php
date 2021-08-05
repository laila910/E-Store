<?php

include '../helpers/functions.php';
include '../helpers/checkLogin.php';
include '../helpers/checkPrem.php';
include '../helpers/dbconnection.php';




$id = '';
if ($_SERVER['REQUEST_METHOD'] == "GET") {

    // LOGIC .... 
    $errorMessages = [];
    $id  = Sanitize($_GET['id'], 1);

    if (!Validator($id, 3)) {

        $errorMessages['id'] = "Invalid ID";

        $_SESSION['errors'] = $errorMessages;
        header("Location: index.php");
    }
}

if ($_SERVER['REQUEST_METHOD'] == "POST") {

    $lackOfProducts = CleanInputs(Sanitize($_POST["lackOfProducts"], 2));
    $supplierid  = CleanInputs(Sanitize($_POST["supplierid"], 1));
    $product_id  = CleanInputs(Sanitize($_POST["product_id"], 1));
    $noofproducts = CleanInputs(Sanitize($_POST["noofproducts"], 1));
    $userid = CleanInputs(Sanitize($_POST["userid"], 1));

    $errorMessages = array();
    //validate lackofproducts status
    if (!Validator($lackOfProducts, 1)) {
        $errorMessages['lackofproducts'] = "lackofProducts status field Required";
    }

    if (!Validator($lackOfProducts, 2, 1)) {
        $errorMessages['lackofproductsLength'] = "lack of products length must be > 4 ";
    }

    //Validate  usersId 
    if (!Validator($userid, 1)) {
        $errorMessages['userId'] = "user Id  field Required";
    }
    if (!Validator($userid, 3)) {
        $errorMessages['userId'] = "user Id  must be Integer Number";
    }
    //Validate supplier Id
    if (!Validator($supplierid, 1)) {
        $errorMessages['supplierId'] = "Supplier ID field Required";
    }
    if (!Validator($supplierid, 3)) {
        $errorMessages['supplierId'] = "supplier ID  must be Integer Number";
    }
    //Validate product_id
    if (!Validator($product_id, 1)) {
        $errorMessages['product_id'] = "productId field Required";
    }
    if (!Validator($product_id, 3)) {
        $errorMessages['product_id'] = "productId  must be Integer Number";
    }
    //Validate NoOfProducts
    if (!Validator($noofproducts, 1)) {
        $errorMessages['noOfProducts'] = "No Of Products field Required";
    }
    if (!Validator($noofproducts, 3)) {
        $errorMessages['noOfProducts'] = "No Of Products  must be Integer Number";
    }

    if (count($errorMessages) == 0) {


        $sql = "UPDATE `manager` SET `supplierid`='$supplierid',`product_id`='$product_id',`noofproducts`='$noofproducts',`lackOfProducts`='$lackOfProducts',`userid`='$userid' WHERE `id_manager`='$id'";

        $op = mysqli_query($conn, $sql);



        if ($op) {

            $errorMessages['Result'] = "Data updated.";
        } else {
            $errorMessages['Result']  = "Error Try Again.";
        }
        $_SESSION['errors'] = $errorMessages;

        header('Location: index.php');
    } else {

        $_SESSION['errors'] = $errorMessages;
    }
}

# Fetch product
$sql1  = " SELECT * FROM `manager` WHERE  `id_manager`= " . $id;
$op1  = mysqli_query($conn, $sql1);
$FData = mysqli_fetch_assoc($op1);
//fetch users 
$sql2 = "SELECT * FROM `users`";
$op2 = mysqli_query($conn, $sql2);
//fetch suppliers
$sql3 = "SELECT * FROM `suppliers`";
$op3 = mysqli_query($conn, $sql3);
//fetch Product
$sql4 = "SELECT * FROM `product`";
$op4 = mysqli_query($conn, $sql4);



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

                        <?php



                        if (isset($_SESSION['errors'])) {

                            foreach ($_SESSION['errors'] as $key =>  $value) {

                                echo '* ' . $key . ' : ' . $value . '<br>';
                            }

                            unset($_SESSION['errors']);
                        } else {
                        ?>

                            <li class="breadcrumb-item active">Edit Manager Data </li>
                        <?php } ?>



                    </ol>



                    <div class="container">

                        <form method="post" action="edit.php?id=<?php echo $FData['id_manager']; ?>" enctype="multipart/form-data">

                            <div class="form-group">
                                <label for="exampleInput">Manager Name</label>
                                <select name="userid" class="form-control">
                                    <?php
                                    while ($data = mysqli_fetch_assoc($op2)) {
                                    ?>
                                        <option value="<?php echo $data['id']; ?>" <?php if ($data['id_manager'] == $FData['userid']) {
                                                                                        echo 'selected';
                                                                                    } ?>>
                                            <?php echo $data['firstName']; ?></option>
                                    <?php } ?>
                                </select>
                            </div>

                            <div class="form-group">
                                <label for="exampleInput">Supplier Company Name</label>
                                <select name="supplierid" class="form-control">
                                    <?php
                                    while ($data = mysqli_fetch_assoc($op3)) {
                                    ?>
                                        <option value="<?php echo $data['id']; ?>" <?php if ($data['id_manager'] == $FData['supplierid']) {
                                                                                        echo 'selected';
                                                                                    } ?>>
                                            <?php echo $data['companyname']; ?></option>
                                    <?php } ?>
                                </select>
                            </div>
                            <div class="form-group">
                                <label for="exampleInput">Product Name</label>
                                <select name="product_id" class="form-control">
                                    <?php
                                    while ($data = mysqli_fetch_assoc($op4)) {
                                    ?>
                                        <option value="<?php echo $data['id']; ?>" <?php if ($data['id_manager'] == $FData['product_id']) {
                                                                                        echo 'selected';
                                                                                    } ?>>
                                            <?php echo $data['productname']; ?></option>
                                    <?php } ?>
                                </select>
                            </div>

                            <div class="form-group">
                                <label for="exampleInputEmail1">Enter NO OF Needed Products</label>
                                <input type="text" name="noofproducts" value="<?php echo $FData['noofproducts']; ?>" class="form-control" id="exampleInputName" aria-describedby="" placeholder="Enter NO Of Products ">
                            </div>

                            <div class="form-group">
                                <label for="exampleInputEmail1">Enter No Of Lack Of Products </label>
                                <input type="text" name="lackOfProducts" value="<?php echo $FData['lackOfProducts']; ?>" class="form-control" id="exampleInputName" aria-describedby="" placeholder="Enter lackOfProducts Status ">
                            </div>


                            <input type="hidden" name="id_manager" value="<?php echo $FData['id_manager']; ?>">



                            <button type="submit" name="submit" class="btn btn-primary">Submit</button>
                        </form>
                    </div>

                </div>
            </main>
            <?php
            include '../footer.php';
            ?>