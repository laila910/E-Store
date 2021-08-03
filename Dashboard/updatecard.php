<?php 

 include './help/fun.php';
include './help/logincheck.php';
include './help/db.php';



        // DB Opretaion ... 
        $sql = "DELETE * FROM `addtocard` ";

        $op = mysqli_query($conn,$sql);

      

    
     header("Location: index.php");

 


?>
