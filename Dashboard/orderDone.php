 <?php
  include './help/fun.php';

  include './help/logincheck.php';
  include './help/db.php';
  include './header.php';

  include './navbar.php';
  if (isset($_GET['cardId'])) {
    $cardId = Sanitized($_GET['cardId'], 1);
    $t = time(); //current time
    $t1 = time() + (1 * 24 * 60 * 60); //oneday
    $t2 = time() + (2 * 24 * 60 * 60); //twoday
    $shipdate = date("Y-m-d", $t1); //oneday
    $requireddate = date("Y-m-d", $t2); //twodays
    $paymentdate = date("Y-m-d", $t2);

    $carditem = Sanitized($_GET['cardItem'], 1);
    $totalprice = Sanitized($_GET['totalprice'], 1);

    $sql = "INSERT INTO `orders`(`card_id`,`shipdate`, `requireddate`,`paymentdate`) VALUES ('$cardId','$shipdate','$requireddate','$paymentdate')";
    $op = mysqli_query($conn, $sql);


    $sql1 = "SELECT `orders`.`id` FROM `orders` WHERE `card_id`='$cardId'";
    $op1 = mysqli_query($conn, $sql1);
    $data = mysqli_fetch_assoc($op1);


    $ordernumber = $data['id'];

    $sql2 = "INSERT INTO `orderdetailes`(`ordernumber`,`totalprice`) VALUES ('$ordernumber','$totalprice')";
    $op2 = mysqli_query($conn, $sql2);


    $sql3 = "SELECT `orderdetailes`.`id` from `orderdetailes` WHERE `ordernumber`='$ordernumber' ";
    $op3 = mysqli_query($conn, $sql3);
    $data1 = mysqli_fetch_assoc($op3);


    $orderdetailsId = $data1['id'];

    $sql4 = "INSERT INTO `orderproducts`(`orderdetails_id`, `productdetails_id`) VALUES ('$orderdetailsId','$carditem')";
    $op4 = mysqli_query($conn, $sql4);


    $sql5 = "SELECT `orders`.*,`product`.`productname`,`productimges`.`firstimage`,`productdetails`.`productPrice` FROM addtocard join `orders` on `orders`.`card_id`=`addtocard`.`id` join`productdetails` on `addtocard`.`carditem`=`productdetails`.`id` join `product` on `product`.`id` =`productdetails`.`product_Id` join `productimges` on `productimges`.`product_id`=`productdetails`.`id` WHERE `orders`.`id` ='$ordernumber'";
    $op5 = mysqli_query($conn, $sql5);
  }
  ?>

 <div class="card" style="width: 18rem;">
   <!-- <img src="..." class="card-img-top" alt="..."> -->
   <div class="card-body">
     <h5 class="card-title">Order</h5>
     <p class="card-text">The order will reach you within two days and the shipping company will track the delivery of your order.</p>
     <table class="table table-striped table-dark">
       <thead>
         <tr>
           <th scope="col">#</th>
           <th scope="col">Product Name</th>
           <th scope="col">FirstImage</th>
           <th scope="col">Product Price</th>
           <th scope="col">Shipdate</th>
           <th scope="col">Delivered Date</th>
           <th scope="col">Sales Tax</th>
           <th scope="col">Total Price</th>
         </tr>
       </thead>
       <tbody>
         <?php
          while ($data5 = mysqli_fetch_assoc($op5)) { ?>

           <tr>
             <td><?php echo $data5['id']; ?></td>
             <td><?php echo $data5['productname']; ?></td>
             <td><img src="admin\productimages\uploads\<?php echo $data5['firstimage']; ?>" alt="Product Image"></td>
             <td><?php echo $data5['productPrice']; ?></td>
             <td><?php echo $data5['shipdate']; ?></td>
             <td><?php echo $data5['requireddate']; ?></td>
             <td><?php echo $data5['salestax']; ?></td>
             <td><?php echo $data5['salestax'] + $totalprice; ?></td>
           </tr>
         <?php
            $ordernumber = $data5['id'];
            $productname = $data5['productname'];
            $productimage = $data5['firstimage'];
            $productprice = $data5['productPrice'];
            $shipdate = $data5['shipdate'];
            $requiredd = $data5['requireddate'];
            $salesx = $data5['salestax'];
            $totalPrice = $data5['salestax'] + $totalprice;
            $userId = $_SESSION['users']['id'];

            $sql6 = "INSERT INTO `savedorderforcustomer`(`userid`,`orderNo`,`productName`, `firstImage`, `productPrice`, `shipDate`, `deliveredDate`, `SalesTax`, `Total Price`) VALUES ('$userId','$ordernumber','$productname','$productimage','$productprice','$shipdate','$requiredd','$salesx','$totalPrice')";
            $op6 = mysqli_query($conn, $sql6);
          } ?>
       </tbody>
     </table>
   </div>
 </div>

 <?php include 'footer.php'; ?>