<?php


include './help/fun.php';

include './help/logincheck.php';
include './help/db.php';
include './header.php';

include './navbar.php';




if (isset($_GET['id'])) {

    $id  = Sanitized($_GET['id'], 1);
    $quantity =  Sanitized($_GET['quantity'], 1);


    $carditem = $id;
    $quan = $quantity;
    $customerid = $_SESSION['users']['id'];


    $sql2 =  "INSERT INTO `addtocard`( `customerId`, `carditem`,`quantity`) VALUES ('$customerid','$carditem','$quan')";
    $op2 = mysqli_query($conn, $sql2);
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
                                $customerid = $_SESSION['users']['id'];
                                $sql = "SELECT `addtocard`.*,`productdetails`.`productPrice`,`productdetails`.`id` as `prodetId`,`product`.`productname` ,`productimges`.`firstimage` FROM `addtocard` join `productdetails` on `addtocard`.`carditem`=`productdetails`.`id` join `product` on `productdetails`.`product_Id` = `product`.`id` join `productimges` on `productdetails`.`id`=`productimges`.`product_id` WHERE `addtocard`.`customerId`='$customerid' ORDER BY `addtocard`.`id` desc";
                                $op  = mysqli_query($conn, $sql);
                                $rows = mysqli_num_rows($op);
                                $subtotal = 0;
                                $grandTotal = 0;
                                while ($data = mysqli_fetch_assoc($op)) {

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
                                                <input type="text" value="<?php echo $data['quantity']; ?> ">
                                                <a href=""><button class="btn-plus"><i class="fa fa-plus"></i></button></a>
                                            </div>
                                        </td>
                                        <td><?php $total = $data['productPrice'] * $data['quantity'];
                                            static $subtotal = 0;
                                            $subtotal += $total;
                                            echo $total . ' ' . 'EGP'; ?></td>


                                        <td><a href="deletec.php?Id=<?php echo $data['id']; ?>"><button><i class="fa fa-trash"></i></button></a></td>
                                    </tr>

                                <?php }

                                ?>
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
                                    <p>Sub Total<span><?php if ($rows < 0) {
                                                            $subtotal = Null;
                                                            echo 'EGP';
                                                        } else {
                                                            echo $subtotal . ' ' . 'EGP';
                                                        }
                                                        ?></span></p>
                                    <p>Shipping Cost<span><?php echo '70 EGP'; ?> </span></p>
                                    <h2>Grand Total<span><?php


                                                            $grandTotal = $subtotal + 70;
                                                            echo $grandTotal;
                                                            ?> </span></h2>
                                </div>
                                <div class="cart-btn">
                                    <?php $sql3 = "SELECT * FROM `addtocard` ORDER BY `addtocard`.`id` desc LIMIT 1";
                                    $op3 = mysqli_query($conn, $sql3);
                                    $data3 = mysqli_fetch_assoc($op3);

                                    $id = $data3['id'];

                                    ?>
                                    <a class="btn btn-primary btn-lg" href="updatecard.php" role="button">Update Card</a>

                                    <!-- <a class="btn btn-primary btn-lg" href="" role="button">CheckOut</a> -->
                                    <button class="btn" type="Submit" name="submitcheck" onclick="window.location.href='checkout.php?session=<?php echo 'true'; ?>&id=<?php echo $data3['id']; ?>'"> Checkout</button>


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

<?php include 'footer.php';
?>