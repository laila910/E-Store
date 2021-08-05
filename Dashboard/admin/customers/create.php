<?php
include '../helpers/functions.php';
include '../helpers/checkLogin.php';
include '../helpers/checkPrem.php';
include '../helpers/dbconnection.php';
include '../header.php';



//fetch categoreis
$sql2 = "SELECT `users`.*,`usersgroup`.`Group` FROM `users` join `usersgroup` on `users`.`group_id` =`usersgroup`.`id` ";
$op2  = mysqli_query($conn, $sql2);


if ($_SERVER['REQUEST_METHOD'] == 'POST') {


  $address = CleanInputs(Sanitize($_POST["address"], 2));
  $country = CleanInputs(Sanitize($_POST["country"], 2));
  $city = CleanInputs(Sanitize($_POST["city"], 2));
  $state   = CleanInputs(Sanitize($_POST["state"], 2));
  $anotheraddress = CleanInputs(Sanitize($_POST["anotheraddress"], 2));
  $creditcard = CleanInputs(Sanitize($_POST["creditcard"], 2));
  $shipaddress = CleanInputs(Sanitize($_POST["shipaddress"], 2));
  $shipcountry = CleanInputs(Sanitize($_POST["shipcountry"], 2));
  $shipcity = CleanInputs(Sanitize($_POST["shipcity"], 2));
  $shipstate = CleanInputs(Sanitize($_POST["shipstate"], 2));
  $billingaddress = CleanInputs(Sanitize($_POST["billingaddress"], 2));
  $billingcountry = CleanInputs(Sanitize($_POST["billingcountry"], 2));
  $billingcity = CleanInputs(Sanitize($_POST["billingcity"], 2));
  $billingstate = CleanInputs(Sanitize($_POST["billingstate"], 2));
  $usersid = CleanInputs(Sanitize($_POST["usersid"], 1));
  $zipCode = CleanInputs(Sanitize($_POST["zipCode"], 1));
  $creditcardtypeid = CleanInputs(Sanitize($_POST["creditcardtypeid"], 1));
  $cardExpMon = CleanInputs(Sanitize($_POST["cardExpMon"], 1));
  $cardExpYr = CleanInputs(Sanitize($_POST["cardExpYr"], 1));
  $shipzipcode = CleanInputs(Sanitize($_POST["shipzipcode"], 1));
  $billingzipcode = CleanInputs(Sanitize($_POST["billingzipcode"], 1));

  $errorMessages = array();
  //validate address
  if (!Validator($address, 1)) {
    $errorMessages['address'] = "address field Required";
  }

  if (!Validator($address, 2, 4)) {
    $errorMessages['addressLength'] = "address length must be > 4 ";
  }
  //validate Country
  if (!Validator($country, 1)) {
    $errorMessages['country'] = "country field Required";
  }

  if (!Validator($country, 2, 4)) {
    $errorMessages['countryLength'] = "country length must be > 4";
  }
  //validate City
  if (!Validator($city, 1)) {
    $errorMessages['city'] = "city field Required";
  }

  if (!Validator($city, 2, 4)) {
    $errorMessages['cityLength'] = "city length must be > 4";
  }
  //validate state
  if (!Validator($state, 1)) {
    $errorMessages['state'] = "state field Required";
  }

  if (!Validator($state, 2, 4)) {
    $errorMessages['stateLength'] = "state length must be > 4";
  }
  //validate anotheraddress
  if (!Validator($anotheraddress, 1)) {
    $errorMessages['anotheraddress'] = "anotheraddress field Required";
  }

  if (!Validator($anotheraddress, 2, 4)) {
    $errorMessages['anotheraddress'] = "anotheraddress length must be > 4";
  }
  //validate creditcard
  if (!Validator($creditcard, 1)) {
    $errorMessages['creditcard'] = "creditcard field Required";
  }

  if (!Validator($creditcard, 2, 3)) {
    $errorMessages['creditcardlength'] = "anotheraddress length must be > 3";
  }
  //validate shipaddress
  if (!Validator($shipaddress, 1)) {
    $errorMessages['shipaddress'] = "shipaddress field Required";
  }

  if (!Validator($shipaddress, 2, 3)) {
    $errorMessages['shipaddresslength'] = "shipaddress length must be > 3";
  }
  //validate shipcountry
  if (!Validator($shipcountry, 1)) {
    $errorMessages['shipcountry'] = "shipcountry field Required";
  }

  if (!Validator($shipcountry, 2, 4)) {
    $errorMessages['shipcountrylength'] = "shipcountry length must be > 3";
  }
  //validate shipcity
  if (!Validator($shipcity, 1)) {
    $errorMessages['shipcity'] = "shipcity field Required";
  }

  if (!Validator($shipcity, 2, 4)) {
    $errorMessages['shipcitylength'] = "shipcity length must be > 3";
  }
  //validate shipstate
  if (!Validator($shipstate, 1)) {
    $errorMessages['shipstate'] = "shipstate field Required";
  }

  if (!Validator($shipstate, 2, 4)) {
    $errorMessages['shipstatelength'] = "shipstate length must be > 3";
  }
  //validate billingaddress
  if (!Validator($billingaddress, 1)) {
    $errorMessages['billingaddress'] = "billingaddress field Required";
  }

  if (!Validator($billingaddress, 2, 4)) {
    $errorMessages['billingaddresslength'] = "billingaddress length must be > 3";
  }
  //validate billingcountry
  if (!Validator($billingcountry, 1)) {
    $errorMessages['billingcountry'] = "billingcountry field Required";
  }

  if (!Validator($billingcountry, 2, 4)) {
    $errorMessages['billingcountrylength'] = "billingcountry length must be > 3";
  }
  //validate billingcity
  if (!Validator($billingcity, 1)) {
    $errorMessages['billingcity'] = "billingcity field Required";
  }

  if (!Validator($billingcity, 2, 4)) {
    $errorMessages['billingcitylength'] = "billingcity length must be > 3";
  }
  //validate billingstate
  if (!Validator($billingstate, 1)) {
    $errorMessages['billingstate'] = "billingstate field Required";
  }

  if (!Validator($billingstate, 2, 4)) {
    $errorMessages['billingstatelength'] = "billingstate length must be > 3";
  }

  //Validate  usersId 
  if (!Validator($usersid, 1)) {
    $errorMessages['usersId'] = "users Id  field Required";
  }
  if (!Validator($usersid, 3)) {
    $errorMessages['usersId'] = "users Id  must be Integer Number";
  }
  //Validate zipcode
  if (!Validator($zipCode, 1)) {
    $errorMessages['zipcode'] = "zipcode field Required";
  }
  if (!Validator($zipCode, 3)) {
    $errorMessages['zipcode'] = "zidecode  must be Integer Number";
  }
  //Validate creditcardtypeId
  if (!Validator($creditcardtypeid, 1)) {
    $errorMessages['creditcardtypeId'] = "creditcardtypeId field Required";
  }
  if (!Validator($creditcardtypeid, 3)) {
    $errorMessages['creditcardtypeId'] = "creditcardtypeId  must be Integer Number";
  }
  //Validate cardExpMon
  if (!Validator($cardExpMon, 1)) {
    $errorMessages['cardExperationMonth'] = "card Experation Month field Required";
  }
  if (!Validator($cardExpMon, 3)) {
    $errorMessages['cardExperationMonth'] = "card Experation Month  must be Integer Number";
  }
  //Validate cardExpYr
  if (!Validator($cardExpYr, 1)) {
    $errorMessages['cardExperationYear'] = "card Experation Year field Required";
  }
  if (!Validator($cardExpYr, 3)) {
    $errorMessages['cardExperationYear'] = "card Experation Year  must be Integer Number";
  }
  //Validate shipzipcode
  if (!Validator($shipzipcode, 1)) {
    $errorMessages['shipzipcode'] = "ship zipcode field Required";
  }
  if (!Validator($shipzipcode, 3)) {
    $errorMessages['shipzipcode'] = "ship zipcode  must be Integer Number";
  }
  //Validate billingzipcode
  if (!Validator($billingzipcode, 1)) {
    $errorMessages['billingzipcode'] = "billing zipcode field Required";
  }
  if (!Validator($billingzipcode, 3)) {
    $errorMessages['billingzipcode'] = "billing zipcode  must be Integer Number";
  }


  if (count($errorMessages) > 0) {
    $_SESSION['errors'] = $errorMessages;
  } else {
    $sql4 =  "INSERT INTO `customers`( `usersid`, `address`, `country`, `city`, `state`, `zipCode`, `anotheraddress`, `creditcard`, `creditcardtypeid`, `cardExpMon`, `cardExpYr`, `shipaddress`, `shipcountry`, `shipcity`, `shipstate`, `shipzipcode`, `billingaddress`, `billingcountry`, `billingcity`, `billingstate`, `billingzipcode`) VALUES ('$usersid','$address','$country','$city','$state','$zipCode','$anotheraddress','$creditcard','$creditcardtypeid','$cardExpMon','$cardExpYr','$shipaddress','$shipcountry','$shipcity','$shipstate','$shipzipcode','$billingaddress','$billingcountry','$billingcity','$billingstate','$billingzipcode')";


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
              <li class="breadcrumb-item active"> Add New Customer</li>
            <?php  } ?>
          </ol>
          <div class="container">

            <form method="post" action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']); ?>" enctype="multipart/form-data">

              <div class="form-group">
                <label for="exampleInput"> Group Name </label>
                <select name="usersid" class="form-control">
                  <?php
                  while ($data = mysqli_fetch_assoc($op2)) {
                  ?>
                    <option value="<?php echo $data['id']; ?>"><?php echo $data['Group']; ?></option>
                  <?php } ?>
                </select>
              </div>


              <div class="form-group">
                <label for="exampleInputEmail1">Enter Address</label>
                <input type="text" name="address" class="form-control" id="exampleInputName" aria-describedby="" placeholder="Enter Address ">
              </div>

              <div class="form-group">
                <label for="exampleInputEmail1">Enter country</label>
                <input type="text" name="country" class="form-control" id="exampleInputName" aria-describedby="" placeholder="Enter country ">
              </div>
              <div class="form-group">
                <label for="exampleInputEmail1">Enter City</label>
                <input type="text" name="city" class="form-control" id="exampleInputName" aria-describedby="" placeholder="Enter city ">
              </div>
              <div class="form-group">
                <label for="exampleInputEmail1">Enter State</label>
                <input type="text" name="state" class="form-control" id="exampleInputName" aria-describedby="" placeholder="Enter state ">
              </div>
              <div class="form-group">
                <label for="exampleInputEmail1">Enter ZipCode</label>
                <input type="text" name="zipCode" class="form-control" id="exampleInputName" aria-describedby="" placeholder="Enter Zipcode ">
              </div>
              <div class="form-group">
                <label for="exampleInputEmail1">Enter Another Address</label>
                <input type="text" name="anotheraddress" class="form-control" id="exampleInputName" aria-describedby="" placeholder="Enter Another Address ">
              </div>
              <div class="form-group">
                <label for="exampleInputEmail1">Enter creditcard</label>
                <input type="text" name="creditcard" class="form-control" id="exampleInputName" aria-describedby="" placeholder="Enter creditcard ">
              </div>
              <div class="form-group">
                <label for="exampleInputEmail1">Enter creditcard Type Id</label>
                <input type="text" name="creditcardtypeid" class="form-control" id="exampleInputName" aria-describedby="" placeholder="Enter creditcard Type Id">
              </div>
              <div class="form-group">
                <label for="exampleInputEmail1">Enter Card Expiration Month</label>
                <input type="text" name="cardExpMon" class="form-control" id="exampleInputName" aria-describedby="" placeholder="Enter card Expiration Month">
              </div>
              <div class="form-group">
                <label for="exampleInputEmail1">Enter Card Expiration Year</label>
                <input type="text" name="cardExpYr" class="form-control" id="exampleInputName" aria-describedby="" placeholder="Enter card Expiration Year">
              </div>
              <div class="form-group">
                <label for="exampleInputEmail1">Enter Shipping Address</label>
                <input type="text" name="shipaddress" class="form-control" id="exampleInputName" aria-describedby="" placeholder="Enter Shipping Address">
              </div>
              <div class="form-group">
                <label for="exampleInputEmail1">Enter Shipping Country</label>
                <input type="text" name="shipcountry" class="form-control" id="exampleInputName" aria-describedby="" placeholder="Enter Shipping Country">
              </div>
              <div class="form-group">
                <label for="exampleInputEmail1">Enter Shipping City</label>
                <input type="text" name="shipcity" class="form-control" id="exampleInputName" aria-describedby="" placeholder="Enter Shipping City">
              </div>
              <div class="form-group">
                <label for="exampleInputEmail1">Enter Shipping State</label>
                <input type="text" name="shipstate" class="form-control" id="exampleInputName" aria-describedby="" placeholder="Enter Shipping State">
              </div>
              <div class="form-group">
                <label for="exampleInputEmail1">Enter Shipping ZipCode</label>
                <input type="text" name="shipzipcode" class="form-control" id="exampleInputName" aria-describedby="" placeholder="Enter Shipping ZipCode">
              </div>
              <div class="form-group">
                <label for="exampleInputEmail1">Enter Billing Address</label>
                <input type="text" name="billingaddress" class="form-control" id="exampleInputName" aria-describedby="" placeholder="Enter Billing Address">
              </div>
              <div class="form-group">
                <label for="exampleInputEmail1">Enter Billing Country</label>
                <input type="text" name="billingcountry" class="form-control" id="exampleInputName" aria-describedby="" placeholder="Enter Billing Country">
              </div>
              <div class="form-group">
                <label for="exampleInputEmail1">Enter Billing City</label>
                <input type="text" name="billingcity" class="form-control" id="exampleInputName" aria-describedby="" placeholder="Enter Billing City">
              </div>
              <div class="form-group">
                <label for="exampleInputEmail1">Enter Billing State</label>
                <input type="text" name="billingstate" class="form-control" id="exampleInputName" aria-describedby="" placeholder="Enter Billing State">
              </div>
              <div class="form-group">
                <label for="exampleInputEmail1">Enter Billing ZipCode</label>
                <input type="text" name="billingzipcode" class="form-control" id="exampleInputName" aria-describedby="" placeholder="Enter Billing ZipCode">
              </div>

              <button type="submit" class="btn btn-primary">Create Customer</button>
            </form>
          </div>

        </div>
      </main>
      <?php
      include '../footer.php';
      ?>