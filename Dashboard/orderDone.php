 <?php 
 include './help/fun.php';
include './help/logincheck.php';
include './help/db.php';
include 'header.php';
include 'navbar.php';
?>

<div class="card" style="width: 18rem;">
  <!-- <img src="..." class="card-img-top" alt="..."> -->
  <div class="card-body">
    <h5 class="card-title">Order</h5>
    <p class="card-text">The order will reach you within two days and the shipping company will track the delivery of your order.</p>
    <a href="orderdetails.php" class="btn btn-primary">Please wait for details</a>
  </div>
</div>

 <?php include 'footer.php';?>