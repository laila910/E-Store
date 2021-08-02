<?php



 include './help/fun.php';
include './help/logincheck.php';
include './help/db.php';
include 'header.php';
include 'navbar.php';

 
    
   $id = '';
   if($_SERVER['REQUEST_METHOD'] == "GET"){
        $id  = Validate(Sanitized($_GET['id'],1),3);
       $quantity=  Validate(Sanitized($_GET['quantity'],1),3);
       
 
     $carditem=$id;
     $quan=$quantity;
     $customerid=$_SESSION['users']['id'];
     

  $sql2=  "INSERT INTO `addtocard`( `customerId`, `carditem`,`quantity`) VALUES ('$customerid','$carditem','$quan')";
  $op2=mysqli_query($conn,$sql2);
   }

?>

   

    <!-- Cart Start -->
    <div class="cart-page">
        <div class="container-fluid">
            <div class="row">
                <div class="col-lg-8">
                    <div class="cart-page-inner">
                        <div class="table-responsive">
                            <table class="table table-bordered">
                                <thead class="thead-dark">
                                    <tr>
                                        <th>Product</th>
                                        <th>Price</th>
                                        <th>Quantity</th>
                                        <th>Total</th>
                                        <th>Remove</th>
                                    </tr>
                                </thead>
                                <tbody class="align-middle">
                                     <?php 
                                $sql = "SELECT `addtocard`.*,`productdetails`.`productPrice`,`productdetails`.`id` as `prodetId`,`product`.`productname` ,`productimges`.`firstimage` FROM `addtocard` join `productdetails` on `addtocard`.`carditem`=`productdetails`.`id` join `product` on `productdetails`.`product_Id` = `product`.`id` join `productimges` on `productdetails`.`id`=`productimges`.`product_id` ORDER BY `addtocard`.`id` desc";
                                $op  = mysqli_query($conn,$sql); 
                                
                                while($data = mysqli_fetch_assoc($op)){
                             
                             ?>     
                                    <tr>
                                        <td>
                                            <div class="img">
                                                <a href="product-detail.php?id=<?php echo $data['prodetId']; ?>"><img src="admin/productimages/uploads/<?php echo $data['firstimage'] ?>" alt="Image"></a>
                                                <p><?php echo $data['productname'];  ?> </p>
                                            </div>
                                        </td>
                                        <td><?php echo $data['productPrice']; ?></td>
                                        <td>
                                            <div class="qty">
                                                <a href=""> <button class="btn-minus"><i class="fa fa-minus"></i></button></a>
                                                <input type="text" value="<?php  echo $data['quantity']; ?> ">
                                                 <a href=""><button class="btn-plus"><i class="fa fa-plus"></i></button></a>
                                            </div>
                                        </td>
                                        <td><?php $total = $data['productPrice'] * $data['quantity'];static $subtotal=0; 
                                           $subtotal+=$total; 
                                        echo $total.' '.'EGP';?></td>


                                        <td><a href="delete.php?id=<?php echo $data['id'];?>&table=<?php echo 'addtocard';?>&page=<?php echo 'cart';?>"><button><i class="fa fa-trash"></i></button></a></td>
                                    </tr>
                                   
                                     <?php } ?>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
                <div class="col-lg-4">
                    <div class="cart-page-inner">
                        <div class="row">
                            <div class="col-md-12">
                                <div class="coupon">
                                    <input type="text" placeholder="Coupon Code">
                                    <button>Apply Code</button>
                                </div>
                            </div>
                            <div class="col-md-12">
                                <div class="cart-summary">
                                    <div class="cart-content">
                                        <h1>Cart Summary</h1>
                                        <p>Sub Total<span><?php echo $subtotal.' '.'EGP'; ?></span></p>
                                        <p>Shipping Cost<span><?php echo '70 EGP' ; ?> </span></p>
                                        <h2>Grand Total<span><?php $grandTotal= $subtotal + 70; echo $grandTotal; ?> </span></h2>
                                    </div>
                                    <div class="cart-btn">
                                        <a class="btn btn-primary btn-lg" href="updatecard.php" role="button">Update Card</a>
                                       <a class="btn btn-primary btn-lg" href="checkout.php" role="button">CheckOut</a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Cart End -->

    <!-- Footer Start -->
    <div class="footer">
        <div class="container-fluid">
            <div class="row">
                <div class="col-lg-3 col-md-6">
                    <div class="footer-widget">
                        <h2>Get in Touch</h2>
                        <div class="contact-info">
                            <p><i class="fa fa-map-marker"></i>123 E Store, Los Angeles, USA</p>
                            <p><i class="fa fa-envelope"></i>email@example.com</p>
                            <p><i class="fa fa-phone"></i>+123-456-7890</p>
                        </div>
                    </div>
                </div>

                <div class="col-lg-3 col-md-6">
                    <div class="footer-widget">
                        <h2>Follow Us</h2>
                        <div class="contact-info">
                            <div class="social">
                                <a href=""><i class="fab fa-twitter"></i></a>
                                <a href=""><i class="fab fa-facebook-f"></i></a>
                                <a href=""><i class="fab fa-linkedin-in"></i></a>
                                <a href=""><i class="fab fa-instagram"></i></a>
                                <a href=""><i class="fab fa-youtube"></i></a>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="col-lg-3 col-md-6">
                    <div class="footer-widget">
                        <h2>Company Info</h2>
                        <ul>
                            <li><a href="#">About Us</a></li>
                            <li><a href="#">Privacy Policy</a></li>
                            <li><a href="#">Terms & Condition</a></li>
                        </ul>
                    </div>
                </div>

                <div class="col-lg-3 col-md-6">
                    <div class="footer-widget">
                        <h2>Purchase Info</h2>
                        <ul>
                            <li><a href="#">Pyament Policy</a></li>
                            <li><a href="#">Shipping Policy</a></li>
                            <li><a href="#">Return Policy</a></li>
                        </ul>
                    </div>
                </div>
            </div>

            <div class="row payment align-items-center">
                <div class="col-md-6">
                    <div class="payment-method">
                        <h2>We Accept:</h2>
                        <img src="img/payment-method.png" alt="Payment Method" />
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="payment-security">
                        <h2>Secured By:</h2>
                        <img src="img/godaddy.svg" alt="Payment Security" />
                        <img src="img/norton.svg" alt="Payment Security" />
                        <img src="img/ssl.svg" alt="Payment Security" />
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Footer End -->

    <!-- Footer Bottom Start -->
    <div class="footer-bottom">
        <div class="container">
            <div class="row">
                <div class="col-md-6 copyright">
                    <p>Copyright &copy; <a href="https://htmlcodex.com">HTML Codex</a>. All Rights Reserved</p>
                </div>

                <div class="col-md-6 template-by">
                    <p>Template By <a href="https://htmlcodex.com">HTML Codex</a></p>
                </div>
            </div>
        </div>
    </div>
    <!-- Footer Bottom End -->

    <!-- Back to Top -->
    <a href="#" class="back-to-top"><i class="fa fa-chevron-up"></i></a>

    <!-- JavaScript Libraries -->
    <script src="https://code.jquery.com/jquery-3.4.1.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.bundle.min.js"></script>
    <script src="lib/easing/easing.min.js"></script>
    <script src="lib/slick/slick.min.js"></script>

    <!-- Template Javascript -->
    <script src="js/main.js"></script>
</body>

</html>