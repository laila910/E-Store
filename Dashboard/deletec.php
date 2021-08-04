<?php

include './help/fun.php';

include './help/logincheck.php';
include './help/db.php';




if (isset($_GET['Id'])) {


    // LOGIC .... 
    $errorMessages = [];
    $id  = Sanitized($_GET['Id'], 1);

    if (!Validate($id, 3)) {

        $errorMessages['id'] = "Invalid ID";
    } else {

        // DB Opretaion ... 
        $sql = "DELETE  FROM `addtocard` where `id` =" . $id;

        $op = mysqli_query($conn, $sql);
        echo mysqli_error($conn);
        exit();

        if ($op) {
            $errorMessages['Result'] = "deleted done";
        } else {

            $errorMessages['Result'] = "error in delete operation";
        }
    }

    $_SESSION['errors'] =  $errorMessages;

    header("Location: index.php");
}
