<?php

include 'helpers/functions.php';

include 'helpers/checkLogin.php';
include 'helpers/dbconnection.php';

include 'header.php';

include 'navbar.php';
 $sql = "SELECT `whishlist`.* ,`product`.`productname` ,`productdetails`.`productPrice`from `whishlist` join `productdetails` on `whishlist`.`productid` = `productdetails`.`id` join `product` on `productdetails`.`product_Id` =`product`.`id` join `productimges` on `productimges`.`product_id`=`productdetails`.`id`";
  $op  = mysqli_query($conn,$sql); 

?>
  

    <!-- Wishlist Start -->
    <div class="wishlist-page">
        <div class="container-fluid">
            <div class="wishlist-page-inner">
                <div class="row">
                    <div class="col-md-12">
                        <div class="table-responsive">
                            <table class="table table-bordered">
                                <thead class="thead-dark">
                                    <tr>
                                        <th>  # </th>
                                        <th>Product</th>
                                        <th>Price</th>
                                        <th>Quantity</th>
                                        <th>Add to Cart</th>
                                        <th>Remove</th>
                                    </tr>
                                </thead>
                                <tbody class="align-middle">
                                    <?php 
                             
                                while($data = mysqli_fetch_assoc($op)){
                             
                             ?>     
                                    <tr>
                                        <td> <?php $data['id'];?></td>
                                        <td>
                                            <div class="img">
                                                <a href="#"><img src="./admin/productimages/uploads/<?php echo $data['firstimage']; ?>" alt="Image"></a>
                                                <p><?php echo $data['productname']; ?></p>
                                            </div>
                                        </td>
                                        <td><?php echo $data['productPrice']; ?></td>
                                        <td>
                                            <div class="qty">
                                                <button class="btn-minus"><i class="fa fa-minus"></i></button>
                                                <input type="text" value="<?php echo $data['quantity'];?>">
                                                <button class="btn-plus"><i class="fa fa-plus"></i></button>
                                            </div>
                                        </td>
                                        <td><button class="btn-cart">Add TO Card</button></td>
                                        <td><button><i class="fa fa-trash"></i></button></td>
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
    <!-- Wishlist End -->

   <?php
include 'footer.php';
   ?>