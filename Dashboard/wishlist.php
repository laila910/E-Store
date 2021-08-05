<?php

include './help/fun.php';

include './help/logincheck.php';
include './help/db.php';
include './header.php';

include './navbar.php';

if (isset($_GET['id'])) {

    $id = Sanitized($_GET['id'], 1);

    $productid = $id;
    $customerid = $_SESSION['users']['id'];

    $sql2 =  "INSERT INTO `whishlist`( `productid`,`customerid`) VALUES ('$productid','$customerid')";
    $op2 = mysqli_query($conn, $sql2);
}

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
                                    <th> # </th>
                                    <th>Product</th>
                                    <th>Price</th>
                                    <th>Quantity</th>
                                    <th>Add to Cart</th>
                                    <th>Remove</th>
                                </tr>
                            </thead>
                            <tbody class="align-middle">
                                <?php
                                $customerid = $_SESSION['users']['id'];
                                $sql = "SELECT `whishlist`.*,`product`.`productname` ,`productdetails`.`productPrice` ,`productimges`.`firstimage` FROM `whishlist`join`productdetails`on `whishlist`.`productid`=`productdetails`.`id` join `product` on `productdetails`.`product_Id` =`product`.`id` join `productimges` on `productdetails`.`id` = `productimges`.`product_id` WHERE `whishlist`.`customerid`='$customerid' ORDER BY `whishlist`.`id` desc ";

                                $op  = mysqli_query($conn, $sql);



                                while ($data = mysqli_fetch_assoc($op)) {

                                ?>
                                    <tr>
                                        <td> <?php echo $data['id']; ?></td>

                                        <td>
                                            <div class="img">
                                                <a href="product-detail?id=<?php echo $data['productid']; ?>"><img src="admin/productimages/uploads/<?php echo $data['firstimage']; ?>" alt="Image"></a>
                                                <p><?php echo $data['productname']; ?></p>
                                            </div>
                                        </td>
                                        <td><?php echo $data['productPrice']; ?></td>
                                        <td>
                                            <div class="qty">
                                                <a href="#"><button class="btn-minus"><i class="fa fa-minus"></i></button></a>
                                                <input type="text" value="<?php echo $data['quantity']; ?>">
                                                <a href="#"><button class="btn-plus"><i class="fa fa-plus"></i></button></a>
                                            </div>
                                        </td>
                                        <td><a href="cart.php?id=<?php echo $data['productid']; ?>&quantity=<?php echo $data['quantity']; ?>"><button class="btn-cart">Add TO Card</button></a></td>


                                        <td><button class="btn" type="Submit" name="submitdelete" onclick="window.location.href='deletew.php?Id=<?php echo $data['id']; ?>'"><i class="fa fa-trash"></i></button></td>
                                    </tr>
                                <?php }  ?>
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