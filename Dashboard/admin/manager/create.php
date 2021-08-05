<?php
include '../helpers/functions.php';
include '../helpers/checkLogin.php';
include '../helpers/checkPrem.php';
include '../helpers/dbconnection.php';
include '../header.php';



//fetch users
$sql2 = "SELECT `users`.* FROM `users`";
$op2  = mysqli_query($conn, $sql2);
//fetch supplier 
$sql3 = "SELECT `suppliers`.* FROM `suppliers`";
$op3 = mysqli_query($conn, $sql3);
//fetch products 
$sql5 = "SELECT `product`.* FROM `product`";
$op5 = mysqli_query($conn, $sql5);


if ($_SERVER['REQUEST_METHOD'] == 'POST') {


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


    if (count($errorMessages) > 0) {
        $_SESSION['errors'] = $errorMessages;
    } else {
        $sql4 =  "INSERT INTO `manager`( `supplierid`, `product_id`, `noofproducts`, `lackOfProducts`, `userid`) VALUES ('$supplierid','$product_id','$noofproducts','$lackOfProducts','$userid')";


        $op4 = mysqli_query($conn, $sql4);


        if ($op4) {

            $errorMessages['Result'] = "Data inserted.";
        } else {
            $errorMessages['Result']  = "Error Try Again.";
        }




        $_SESSION['errors'] = $errorMessages;
        header('Location: index.php');
    }
}








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
                            foreach ($_SESSION['errors'] as $key => $value) {
                                echo '* ' . $key . ' : ' . $value . '<br>';
                            }
                            unset($_SESSION['errors']);
                        } else {

                        ?>
                            <li class="breadcrumb-item active"> Add New Manager Data</li>
                        <?php  } ?>
                    </ol>
                    <div class="container">

                        <form method="post" action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']); ?>" enctype="multipart/form-data">

                            <div class="form-group">
                                <label for="exampleInput"> Company Of SUPPLiers </label>
                                <select name="supplierid" class="form-control">
                                    <?php
                                    while ($data = mysqli_fetch_assoc($op3)) {
                                    ?>
                                        <option value="<?php echo $data['id']; ?>"><?php echo $data['companyname']; ?></option>
                                    <?php } ?>
                                </select>
                            </div>
                            <div class="form-group">
                                <label for="exampleInput"> Product Name </label>
                                <select name="product_id" class="form-control">
                                    <?php
                                    while ($data = mysqli_fetch_assoc($op5)) {
                                    ?>
                                        <option value="<?php echo $data['id']; ?>"><?php echo $data['productname']; ?></option>
                                    <?php } ?>
                                </select>
                            </div>
                            <div class="form-group">
                                <label for="exampleInput"> First Name </label>
                                <select name="userid" class="form-control">
                                    <?php
                                    while ($data = mysqli_fetch_assoc($op2)) {
                                    ?>
                                        <option value="<?php echo $data['id']; ?>"><?php echo $data['firstName']; ?></option>
                                    <?php } ?>
                                </select>
                            </div>


                            <div class="form-group">
                                <label for="exampleInputEmail1">Enter No oF Needed Products</label>
                                <input type="text" name="product_id " class="form-control" id="exampleInputName" aria-describedby="" placeholder="Enter Needed No of Products">
                            </div>

                            <div class="form-group">
                                <label for="exampleInputEmail1">Enter Lack Of Products Status</label>
                                <input type="text" name="lackOfProducts" class="form-control" id="exampleInputName" aria-describedby="" placeholder="Enter lack Of Products Status">
                            </div>


                            <button type="submit" class="btn btn-primary">Create Manager Data</button>
                        </form>
                    </div>

                </div>
            </main>
            <?php
            include '../footer.php';
            ?>