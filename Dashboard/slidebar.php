  <!-- Side Bar Start -->
                <div class="col-lg-4 sidebar">
                    <div class="sidebar-widget category">
                        <h2 class="title">Category</h2>
                        <nav class="navbar bg-light">
                            <ul class="navbar-nav">
                                <li class="nav-item">
                                    <a class="nav-link" href="footwear.php"><i class="fa fa-female"></i>FootWear</a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link" href="Clothing.php"><i class="fa fa-child"></i>Clothing</a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link" href="Watches.php"><i class="fa fa-tshirt"></i>Watches</a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link" href="Jewelry.php"><i class="fa fa-mobile-alt"></i>Jewelry</a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link" href="bagsaccessories.php"><i class="fa fa-microchip"></i>Bags & Accessories</a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link" href="Eyewer.php"><i class="fa fa-microchip"></i>EyeWear</a>
                                </li>
                            </ul>
                        </nav>
                    </div>

                    <div class="sidebar-widget widget-slider">
                        
                        <div class="sidebar-slider normal-slider">
                               
                           <?php 
                           $sql = "SELECT `productdetails`.*,`product`.`productname` FROM `productdetails` join `product` on `productdetails`.`product_Id`=`product`.`id`";
                           $op =mysqli_query($conn,$sql);
                             
                                while($data = mysqli_fetch_assoc($op)){
                             
                             ?>  
                        


                            <div class="product-item">
                                <div class="product-title">
                                    <a href="#"><?php echo $data['productname'];  ?></a>
                                    <div class="ratting">
                                        <i class="fa fa-star"></i>
                                        <i class="fa fa-star"></i>
                                        <i class="fa fa-star"></i>
                                        <i class="fa fa-star"></i>
                                        <i class="fa fa-star"></i>
                                    </div>
                                </div>
                                <div class="product-image">
                                    <a href="product-detail.html">
                                        <img src="img/product-10.jpg" alt="Product Image">
                                    </a>
                                    <div class="product-action">
                                        <a href="#"><i class="fa fa-cart-plus"></i></a>
                                        <a href="#"><i class="fa fa-heart"></i></a>
                                        <a href="#"><i class="fa fa-search"></i></a>
                                    </div>
                                </div>
                                <div class="product-price">
                                    <h3><span>EGP</span><?php echo $data['productPrice']; ?></h3>
                                    <a class="btn" href=""><i class="fa fa-shopping-cart"></i>Buy Now</a>
                                </div>
                            </div>
                            <?php } ?>
                            
                        


                        </div>
                            
                    </div>

                    <div class="sidebar-widget brands">
                        <h2 class="title">Our Brands</h2>
                        <ul>
                             <?php 
                           $sql = "SELECT `brand`.* FROM `brand` ";
                           $op =mysqli_query($conn,$sql);
                             
                                while($data = mysqli_fetch_assoc($op)){
                             
                             ?>  
                        

                            <li><a href="#"><?php echo $data['brandName']; ?> </a><span></span></li>
                           
                                   <?php } ?>
                          
                        </ul>
                    </div>

                   
                </div>
                <!-- Side Bar End -->