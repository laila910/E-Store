
 <?php


include './help/fun.php';

include './help/logincheck.php';
include './help/db.php';
include './header.php';

include './navbar.php';





?>      
        
        <!-- Product Detail Start -->
        <div class="product-detail">
            <div class="container-fluid">
                <div class="row">

                    <div class="col-lg-8">
                     <?php
                       
                      if(isset($_GET['id'])){
 
                      $productId = Sanitized($_GET['id'],1);
                     
     
                   
                     $customerid=$_SESSION['users']['id'];

                    $sql = "SELECT `productdetails`.*,`product`.`productname`,`productimges`.`firstimage`,`productimges`.`secondimage`,`productimges`.`thirdimage`,`productsizes`.`S`,`productsizes`.`M`,`productsizes`.`L`,`productsizes`.`XL` ,`productcolor`.`firstcolor`,`productcolor`.`secondcolor`,`productcolor`.`thirdcolor` FROM `productdetails` join `product` on `productdetails`.`product_Id`=`product`.`id` join `productimges` on `productdetails`.`id` =`productimges`.`product_id` join `productsizes` on `productsizes`.`id_size`=`productdetails`.`size_id` join `productcolor` on `productcolor`.`id`=`productdetails`.`color_id` WHERE  `productdetails`.`id`='$productId'";
                     
                    $op =mysqli_query($conn,$sql);
                   
                            
                     while($data = mysqli_fetch_assoc($op)){
  




                      ?>




                        <div class="product-detail-top">

                            <div class="row align-items-center">

                             
                                <div class="col-md-5">
                                    <div class="product-slider-single normal-slider">
                                        <img src="admin\productimages\uploads\<?php echo $data['firstimage'];?>" alt="Product First Image">
                                        <img src="admin\productimages\uploads\<?php echo $data['secondimage'];?>" alt="Product Second Image">
                                        <img src="admin\productimages\uploads\<?php echo $data['thirdimage'];?>" alt="Product Third Image">
                                        
                                    </div>
                                    <div class="product-slider-single-nav normal-slider">
                                        <div class="slider-nav-img"><img src="admin\productimages\uploads\<?php echo $data['firstimage'];?>" alt="Product Image"></div>
                                        <div class="slider-nav-img"><img src="admin\productimages\uploads\<?php echo $data['secondimage'];?>" alt="Product Image"></div>
                                        <div class="slider-nav-img"><img src="admin\productimages\uploads\<?php echo $data['thirdimage'];?>" alt="Product Image"></div>
                                        
                                    </div>
                                </div>
                              
                                <div class="col-md-7">
                                    <div class="product-content">
                                        <div class="title"><h2><?php echo $data['productname'];?></h2></div>
                                       
                                        <div class="price">
                                            <h4>Price:</h4>
                                            <p> <?php echo $data['productPrice'] .'EGP';?></p>
                                        </div>
                                        <div class="quantity">
                                            <h4>Quantity:</h4>
                                            <div class="qty">
                                                <button class="btn-minus"><i class="fa fa-minus"></i></button>
                                                <input type="text" value="1">
                                                <button class="btn-plus"><i class="fa fa-plus"></i></button>
                                            </div>
                                        </div>
                                        <div class="p-size">
                                            <h4>Size:</h4>
                                            <div class="btn-group btn-group-sm">
                                                <button type="button" class="btn"><?php echo $data['S'];?></button>
                                                <button type="button" class="btn"><?php echo $data['M'];?></button>
                                                <button type="button" class="btn"><?php echo $data['L'];?></button>
                                                <button type="button" class="btn"><?php echo $data['XL']; ?></button>
                                            </div> 
                                        </div>
                                        <div class="p-color">
                                            <h4>Color:</h4>
                                            <div class="btn-group btn-group-sm">
                                                <button type="button" class="btn"><?php echo $data['firstcolor'];?></button>
                                                <button type="button" class="btn"><?php echo $data['secondcolor'];?></button>
                                                <button type="button" class="btn"><?php echo $data['thirdcolor'];?></button>
                                            </div> 
                                        </div>
                                        <div class="action">
                                            <a class="btn" href="cart.php?id=<?php echo $data['id'];?>&quantity=<?php echo 1;?>"><i class="fa fa-shopping-cart"></i>Add to Cart</a>
                                            <a class="btn" href="cart.php?id=<?php echo $data['id'];?>&quantity=<?php echo 1;?>"><i class="fa fa-shopping-bag"></i>Buy Now</a>
                                        </div>
                                    </div>
                                </div>



                                
                            </div>
                        </div>
                        
                        <div class="row product-detail-bottom">
                            <div class="col-lg-12">
                                <ul class="nav nav-pills nav-justified">
                                    <li class="nav-item">
                                        <a class="nav-link active" data-toggle="pill" href="#description">Description</a>
                                    </li>
                                    <li class="nav-item">
                                        <a class="nav-link" data-toggle="pill" href="#specification">Specification</a>
                                    </li>
                                    <li class="nav-item">
                                        <a class="nav-link" data-toggle="pill" href="#reviews">Reviews (1)</a>
                                    </li>
                                </ul>

                                <div class="tab-content">
                                    <div id="description" class="container tab-pane active">
                                        <h4>Product description</h4>
                                        <p>
                                           <?php echo $data['product_Description'];?>
                                        </p>
                                    </div>
                                    <div id="specification" class="container tab-pane fade">
                                        <h4>Product specification</h4>
                                        <p>
                                             <?php echo $data['product_Specificaton'];?>
                                       </p>
                                    </div>
                                    <div id="reviews" class="container tab-pane fade">
                                        <?php $sql1="SELECT `productreview`.* FROM `productreview` join `productdetails` on `productreview`.`productreview` =`productdetails`.`id` where `productdetails`.`id`='$productId'";
                                        $op1=mysqli_query($conn,$sql1);
                                       while( $fdata=mysqli_fetch_assoc($op1)){ ?>
                                        <div class="reviews-submitted">
                                            <div class="reviewer"><?php echo $fdata['reviewerName'];?> <span><?php echo $fdata['	review_Made_Date'];?></span></div>
                                            
                                            <p>
                                               <?php echo $fdata['reviewerComment'];?>
                                            </p>
                                        </div>
                                         <?php } ?>
                                        <div class="reviews-submit">
                                            <h4>Give your Review:</h4>
                                            <?php if($_SERVER['REQUEST_METHOD']=='POST'){
                                                $reviewercomment=$_POST['reviewerComment'];
                                                $reviewerName=$_SESSION['users']['firstName'];
                                                $reviewerEmail=$_SESSION['users']['email'];
                                                $productreview=$_SESSION['users']['id'];
                                                $sql2="INSERT INTO `productreview`( `productreview`, `reviewerName`, `reviewerEmail`, `reviewerComment`) VALUES ('$productreview','$reviewerName','$reviewerEmail','$reviewercomment')";
                                                $op2=mysqli_query($conn,$sql2);
                                           


                                                }?>
                                            <form class="form" method="post" action="<?php echo $_SERVER['PHP_SELF'];?>">
                                                
                                              
                                                    <textarea name="reviewerComment" placeholder="Review"></textarea>
                                               
                                                    <button>Submit</button>
                                              
                                            </form>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        

<?php }}?>






                        <div class="product">
                            <div class="section-header">
                                <h1>Related Products</h1>
                            </div>


                            <div class="row align-items-center product-slider product-slider-3">
                               <?php  
                             $sql = "SELECT `categoreis`.`categoryname` FROM `productdetails` join `product` on `productdetails`.`product_Id`=`product`.`id` join `categoreis` on `product`.`product_cat_id` =`categoreis`.`id` WHERE `productdetails`.`id`='$productId' ORDER BY `productdetails`.`id` desc ";
                            $op =mysqli_query($conn,$sql);
                            $data= mysqli_fetch_assoc($op);
                            $categoryname=$data['categoryname'];
                           
                           
                               $sql7 = "SELECT `productdetails`.*,`product`.`productname`,`productimges`.`firstimage` FROM `productdetails` join `product` on `productdetails`.`product_Id`=`product`.`id` join `productimges` on `productdetails`.`id` =`productimges`.`product_id`  join `categoreis` on `product`.`product_cat_id` =`categoreis`.`id` WHERE `categoreis`.`categoryname`='$categoryname' ORDER BY `productdetails`.`productMadeDate` desc  " ;
                                 $op7=mysqli_query($conn,$sql7);
                               
                                while($fd= mysqli_fetch_assoc($op7)){?>
                                <div class="col-lg-3">
                                    <div class="product-item">
                                        <div class="product-title">
                                            <a href="#"><?php echo $fd['productname'];?></a>
                                          
                                        </div>
                                        <div class="product-image">
                                            <a href="product-detail.php">
                                                <img src="admin\productimages\uploads\<?php echo $fd['firstimage'];?>" alt="Product Image">
                                            </a>
                                            <div class="product-action">
                                                <a href="cart.php?id=<?php echo $data['id'];?>&quantity=<?php echo 1;?>"><i class="fa fa-cart-plus"></i></a>
                                                <a href="wishlist.php?id=<?php  echo $data['id'];?>"><i class="fa fa-heart"></i></a>
                                                <a href="product-detail.php?id=<?php echo $data['id'];?>"><i class="fa fa-search"></i></a>
                                            </div>
                                        </div>
                                        <div class="product-price">
                                            <h3><span>EGP</span><?php echo $fd['productPrice']; ?></h3>
                                            <a class="btn" href="cart.php?id=<?php echo $data['id'];?>&quantity=<?php echo 1;?>"><i class="fa fa-shopping-cart"></i>Buy Now</a>
                                        </div>
                                    </div>
                                </div>

                              <?php }?>

                            </div>
                        </div>
                    </div>
                    
                   <?php include 'slidebar.php'; ?>
                </div>
            </div>
        </div>
        <!-- Product Detail End -->
        
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
  <?php include 'footer.php';?>