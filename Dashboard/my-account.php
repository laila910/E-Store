<?php
include './help/fun.php';
include './help/logincheck.php';
include './help/db.php';
include 'header.php';
include 'navbar.php';
$sql = "SELECT * FROM users where `id`=" . $_SESSION['users']['id'];
$op = mysqli_query($conn, $sql);
$data = mysqli_fetch_assoc($op);
if ($_SERVER['REQUEST_METHOD'] == 'POST') {

  $usersid = $_SESSION['users']['id'];
  $address = Clean(Sanitized($_POST["address"], 2));
  $country = Clean(Sanitized($_POST["country"], 2));
  $city = Clean(Sanitized($_POST["city"], 2));
  $state = Clean(Sanitized($_POST["state"], 2));

  $anotheraddress = Clean(Sanitized($_POST["anotheraddress"], 2));
  $creditcard = Clean(Sanitized($_POST["creditcard"], 2));
  $shipaddress = Clean(Sanitized($_POST["shipaddress"], 2));
  $shipcountry = Clean(Sanitized($_POST["shipcountry"], 2));
  $shipcity = Clean(Sanitized($_POST["shipcity"], 2));
  $shipstate = Clean(Sanitized($_POST["shipstate"], 2));
  $billingaddress = Clean(Sanitized($_POST["billingaddress"], 2));
  $billingcountry = Clean(Sanitized($_POST["billingcountry"], 2));
  $billingcity = Clean(Sanitized($_POST["billingcity"], 2));
  $billingstate = Clean(Sanitized($_POST["billingstate"], 2));

  $billingzipcode = Clean(Sanitized($_POST["billingzipcode"], 1));

  $zipCode = Clean(Sanitized($_POST["zipCode"], 1));
  $creditcardtypeid = Clean(Sanitized($_POST["creditcardtypeid"], 1));
  $cardExpMon = Clean(Sanitized($_POST["cardExpMon"], 1));
  $cardExpYr = Clean(Sanitized($_POST["cardExpMon"], 1));
  $cvc = Clean(Sanitized($_POST["cvc"], 1));

  $shipzipcode = Clean(Sanitized($_POST["shipzipcode"], 1));


  $errorMessages = array();

  //validate address
  if (!Validate($address, 1)) {
    $errorMessages['address'] = "address field Required";
  }

  if (!Validate($address, 2, 6)) {
    $errorMessages['address'] = "address Length must be >6";
  }
  //validate country
  if (!Validate($country, 1)) {
    $errorMessages['country'] = "country field Required";
  }

  if (!Validate($country, 2, 4)) {
    $errorMessages['country'] = "country Length must be >4";
  }
  //validate City
  if (!Validate($city, 1)) {
    $errorMessages['password'] = "password field Required";
  }

  if (!Validate($city, 2, 4)) {
    $errorMessages['password'] = "password Length must be >4";
  }
  //validate state
  if (!Validate($state, 1)) {
    $errorMessages['state'] = "state field Required";
  }

  if (!Validate($state, 2, 4)) {
    $errorMessages['state'] = "state Length must be >4";
  }
  //validate creditcard
  if (!Validate($creditcard, 1)) {
    $errorMessages['creditcard'] = "creditcard field Required";
  }

  if (!Validate($creditcard, 2, 2)) {
    $errorMessages['creditcard'] = "credit card Length must be >2";
  }
  //validate shipaddress
  if (!Validate($shipaddress, 1)) {
    $errorMessages['shipaddress'] = "shipaddress field Required";
  }

  if (!Validate($shipaddress, 2, 4)) {
    $errorMessages['shipaddress'] = "shipaddress Length must be >4";
  }
  //validate shipcountry
  if (!Validate($shipcountry, 1)) {
    $errorMessages['shipcountry'] = "shipcountry field Required";
  }

  if (!Validate($shipcountry, 2, 4)) {
    $errorMessages['shipcountry'] = "shipcountry Length must be >4";
  }
  //validate shipcity
  if (!Validate($shipcity, 1)) {
    $errorMessages['shipcity'] = "shipcity field Required";
  }

  if (!Validate($shipcity, 2, 4)) {
    $errorMessages['shipcity'] = "shipcity Length must be >4";
  }
  //validate shipstate
  if (!Validate($shipstate, 1)) {
    $errorMessages['shipstate'] = "shipstate field Required";
  }

  if (!Validate($shipstate, 2, 4)) {
    $errorMessages['shipstate'] = "shipstate Length must be >4";
  }
  //validate billing address
  if (!Validate($billingaddress, 1)) {
    $errorMessages['billingaddress'] = "billingaddress field Required";
  }

  if (!Validate($billingaddress, 2, 6)) {
    $errorMessages['billingaddress'] = "billingaddress Length must be >6";
  }
  //validate billing country
  if (!Validate($billingcountry, 1)) {
    $errorMessages['billingcountry'] = "billing country field Required";
  }

  if (!Validate($billingcountry, 2, 4)) {
    $errorMessages['billingcountry'] = "billingcountry Length must be >4";
  }
  //validate billingcity
  if (!Validate($billingcity, 1)) {
    $errorMessages['billingcity'] = "billingcity field Required";
  }

  if (!Validate($billingcity, 2, 4)) {
    $errorMessages['billingcity'] = "billingcity Length must be >4";
  }
  //validate billingstate
  if (!Validate($billingstate, 1)) {
    $errorMessages['billingstate'] = "billingstate field Required";
  }

  if (!Validate($billingstate, 2, 4)) {
    $errorMessages['billingstate'] = "billingstate Length must be >4";
  }


  //Validate billingzipcode
  if (!Validate($billingzipcode, 1)) {
    $errorMessages['billingzipcode'] = "billingzipcode  field Required";
  }
  if (!Validate($billingzipcode, 3)) {
    $errorMessages['billingzipcode'] = "billingzipcode  must be Integer Number";
  }



  //Validate zipcode
  if (!Validate($zipCode, 1)) {
    $errorMessages['zipcode'] = "zipcode  field Required";
  }
  if (!Validate($zipCode, 3)) {
    $errorMessages['zipcode'] = "zipcode  must be Integer Number";
  }
  //Validate credittypeId
  if (!Validate($creditcardtypeid, 1)) {
    $errorMessages['creditTypeId'] = "Credit Type Id  field Required";
  }
  if (!Validate($creditcardtypeid, 3)) {
    $errorMessages['creditTyprId'] = "credit Type Id  must be Integer Number";
  }
  //Validate cardEXPMONTH
  if (!Validate($cardExpMon, 1)) {
    $errorMessages['cardExpMon'] = "Card Experation Month  field Required";
  }
  if (!Validate($cardExpMon, 3)) {
    $errorMessages['cardExpMon'] = "Card Exp Month  must be Integer Number";
  }
  //Validate cardExpYear
  if (!Validate($cardExpYr, 1)) {
    $errorMessages['cardExpYear'] = "Card Experation Year  field Required";
  }
  if (!Validate($cardExpYr, 3)) {
    $errorMessages['cardExpYear'] = "card Expiration Year  must be Integer Number";
  }
  //Validate cvc
  if (!Validate($cvc, 1)) {
    $errorMessages['cvc'] = "cvc  field Required";
  }
  if (!Validate($cvc, 3)) {
    $errorMessages['cvc'] = "cvc  must be Integer Number";
  }
  //Validate shipzipcode
  if (!Validate($shipzipcode, 1)) {
    $errorMessages['shipzipcode'] = "shipzipcode field Required";
  }
  if (!Validate($shipzipcode, 3)) {
    $errorMessages['shipzipcode'] = "shipzipcode must be Integer Number";
  }

  if (count($errorMessages) > 0) {
    $_SESSION['errors'] = $errorMessages;
  } else {
    $sql4 =  "INSERT INTO `customers`( `usersid`, `address`, `country`, `city`, `state`, `zipCode`, `anotheraddress`, `creditcard`, `creditcardtypeid`, `cardExpMon`, `cardExpYr`, `cvc`, `shipaddress`, `shipcountry`, `shipcity`, `shipstate`, `shipzipcode`, `billingaddress`, `billingcountry`, `billingcity`, `billingstate`, `billingzipcode`) VALUES ('$usersid','$address','$country','$city','$state','$zipCode','$anotheraddress','$creditcard','$creditcardtypeid','$cardExpMon','$cardExpYr','$cvc','$shipaddress','$shipcountry','$shipcity','$shipstate','$shipzipcode','$billingaddress','$billingcountry','$billingcity','$billingstate','$billingzipcode')";


    $op4 = mysqli_query($conn, $sql4);


    if ($op4) {

      $errorMessages['Result'] = "Data inserted.";
    } else {
      $errorMessages['Result']  = "Error Try Again.";
    }




    $_SESSION['errors'] = $errorMessages;
  }
}

?>
<!-- My Account Start -->
<div class="my-account">
  <div class="container-fluid">
    <div class="row">
      <div class="col-md-3">
        <?php
        if (isset($_SESSION['errors'])) {
          foreach ($_SESSION['errors'] as $key => $value) {
            echo '* ' . $key . ' : ' . $value . '<br>';
          }
          unset($_SESSION['errors']);
        }

        ?>
        <div class="nav flex-column nav-pills" role="tablist" aria-orientation="vertical">
          <a class="nav-link active" id="dashboard-nav" data-toggle="pill" href="#dashboard-tab" role="tab"><i class="fa fa-tachometer-alt"></i> Enter personal Information</a>

          <a class="nav-link" id="account-nav" data-toggle="pill" href="#account-tab" role="tab"><i class="fa fa-user"></i>Account Details</a>

          <a class="nav-link" id="orders-nav" data-toggle="pill" href="#orders-tab" role="tab"><i class="fa fa-shopping-bag"></i>Orders</a>

          <a class="nav-link" href="logout.php"><i class="fa fa-sign-out-alt"></i>Logout</a>
        </div>
      </div>
      <div class="col-md-9">
        <div class="tab-content">
          <div class="tab-pane fade show active" id="dashboard-tab" role="tabpanel" aria-labelledby="dashboard-nav">
            <h4>personal Informtion</h4>
            <form method="post" action="<?php echo $_SERVER['PHP_SELF']; ?>">
              <div class="mb-3">
                <label for="exampleInputEmail1" class="form-label">First Name</label>
                <input type="text" name="firstName" value="<?php echo $data['firstName']; ?>" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp">

              </div>
              <div class="mb-3">
                <label for="exampleInputEmail1" class="form-label">Last Name</label>
                <input type="text" name="lastName" value="<?php echo $data['lastName']; ?>" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp">

              </div>
              <div class="mb-3">
                <label for="exampleInputEmail1" class="form-label">Mobile No</label>
                <input type="text" name="mobileNo" value="<?php echo '0' . $data['mobileNo']; ?>" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp">

              </div>
              <div class="mb-3">
                <label for="exampleInputEmail1" class="form-label">Email address</label>
                <input type="email" class="form-control" value="<?php echo $data['email']; ?>" id="exampleInputEmail1" aria-describedby="emailHelp">

              </div>
              <div class="mb-3">
                <label for="exampleInputPassword1" class="form-label">Password</label>
                <input type="password" class="form-control" value="<?php echo $data['password']; ?>" id="exampleInputPassword1">
              </div>
              <div class="mb-3">
                <label for="exampleInputEmail1" class="form-label">Address</label>
                <input type="text" name="address" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp">

              </div>
              <div class="mb-3">
                <label for="exampleInputEmail1" class="form-label">Country</label>
                <input type="text" name="country" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp">

              </div>
              <div class="mb-3">
                <label for="exampleInputEmail1" class="form-label">City</label>
                <input type="text" name="city" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp">

              </div>
              <div class="mb-3">
                <label for="exampleInputEmail1" class="form-label">State</label>
                <input type="text" name="state" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp">

              </div>
              <div class="mb-3">
                <label for="exampleInputEmail1" class="form-label">Zip Code</label>
                <input type="text" name="zipCode" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp">

                <div class="mb-3">
                  <label for="exampleInputEmail1" class="form-label">anotheraddress</label>
                  <input type="text" name="anotheraddress" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp">

                </div>
                <div class="mb-3">
                  <label for="exampleInputEmail1" class="form-label">Credit Card</label>
                  <input type="text" name="creditcard" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp">

                </div>
                <div class="mb-3">
                  <label for="exampleInputEmail1" class="form-label">Credit Card Id</label>
                  <input type="text" name="creditcardtypeid" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp">

                </div>

                <div class="mb-3">
                  <label for="exampleInputEmail1" class="form-label">Card EXperation Month</label>
                  <input type="text" name="cardExpMon" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp">

                </div>
                <div class="mb-3">
                  <label for="exampleInputEmail1" class="form-label">Card EXperation Year</label>
                  <input type="text" name="cardExpYr" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp">

                </div>
                <div class="mb-3">
                  <label for="exampleInputEmail1" class="form-label">Card CVC</label>
                  <input type="text" name="cvc" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp">

                </div>
                <div class="mb-3">
                  <label for="exampleInputEmail1" class="form-label">Shipping Address</label>
                  <input type="text" name="shipaddress" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp">

                </div>
                <div class="mb-3">
                  <label for="exampleInputEmail1" class="form-label">Shipping Country</label>
                  <input type="text" name="shipcountry" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp">

                </div>
                <div class="mb-3">
                  <label for="exampleInputEmail1" class="form-label">Shipping City</label>
                  <input type="text" name="shipcity" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp">

                </div>
                <div class="mb-3">
                  <label for="exampleInputEmail1" class="form-label">Shipping State</label>
                  <input type="text" name="shipstate" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp">

                </div>

                <div class="mb-3">
                  <label for="exampleInputEmail1" class="form-label">Shipping zipCode</label>
                  <input type="text" name="shipzipcode" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp">

                </div>
                <div class="mb-3">
                  <label for="exampleInputEmail1" class="form-label">Billing Address</label>
                  <input type="text" name="billingaddress" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp">

                </div>

                <div class="mb-3">
                  <label for="exampleInputEmail1" class="form-label">Billing Country</label>
                  <input type="text" name="billingcountry" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp">

                </div>
                <div class="mb-3">
                  <label for="exampleInputEmail1" class="form-label">Billing City</label>
                  <input type="text" name="billingcity" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp">

                </div>
                <div class="mb-3">
                  <label for="exampleInputEmail1" class="form-label">Billing State</label>
                  <input type="text" name="billingstate" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp">

                </div>
                <div class="mb-3">
                  <label for="exampleInputEmail1" class="form-label">Billing zipCode</label>
                  <input type="text" name="billingzipcode" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp">

                </div>

                <button type="submit" class="btn btn-primary">Submit</button>
            </form>
          </div>
          <div class="tab-pane fade" id="orders-tab" role="tabpanel" aria-labelledby="orders-nav">
            <div class="table-responsive">
              <table class="table table-bordered">
                <thead class="thead-dark">
                  <tr>
                    <th>No</th>
                    <th>OrderNumber</th>
                    <th>Product</th>
                    <th>Image</th>
                    <th>Price</th>
                    <th>Shipdate</th>
                    <th>DeliveredDate</th>
                    <th>SalesTax</th>
                    <th>TotalPrice</th>
                    <th>Action</th>
                  </tr>
                </thead>
                <tbody>
                  <?php $sql9 = "SELECT * FROM `savedorderforcustomer` WHERE `userid`=" . $_SESSION['users']['id'];
                  $op9 = mysqli_query($conn, $sql9);

                  while ($data = mysqli_fetch_assoc($op9)) { ?>
                    <tr>
                      <td><?php echo $data['id']; ?></td>
                      <td><?php echo $data['orderNo']; ?></td>
                      <td><?php echo $data['productName']; ?></td>
                      <td><img src="admin\productimages\uploads\<?php echo $data['firstImage']; ?>" alt="Product Image"></td>
                      <td><?php echo $data['productPrice']; ?></td>
                      <td><?php echo $data['shipDate']; ?></td>
                      <td><?php echo $data['deliveredDate']; ?></td>
                      <td><?php echo $data['SalesTax']; ?></td>
                      <td><?php echo $data['Total Price']; ?></td>
                      <td>Approved</td>

                    </tr>
                  <?php } ?>
                </tbody>
              </table>
            </div>
          </div>
          <div class="tab-pane fade" id="account-tab" role="tabpanel" aria-labelledby="account-nav">
            <h4>personal Informtion</h4>
            <div class="table-responsive">
              <table class="table table-striped">
                <thead>
                  <tr>
                    <th scope="col">#</th>
                    <th scope="col">Customer Name</th>
                    <th scope="col">address</th>

                    <th scope="col">Another Address</th>

                    <th scope="col">Credit Card</th>


                    <th scope="col">Ship Address</th>


                    <th scope="col">Date Registered</th>

                    <th scope="col">Billing Address</th>


                  </tr>
                </thead>
                <tbody>

                  <?php $sql5 = "SELECT `customers`.* ,`users`.`firstName` FROM `customers` join `users` on `customers`.`usersid`=`users`.`id` where `usersid`=" . $_SESSION['users']['id'];
                  $op5 = mysqli_query($conn, $sql5);
                  while ($fdata = mysqli_fetch_assoc($op5)) { ?>
                    <tr>
                      <td><?php echo $fdata['id']; ?></td>
                      <td><?php echo $fdata['firstName']; ?></td>
                      <td><?php echo $fdata['address'] . ',' . $fdata['country'] . ',' . $fdata['city'] . ',' . $fdata['state'] . ',Zipcode' . $fdata['zipCode']; ?></td>
                      <td><?php echo $fdata['anotheraddress']; ?></td>
                      <td><?php echo 'credit Card' . $fdata['creditcard'] . '<br>CardId' . $fdata['creditcardtypeid'] . '<br>CardExpMonth' . $fdata['cardExpMon'] . ',cardExpYear' . $fdata['cardExpYr'] . ',cvc' . $fdata['cvc']; ?></td>
                      <td> <?php echo $fdata['shipaddress'] . '<br>' . $fdata['shipcountry'] . ',' . $fdata['shipcity'] . ',' . $fdata['shipstate'] . ',Zipcode' . $fdata['shipzipcode']; ?></td>
                      <td> <?php echo $fdata['dateRegistered']; ?></td>
                      <td> <?php echo $fdata['billingaddress'] . '<br>' . $fdata['billingcountry'] . ',' . $fdata['billingcity'] . ',' . $fdata['billingcity'] . ',' . $fdata['billingstate'] . ',zipcode' . $fdata['billingzipcode']; ?></td>
                    </tr>
                  <?php } ?>
                </tbody>
              </table>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>
<!-- My Account End -->
<?php include 'footer.php'; ?>