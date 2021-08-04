<?php

  



include './admin/helpers/functions.php';

include './admin/helpers/checkLogin.php';
include './admin/helpers/dbconnection.php';

include 'header.php';

include 'navbar.php';



?>
 

    <!-- Product List Start -->
    <div class="product-view">
        <div class="container-fluid">
            <div class="row">
                <div class="col-lg-8">
                    <div class="row">
                        <div class="col-md-12">
                            <div class="product-view-top">
                                <div class="row">
                                    <div class="col-md-4">
                                        <div class="product-search">
                                            <input type="email" value="Search">
                                            <button><i class="fa fa-search"></i></button>
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="product-short">
                                            <div class="dropdown">
                                                <div class="dropdown-toggle" data-toggle="dropdown">Product short by</div>
                                                <div class="dropdown-menu dropdown-menu-right">
                                                    <a href="#" class="dropdown-item">Newest</a>
                                                    <a href="#" class="dropdown-item">Popular</a>
                                                    <a href="#" class="dropdown-item">Most sale</a>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="product-price-range">
                                            <div class="dropdown">
                                                <div class="dropdown-toggle" data-toggle="dropdown">Product price range</div>
                                                <div class="dropdown-menu dropdown-menu-right">
                                                    <a href="#" class="dropdown-item">$0 to $50</a>
                                                    <a href="#" class="dropdown-item">$51 to $100</a>
                                                    <a href="#" class="dropdown-item">$101 to $150</a>
                                                    <a href="#" class="dropdown-item">$151 to $200</a>
                                                    <a href="#" class="dropdown-item">$201 to $250</a>
                                                    <a href="#" class="dropdown-item">$251 to $300</a>
                                                    <a href="#" class="dropdown-item">$301 to $350</a>
                                                    <a href="#" class="dropdown-item">$351 to $400</a>
                                                    <a href="#" class="dropdown-item">$401 to $450</a>
                                                    <a href="#" class="dropdown-item">$451 to $500</a>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                         <?php 
                           mysqli_select_db($conn,'pagination');
                            $results_per_page=6;
                             $sql = "SELECT `productdetails`.*,`product`.`productname`,`productimges`.`firstimage` FROM `productdetails` join `product` on `productdetails`.`product_Id`=`product`.`id` join `productimges` on `productdetails`.`id` =`productimges`.`product_id` ORDER BY `productdetails`.`id` desc  ";
                            $op =mysqli_query($conn,$sql);
                            $number_of_results=mysqli_num_rows($op);
                        
                             if(!isset($_GET['page'])){
                              $page=1;
                            }else{
                                $page =$_GET['page'];
                            }
                              $this_page_first_result = ($page-1)*$results_per_page;
                               $sql = "SELECT `productdetails`.*,`product`.`productname`,`productimges`.`firstimage` FROM `productdetails` join `product` on `productdetails`.`product_Id`=`product`.`id` join `productimges` on `productdetails`.`id` =`productimges`.`product_id`  ORDER BY `productdetails`.`productMadeDate` desc LIMIT " .$this_page_first_result.','.$results_per_page;
                                 $op =mysqli_query($conn,$sql);
                               
                                while($data = mysqli_fetch_assoc($op)){
                             
                             ?>     


                        <div class="col-md-4">
                            <div class="product-item">
                                <div class="product-title">
                                    <a href="product-detail.php"><?php echo $data['productname']; ?></a>
                                    
                                </div>
                                <div class="product-image">
                                    <a href="product-detail.php">
                                        <img src="admin\productimages\uploads\<?php echo $data['firstimage'];?>" alt="Product Image">
                                    </a>
                                    <div class="product-action">
                                        <a href="cart.php?id=<?php echo $data['id'];?>&quantity=<?php echo 1;?>"><i class="fa fa-cart-plus"></i></a>
                                        <a href="wishlist.php?id=<?php  echo $data['id'];?>"><i class="fa fa-heart"></i></a>
                                        <a href="product-detail.php?id=<?php echo $data['id'];?>"><i class="fa fa-search"></i></a>
                                    </div>
                                </div>
                                <div class="product-price">
                                    <h3><span>EGP</span><?php echo $data['productPrice']; ?></h3>
                                    <a class="btn" href="cart.php?id=<?php echo $data['id'];?>&quantity=<?php echo 1;?>"><i class="fa fa-shopping-cart"></i>Buy Now</a>
                                </div>
                            </div>
                        </div>

                      <?php } ?>



                    </div>
                       <?php  $number_f_pages=ceil($number_of_results/$results_per_page); ?>
                    <!-- Pagination Start -->
                    <div class="col-md-12">
                        <nav aria-label="Page navigation example">
                            <ul class="pagination justify-content-center">
                                  <?php for($page=1;$page<=$number_f_pages;$page++){?>
                                <li class="page-item ">
                                    <a class="page-link" href='product-list.php?page=<?php echo $page;?>'><?php echo $page;?></a>
                                </li>
                                   <?php }?>
                            </ul>
                        </nav>
                    </div>
                    <!-- Pagination Start -->
                </div>

         <?php include 'slidebar.php'; ?>
            </div>
        </div>
    </div>
    <!-- Product List End -->

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
<?php
include  'footer.php';
?>