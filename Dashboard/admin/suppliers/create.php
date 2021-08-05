<?php
include '../helpers/functions.php';
include '../helpers/checkLogin.php';
include '../helpers/checkPrem.php';
include '../helpers/dbconnection.php';
include '../header.php';



//fetch users
$sql2 = "SELECT `users`.* FROM `users`";
$op2  = mysqli_query($conn, $sql2);



if ($_SERVER['REQUEST_METHOD'] == 'POST') {


    $companyname = CleanInputs(Sanitize($_POST["companyname"], 2));
    $firstaddress = CleanInputs(Sanitize($_POST["firstaddress"], 2));
    $city = CleanInputs(Sanitize($_POST["city"], 2));
    $state = CleanInputs(Sanitize($_POST["state"], 2));
    $userid   = CleanInputs(Sanitize($_POST["userid"], 1));
    $fax = CleanInputs(Sanitize($_POST["fax"], 1));
    $discount = CleanInputs(Sanitize($_POST["discount"], 1));
    $zipCode = CleanInputs(Sanitize($_POST["zipCode"], 1));
    $URL = CleanInputs($_POST["URL"]);
    $paymentmethods = CleanInputs(Sanitize($_POST["paymentmethods"], 2));
    $discountavailable = CleanInputs(Sanitize($_POST["discountavailable"], 2));
    $currentorder = CleanInputs(Sanitize($_POST["currentorder"], 2));


    $errorMessages = array();
    //validate companyname
    if (!Validator($companyname, 1)) {
        $errorMessages['companyname'] = "companyname field Required";
    }

    if (!Validator($companyname, 2, 4)) {
        $errorMessages['companynameLength'] = "companyname length must be > 4 ";
    }
    //validate firstaddress
    if (!Validator($firstaddress, 1)) {
        $errorMessages['firstaddress'] = "first address field Required";
    }

    if (!Validator($firstaddress, 2, 4)) {
        $errorMessages['firstaddressLength'] = "firstaddress length must be > 4 ";
    }
    //validate city
    if (!Validator($city, 1)) {
        $errorMessages['city'] = "city field Required";
    }

    if (!Validator($city, 2, 4)) {
        $errorMessages['cityLength'] = "lack of products length must be > 4";
    }
    //validate state
    if (!Validator($state, 1)) {
        $errorMessages['state'] = "state field Required";
    }

    if (!Validator($state, 2, 4)) {
        $errorMessages['stateLength'] = "state length must be > 4 ";
    }
    //validate URL
    if (!Validator($URL, 1)) {
        $errorMessages['URL'] = "URL status field Required";
    }

    if (!Validator($URL, 6)) {
        $errorMessages['URL'] = "URL is not Valid";
    }
    //validate paymentmethods
    if (!Validator($paymentmethods, 1)) {
        $errorMessages['paymentmethods'] = "payment Methods field Required";
    }

    if (!Validator($paymentmethods, 2, 4)) {
        $errorMessages['paymentmethods'] = "paymentmethod is not Valid";
    }
    //validate discountavailable
    if (!Validator($discountavailable, 1)) {
        $errorMessages['discountavailable'] = "discount available status field Required";
    }

    if (!Validator($discountavailable, 2, 1)) {
        $errorMessages['discountavailable'] = "discount available status is not Valid";
    }
    //validate currentorder
    if (!Validator($currentorder, 1)) {
        $errorMessages['currentorder'] = "current order field Required";
    }

    if (!Validator($currentorder, 2, 6)) {
        $errorMessages['currentorder'] = "currentorder is not Valid";
    }

    //Validate  userId 
    if (!Validator($userid, 1)) {
        $errorMessages['userId'] = "user Id  field Required";
    }
    if (!Validator($userid, 3)) {
        $errorMessages['userId'] = "user Id  must be Integer Number";
    }
    //Validate fax
    if (!Validator($fax, 1)) {
        $errorMessages['fax'] = "fax field Required";
    }
    if (!Validator($fax, 3)) {
        $errorMessages['fax'] = "fax  must be Integer Number";
    }
    //Validate discount
    if (!Validator($discount, 1)) {
        $errorMessages['discount'] = "discount field Required";
    }
    if (!Validator($discount, 3)) {
        $errorMessages['discount'] = "discount  must be Integer Number";
    }

    if (count($errorMessages) > 0) {
        $_SESSION['errors'] = $errorMessages;
    } else {
        $sql4 =  "INSERT INTO `suppliers`(`userid`, `companyname`, `firstaddress`, `city`, `state`, `zipCode`, `fax`, `URL`, `paymentmethods`, `discount`, `discountavailable`, `currentorder`) VALUES ('$userid','$companyname','$firstaddress','$city','$state','$zipCode','$fax','$URL','$paymentmethods','$discount','$discountavailable','$currentorder')";


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
                            <li class="breadcrumb-item active"> Add New Suppliers Data</li>
                        <?php  } ?>
                    </ol>
                    <div class="container">

                        <form method="post" action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']); ?>" enctype="multipart/form-data">

                            <div class="form-group">
                                <label for="exampleInput">Supplier Name</label>
                                <select name="userid" class="form-control">
                                    <?php
                                    while ($data = mysqli_fetch_assoc($op2)) {
                                    ?>
                                        <option value="<?php echo $data['id']; ?>"><?php echo $data['firstName']; ?></option>
                                    <?php } ?>
                                </select>
                            </div>

                            <div class="form-group">
                                <label for="exampleInputEmail1">Enter Company Name</label>
                                <input type="text" name="companyname " class="form-control" id="exampleInputName" aria-describedby="" placeholder="Enter Company Name">
                            </div>

                            <div class="form-group">
                                <label for="exampleInputEmail1">Enter Address</label>
                                <input type="text" name="firstaddress" class="form-control" id="exampleInputName" aria-describedby="" placeholder="Enter firstaddres">
                            </div>
                            <div class="form-group">
                                <label for="exampleInputEmail1">Enter City</label>
                                <input type="text" name="city" class="form-control" id="exampleInputName" aria-describedby="" placeholder="Enter city">
                            </div>
                            <div class="form-group">
                                <label for="exampleInputEmail1">Enter State</label>
                                <input type="text" name="state" class="form-control" id="exampleInputName" aria-describedby="" placeholder="Enter state">
                            </div>
                            <div class="form-group">
                                <label for="exampleInputEmail1">Enter Zipcode</label>
                                <input type="text" name="zipCode" class="form-control" id="exampleInputName" aria-describedby="" placeholder="Enter zipcode">
                            </div>
                            <div class="form-group">
                                <label for="exampleInputEmail1">Enter Fax</label>
                                <input type="text" name="fax" class="form-control" id="exampleInputName" aria-describedby="" placeholder="Enter fax">
                            </div>
                            <div class="form-group">
                                <label for="exampleInputEmail1">Enter URL </label>
                                <input type="text" name="URL" class="form-control" id="exampleInputName" aria-describedby="" placeholder="Enter URL">
                            </div>
                            <div class="form-group">
                                <label for="exampleInputEmail1">Enter Payment Methods</label>
                                <input type="text" name="paymentmethods" class="form-control" id="exampleInputName" aria-describedby="" placeholder="Enter paymentmethods">
                            </div>
                            <div class="form-group">
                                <label for="exampleInputEmail1">Enter discount </label>
                                <input type="text" name="discount" class="form-control" id="exampleInputName" aria-describedby="" placeholder="Enter Discount">
                            </div>
                            <div class="form-group">
                                <label for="exampleInputEmail1">Enter Discount Available</label>
                                <input type="text" name="discountavailable" class="form-control" id="exampleInputName" aria-describedby="" placeholder="Enter discountavailable">
                            </div>
                            <div class="form-group">
                                <label for="exampleInputEmail1">Enter currentorder </label>
                                <input type="text" name="currentorder" class="form-control" id="exampleInputName" aria-describedby="" placeholder="Enter currentorder">
                            </div>


                            <button type="submit" class="btn btn-primary">Create Suppliers Data</button>
                        </form>
                    </div>

                </div>
            </main>
            <?php
            include '../footer.php';
            ?>