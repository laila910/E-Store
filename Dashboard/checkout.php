<?php


include './admin/helpers/functions.php';

include './admin/helpers/checkLogin.php';
include './admin/helpers/dbconnection.php';

include 'header.php';

include 'navbar.php';
  
if(isset($_GET['session'])){
    $session=$_GET['session'];
    $customerid=$_SESSION['users']['id'];
}


?>
 
        
        <!-- Checkout Start -->
        <div class="checkout">
            <div class="container-fluid"> 
                <div class="row">
                
                    <div class="col-lg-8">
                        <div class="checkout-inner">
                            <div class="billing-address">
                                <h2>Billing Address</h2>
                                <div class="row">
                                    <div class="col-md-6">
                                        <label>First Name</label>
                                        <input class="form-control" type="text" name="firstName" value="<?php if($_SESSION['users']['firstName']){echo $_SESSION['users']['firstName'];}?>" placeholder="First Name">
                                    </div>
                                    <div class="col-md-6">
                                        <label>Last Name"</label>
                                        <input class="form-control" type="text" name="lastName" value="<?php if($_SESSION['users']['lastName']){echo $_SESSION['users']['lastName'];}?>"placeholder="Last Name">
                                    </div>
                                    <div class="col-md-6">
                                        <label>E-mail</label>
                                        <input class="form-control" type="email" name="email" value="<?php if($_SESSION['users']['email']){echo $_SESSION['users']['email'];}?>" placeholder="E-mail">
                                    </div>
                                    <div class="col-md-6">
                                        <label>Mobile No</label>
                                        <input class="form-control" type="text"  name="mobileNo" value="<?php if($_SESSION['users']['mobileNo']){echo $_SESSION['users']['mobileNo'];}?>" placeholder="Mobile No">
                                    </div>
                                    <div class="col-md-12">
                                        <label>Address</label>
                                        <input class="form-control" type="text" name="address" placeholder="Address">
                                    </div>
                                    <div class="col-md-6">
                                        <label>Country</label>
                                        <select class="custom-select"name="country">
                                            <option selected>United States</option>
                                            <option>Afghanistan</option>
                                            <option>Albania</option>
                                            <option>Algeria</option>
                                            <option>Egypt</option>
                                        </select>
                                    </div>
                                    <div class="col-md-6">
                                        <label>City</label>
                                        <input class="form-control" type="text" name="city"placeholder="City">
                                    </div>
                                    <div class="col-md-6">
                                        <label>State</label>
                                        <input class="form-control" type="text"name="state" placeholder="State">
                                    </div>
                                    <div class="col-md-6">
                                        <label>ZIP Code</label>
                                        <input class="form-control" type="text" name="zipCode"placeholder="ZIP Code">
                                    </div>
                                    <div class="col-md-12">
                                        <div class="custom-control custom-checkbox">
                                            <input type="checkbox" class="custom-control-input" id="newaccount">
                                            <label class="custom-control-label" for="newaccount">Create an account</label>
                                        </div>
                                    </div>
                                    <div class="col-md-12">
                                        <div class="custom-control custom-checkbox">
                                            <input type="checkbox" class="custom-control-input" id="shipto">
                                            <label class="custom-control-label" for="shipto">Ship to different address</label>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="shipping-address">
                                <h2>Shipping Address</h2>
                                <div class="row">
                                    <div class="col-md-6">
                                        <label>First Name</label>
                                        <input class="form-control" type="text" placeholder="First Name">
                                    </div>
                                    <div class="col-md-6">
                                        <label>Last Name"</label>
                                        <input class="form-control" type="text" placeholder="Last Name">
                                    </div>
                                    <div class="col-md-6">
                                        <label>E-mail</label>
                                        <input class="form-control" type="text" placeholder="E-mail">
                                    </div>
                                    <div class="col-md-6">
                                        <label>Mobile No</label>
                                        <input class="form-control" type="text" placeholder="Mobile No">
                                    </div>
                                    <div class="col-md-12">
                                        <label>Address</label>
                                        <input class="form-control" type="text" placeholder="Address">
                                    </div>
                                    <div class="col-md-6">
                                        <label>Country</label>
                                        <select class="custom-select">
                                            <option selected>United States</option>
                                            <option>Afghanistan</option>
                                            <option>Albania</option>
                                            <option>Algeria</option>
                                        </select>
                                    </div>
                                    <div class="col-md-6">
                                        <label>City</label>
                                        <input class="form-control" type="text" placeholder="City">
                                    </div>
                                    <div class="col-md-6">
                                        <label>State</label>
                                        <input class="form-control" type="text" placeholder="State">
                                    </div>
                                    <div class="col-md-6">
                                        <label>ZIP Code</label>
                                        <input class="form-control" type="text" placeholder="ZIP Code">
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                   </form>
                     
                    <div class="col-lg-4">
                      
                        <div class="checkout-inner">
                            <div class="checkout-summary">
                                <h1>Cart details</h1>
                                 <?php 
                                 if(isset($_GET['session'])){
                               $sql="SELECT `addtocard`.*, `product`.`productname`,`productdetails`.`productPrice`FROM `productdetails` join `product`on `productdetails`.`product_Id`=`product`.`id` join `addtocard` on `addtocard`.`carditem`=`productdetails`.`id` "; 
                                $op =mysqli_query($conn,$sql);
                                 $i=0;
                              
                               ?>
                               <table class="table table-dark">
                                    <thead>
                                      <tr>
                                       <th scope="col">Product Name </th>
                                       <th scope="col">Product Price</th>
                                       <th scope="col">Quantity</th>
                                       <th scope="col">Total</th>
                                      </tr>
                                    </thead>
                                     <tbody>
                            <?php   while($data=mysqli_fetch_assoc($op)){ ?>
                                     <tr>
                                      <th scope="row"><?php echo $data['productname'];?></th>
                                      <td><?php static $totalp=0; $totalp+=$data['productPrice'];echo $data['productPrice'].'EGP';?></td>
                                       <td><?php echo $data['quantity']; ?></td>
                                       <td><?php echo $data['productPrice']*$data['quantity'].'EGP'; ?></td>
                                        </tr>
                                   <?php } }?>
                                    </tbody>
                                </table>
                              
                            
                                <p class="sub-total">sub total <span>
                                <?php  echo $totalp;?></span></p> 
                                <p class="ship-cost">Shipping Cost<span>EGP 70</span></p>
                                <h2>Grand Total<span>EGP <?php  echo $totalp+70;?>
                                </span></h2>
                               
                            </div>

                            <div class="checkout-payment">
                                <div class="payment-methods">
                                    <h1>Payment Methods</h1>
                                   
                                    <?php if($_SERVER['REQUEST_METHOD']=='POST'){
                                        $paymenttype=$_POST['payment'];
                                        $sql="INSERT INTO `paymentmethod`( `paymentType`, `paymentAllowed`) VALUES ('$paymenttype','yes')";
                                        $op=mysqli_query($conn,$sql);
                                        $creditcardtypeid=$_POST['creditcardtypeid'];
                                        $cardExpMon=$_POST['cardExpMon'];
                                        $cardExpYr =$_Post['cardExpYr'];
                                        $cvc=$_POST['cvc'];

                                        
                                    } ?>
                                    <div class="payment-method">
                                        <div class="custom-control custom-radio">
                                         
                                            <input type="radio" class="custom-control-input" id="payment-1" name="payment">
                                            <label class="custom-control-label" for="payment-1">Paypal</label>
                                           
                                        </div>
                                        <div class="payment-content" id="payment-1-show">
                                            
                                               
                                                  <div class="mb-3">
                                                     <label for="exampleInputEmail1" class="form-label">Card Number</label>
                                                     <input type="text" class="form-control" name="creditcardtypeid" id="exampleInputEmail1" aria-describedby="emailHelp">
                                                  
                                                   </div>
                                                   <div class="mb-3">
                                                        <label for="exampleInputPassword1" class="form-label">EXP Month/Year</label>
                                                        <select class="form-select" id="validationCustom04" name="cardExpMon" required>
                                                          <option selected  value="1">1</option>
                                                          <option value="2">2</option>
                                                          <option value="3">3</option>
                                                          <option value="4">4</option>
                                                          <option value="5">5</option>
                                                          <option value="6">6</option>
                                                          <option value="7">7</option>
                                                          <option value="8">8</option>
                                                          <option value="9">9</option>
                                                          <option value="10">10</option>
                                                          <option value="11">11</option>
                                                          <option value="12">12</option>
                                                         </select>
                                                     
                                                        <select class="form-select" id="validationCustom04" name="cardExpYr" required>
                                                          <option  selected value="2010">2010</option>
                                                          <option value="2011">2011</option>
                                                          <option value="2012">2012</option>
                                                          <option value="2013">2013</option>
                                                          <option value="2014">2014</option>
                                                          <option value="2015">2015</option>
                                                          <option value="2016">2016</option>
                                                          <option value="2017">2017</option>
                                                          <option value="2018">2018</option>
                                                          <option value="2019">2019</option>
                                                          <option value="2020">2020</option>
                                                          <option value="2021">2021</option>
                                                         
                                                         </select>
                                                          
                                                     
                                                        </div>
                                                        <div class="mb-3">
                                                        <label for="exampleInputEmail1" class="form-label">CVC</label>
                                                             <input type="text" class="form-control" name="cvc" id="exampleInputEmail1" aria-describedby="emailHelp">
                                                        </div>
                                                    <button type="submit" class="btn btn-primary">Submit</button>
                                               
                                           
                                        </div>
                                    </div>
                                  
                                
                                <div class="checkout-btn">
                                    <button>Place Order</button>
                                </div>
                               
                            </div>
                        </div>
                             
                    </div>
                    
                </div>
            </div>
        </div>

        <!-- Checkout End -->
        
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
