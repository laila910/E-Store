<?php
include './help/db.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {

    $quantity = $_POST['quantity'];

    $id = $_POST['id'];

    $sql1 = " UPDATE `whishlist` SET `quantity`='$quantity' WHERE `id`=" . $id;
    $op1 = mysqli_query($conn, $sql1);

    // header("Location: wishlist.php");
}
