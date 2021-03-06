<?php

  


 include './help/fun.php';
include './help/logincheck.php';
include './help/db.php';
include 'header.php';


include 'navbar.php';

?>

    <!-- Main Slider Start -->
    <div class="header">
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-3">
                    <nav class="navbar bg-light">
                        <ul class="navbar-nav">
                            <li class="nav-item">
                                <a class="nav-link" href="index.php"><i class="fa fa-home"></i>Home</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" href="bestselling.php"><i class="fa fa-shopping-bag"></i>Best Selling</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" href="newarrivals.php"><i class="fa fa-plus-square"></i>New Arrivals</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" href="footwear.php"><i class="fas fa-shoe-prints"></i>FootWear</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" href="Clothing.php"><i class="fa fa-tshirt"></i>Clothing</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" href="Watches.php"><i class="fas fa-clock"></i>Watches</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" href="Jewelry.php"><i class="fas fa-ring"></i>Jewelry</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" href="bagsaccessories.php"><i class="fas fa-shopping-bag"></i>Bags & Accessories</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" href="Eyewer.php"><i class="fas fa-glasses"></i>Eyewear</a>
                            </li>
                        </ul>
                    </nav>
                </div>
                <div class="col-md-6">
                    <div class="header-slider normal-slider">
                        <div class="header-slider-item">
                            <img src="img/slider-1.jpg" alt="Slider Image" />
                            <div class="header-slider-caption">
                                <p>You Find All You Need here </p>
                                <a class="btn" href="#"><i class="fa fa-shopping-cart"></i>Shop Now</a>
                            </div>
                        </div>
                        <div class="header-slider-item">
                            <img src="img/slider-2.jpg" alt="Slider Image" />
                            <div class="header-slider-caption">
                                <p>Ease of searching, contacting, and ordering everything you want</p>
                                <a class="btn" href="#"><i class="fa fa-shopping-cart"></i>Shop Now</a>
                            </div>
                        </div>
                        <div class="header-slider-item">
                            <img src="img/slider-3.jpg" alt="Slider Image" />
                            <div class="header-slider-caption">
                                <p>Commitment to fast delivery</p>
                                <a class="btn" href="#"><i class="fa fa-shopping-cart"></i>Shop Now</a>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-md-3">
                    <div class="header-img">
                        <div class="img-item">
                            <img src="img/category-1.jpg" />
                            <a class="img-text" href="#">
                                <p>Providing everything a woman desires in fashion and beauty</p>
                            </a>
                        </div>
                        <div class="img-item">
                            <img src="img/fashiondesign.jpg" />
                            <a class="img-text" href="#">
                                <p>Providing everything for Accessories of Women</p>
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Main Slider End -->

    <!-- Brand Start -->
    <div class="brand">
        <div class="container-fluid">
            <div class="brand-slider">
                <?php $sql ="SELECT * FROM brand";
                $op=mysqli_query($conn,$sql);
                while($data=mysqli_fetch_assoc($op)){ ?>
                <div class="brand-item"><a href="brand.php?brand=<?php echo $data['brandName'];?>"><img src="./admin/brand/uploads/<?php echo $data['brandImage']; ?>" alt=""></a></div>
              
                <?php } ?>
            </div>
        </div>
    </div>
    <!-- Brand End -->

    <!-- Feature Start-->
    <div class="feature">
        <div class="container-fluid">
            <div class="row align-items-center">
                <div class="col-lg-3 col-md-6 feature-col">
                    <div class="feature-content">
                        <i class="fab fa-cc-mastercard"></i>
                        <h2>Secure Payment</h2>
                        <p>
                            You can use any method of payment by cash or visa
                        </p>
                    </div>
                </div>
                <div class="col-lg-3 col-md-6 feature-col">
                    <div class="feature-content">
                        <i class="fa fa-truck"></i>
                        <h2>Worldwide Delivery</h2>
                        <p>
                            Delivery to anywhere in the world as soon as possible
                        </p>
                    </div>
                </div>
                <div class="col-lg-3 col-md-6 feature-col">
                    <div class="feature-content">
                        <i class="fa fa-sync-alt"></i>
                        <h2>90 Days Return</h2>
                        <p>
                            You can return the order within 90 days of receiving it
                        </p>
                    </div>
                </div>
                <div class="col-lg-3 col-md-6 feature-col">
                    <div class="feature-content">
                        <i class="fa fa-comments"></i>
                        <h2>24/7 Support</h2>
                        <p>
                            Always at your service
                        </p>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Feature End-->

    <!-- Category Start-->
    <div class="category">
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-3">
                    <div class="category-item ch-400">
                        <img src="img/category-8.jpg" />
                        <a class="category-name" href="Clothing.php">
                            <p>Women Clothes</p>
                        </a>
                    </div>
                </div>
                <div class="col-md-3">
                    <div class="category-item ch-250">
                        <img src="img/HandBags.jpg" />
                        <a class="category-name" href="bagsaccessories.php">
                            <p>HandBags</p>
                        </a>
                    </div>
                    <div class="category-item ch-150">
                        <img src="img/eyewer.jpg" />
                        <a class="category-name" href="Eyewer.php">
                            <p>Eyewear</p>
                        </a>
                    </div>
                </div>
                <div class="col-md-3">
                    <div class="category-item ch-250">
                        <img src="img/footwear.jpg" />
                        <a class="category-name" href="footwear.php">
                            <p>Footwear</p>
                        </a>
                    </div>
                    <div class="category-item ch-150">
                        <img src="img/womenwatches.jpg" />
                        <a class="category-name" href="Watches.php">
                            <p>WomenWatches</p>
                        </a>
                    </div>
                </div>
                <div class="col-md-3">
                    <div class="category-item ch-400">
                        <img src="img/jewelry.jpg" />
                        <a class="category-name" href="Jewelry.php">
                            <p>Jewelry</p>
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Category End-->

    <!-- Call to Action Start -->
    <div class="call-to-action">
        <div class="container-fluid">
            <div class="row align-items-center">
                <div class="col-md-6">
                    <h1>call us for any queries</h1>
                </div>
                <div class="col-md-6">
                    <a href="tel:0123456789">+012-345-6789</a>
                </div>
            </div>
        </div>
    </div>
    <!-- Call to Action End -->

    <!-- Featured Product Start -->
    <div class="featured-product product">
        <div class="container-fluid">
            <div class="section-header">
                <h1>Featured Product</h1>
            </div>
           
            <div class="row align-items-center product-slider product-slider-4">
              <?php 
               $sql ="SELECT `productdetails`.*,`product`.`productname`,`productimges`.`firstimage`,`productimges`.`secondimage`,`productimges`.`thirdimage` FROM `productdetails` join `product` on `productdetails`.`product_Id`=`product`.`id` join `productimges` on `productdetails`.`id` =`productimges`.`product_id` WHERE `featured`='true' ORDER BY `productdetails`.`id` desc";
               $op = mysqli_query($conn,$sql);
           
    
               while($data=mysqli_fetch_assoc($op)){
                   
                  ?>

                       
               
                
               
                <div class="col-lg-3">
                    <div class="product-item">
                        <div class="product-title">
                            <a href="product-detail?id=<?php echo $data['id'];?>"><?php echo $data['productname']; ?> </a>
                            
                        </div>
                        <div class="product-image">
                            <a href="product-detail.html">
                                <img src="admin\productimages\uploads\<?php echo $data['firstimage'];?>" alt="Product Image">
                            </a>
                            <div class="product-action">
                            
                               <button class="btn" type="Submit" name="submitcard" onclick="window.location.href='cart.php?id=<?php echo $data['id'];?>&quantity=<?php echo 1;?>'"> <i class="fa fa-cart-plus"></i></button>
                               
                                <button class="btn" type="Submit" name="submitwhishlist" onclick="window.location.href='wishlist.php?id=<?php  echo $data['id'];?>'"><i class="fa fa-heart"></i></button>

                                <button class="btn"  type="Submit" name="submitproductdetails" onclick="window.location.href='product-detail.php?id=<?php echo $data['id'];?>'"><i class="fa fa-search"></i></button>
                             
                            </div>
                        </div>
                        <div class="product-price">
                        
                            <h3><span>EGP</span><?php echo $data['productPrice']; ?></h3>
                            <button class="btn" type="Submit" name="submitwhishlist" onclick="window.location.href='cart.php?id=<?php echo $data['id'];?>&quantity=<?php echo 1;?>'"><i class="fa fa-shopping-cart"></i>Buy Now</button>
                       
                        </div>
                    </div>
                </div>
               
               <?php } ?>


               
                
               
               
            </div>
        </div>
    </div>
    <!-- Featured Product End -->

    <!-- Newsletter Start -->
    <div class="newsletter">
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-6">
                    <h1>Subscribe Our Newsletter</h1>
                </div>
                <div class="col-md-6">
                    <div class="form">
                        <input type="email" value="Your email here">
                        <button>Submit</button>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Newsletter End -->

    <!-- Recent Product Start -->
    <div class="recent-product product">
        <div class="container-fluid">
            <div class="section-header">
                <h1>Recent Product</h1>
            </div>
            <div class="row align-items-center product-slider product-slider-4">
              <?php   $sql = "SELECT `productdetails`.*,`product`.`productname`,`productimges`.`firstimage`,`productimges`.`secondimage`,`productimges`.`thirdimage`,`categoreis`.`categoryname` ,`productdetails`.`productMadeDate` FROM `productdetails` join `product` on `productdetails`.`product_Id`=`product`.`id` join `productimges` on `productdetails`.`id` =`productimges`.`product_id` join `categoreis` on `product`.`product_cat_id`=`categoreis`.`id` ORDER BY `productdetails`.`productMadeDate` desc  ";
                               $op =mysqli_query($conn,$sql);
                               
                                while($data = mysqli_fetch_assoc($op)){?>
                <div class="col-lg-3">
                    <div class="product-item">
                        <div class="product-title">
                            <a href="product-detail?id=<?php echo $data['id'];?>"><?php echo $data['productname']; ?></a>
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
                                <img src="admin\productimages\uploads\<?php echo $data['firstimage'];?>" alt="Product Image">
                            </a>
                            <div class="product-action">
                                <a href="cart.php?id=<?php echo $data['id'];?>"><i class="fa fa-cart-plus"></i></a>
                                <a href="wishlist.php?id=<?php echo $data['id']; ?>"><i class="fa fa-heart"></i></a>
                                <a href="product-detail.php?id=<?php echo $data['id'];?>"><i class="fa fa-search"></i></a>
                            </div>
                        </div>
                        <div class="product-price">
                            <h3><span>EGP</span><?php echo $data['productPrice']; ?></h3>
                            <a class="btn" href="cart.php?id=<?php echo $data['id'];?>"><i class="fa fa-shopping-cart"></i>Buy Now</a>
                        </div>
                    </div>
                </div>
                  <?php } ?>
             
              
            
            </div>
        </div>
    </div>
    <!-- Recent Product End -->

 

   <?php
include 'footer.php';
   ?>