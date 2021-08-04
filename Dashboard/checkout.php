<?php

include './help/fun.php';

include './help/logincheck.php';
include './help/db.php';
include './header.php';

include './navbar.php';
if (isset($_GET['id'])) {
    $id = Sanitized($_GET['id'], 1);
    $session = $_GET['session'];
}


?>


<!-- Checkout Start -->
<div class="checkout">
    <div class="container-fluid">
        <div class="row">

            <div class="col-lg-8">

                <div class="checkout-inner">
                    <div class="checkout-summary">
                        <h1>Cart details</h1>
                        <?php

                        $sql = "SELECT `addtocard`.*, `product`.`productname`,`productdetails`.`productPrice`FROM `productdetails` join `product`on `productdetails`.`product_Id`=`product`.`id` join `addtocard` on `addtocard`.`carditem`=`productdetails`.`id` WHERE `addtocard`.`id`='$id'";
                        $op = mysqli_query($conn, $sql);

                        $i = 0;

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
                                <?php while ($data = mysqli_fetch_assoc($op)) { ?>
                                    <tr>
                                        <th scope="row"><?php echo $data['productname']; ?></th>
                                        <td><?php static $totalp = 0;
                                            $totalp += $data['productPrice'];
                                            echo $data['productPrice'] . 'EGP'; ?></td>
                                        <td><?php echo $data['quantity']; ?></td>
                                        <td><?php echo $data['productPrice'] * $data['quantity'] . 'EGP'; ?></td>
                                    </tr>
                                <?php  } ?>
                            </tbody>
                        </table>

                        <p class="sub-total">sub total <span>
                                <?php echo $totalp; ?></span></p>
                        <p class="ship-cost">Shipping Cost<span>EGP 70</span></p>
                        <h2>Grand Total<span>EGP <?php echo $totalp + 70; ?>
                            </span></h2>

                    </div>

                    <div class="checkout-payment">
                        <div class="payment-methods">

                            <div class="checkout-btn">
                                <?php
                                $sql5 = "SELECT * FROM `addtocard`  ORDER BY `addtocard`.`id` desc LIMIT 1 ";
                                $op5 = mysqli_query($conn, $sql5);
                                $data5 = mysqli_fetch_assoc($op5);

                                $Id = $data5['id'];
                                $cardItem = $data5['carditem'];
                                ?>

                                <form action="orderDone.php?cardId=<?php echo $Id; ?>&cardItem=<?php echo $cardItem; ?>&totalprice=<?php echo $totalp; ?>" method="Post">

                                    <button>Place Order</button>
                                </form>
                            </div>

                        </div>
                    </div>

                </div>

            </div>
        </div>
    </div>

    <!-- Checkout End -->

    <?php include 'footer.php'; ?>