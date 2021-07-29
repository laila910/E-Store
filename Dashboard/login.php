<?php

  


include 'helpers/functions.php';

include 'helpers/checkLogin.php';
include 'helpers/dbconnection.php';

include 'header.php';

include 'navbar.php';

?>
 


        
       
<main style="margin-bottom:10px">

<!-- Login Start -->
  <?php 
  if(!isset($_SESSION['useremail'])){
    
      echo'
       <div class="login">
            <div class="container-fluid">
                <div class="row">
                  <div class="col-lg-12">
                        <div class="login-form" method="post" action="includes/login.inc.php" enctype="multipart/form-data" >
                            <div class="row">
                                <div class="col-md-6">
                                    <label>E-mail </label>
                                    <input class="form-control" type="text" name="email" placeholder="E-Mail">
                                </div>
                                <div class="col-md-6">
                                    <label>Password</label>
                                    <input class="form-control" type="text" name="password" placeholder="Password">
                                </div>
                                <div class="col-md-12">
                                    <div class="custom-control custom-checkbox">
                                        <input type="checkbox" class="custom-control-input" id="newaccount">
                                        <label class="custom-control-label" for="newaccount">Keep me signed in</label>
                                    </div>
                                </div>
                                <div class="col-md-12">
                                   <input class="btn btn-primary"  name="login-submit" type="submit" value="login" >
                                    
                                </div>
                            </div>
                        </div>
                         <a style="border:1px solid #FF6F61;border-radius:3px;padding:8px" href="signup.php">Sign-Up</a>
                    </div>
                </div>
            </div>
        </div>
        ';}else{
            echo'
           <div class="login">
            <div class="container-fluid">
                <div class="row">
                  <div class="col-lg-12">
                        <div class="login-form" method="post" action="includes/logout.php" enctype="multipart/form-data" >
                            <div class="row">
                              <div class="col-md-12">
                                    <button type="button" class="btn " name="logout-submit" >LogOut</button>
                                </div>
                            </div>
                        </div>
                        
                    </div>
                </div>
            </div>
        </div>';
        }
        ?>
    <!-- Login End -->
       <?php
   if(isset($_SESSION['useremail'])){
       echo '<p>You are Logged in!</p>';
       
   }else{
       echo '<p style="text-align:center;font-weight:bolder">You are Logged out!</p>';
      
   }
 
?>
    
</main>
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
