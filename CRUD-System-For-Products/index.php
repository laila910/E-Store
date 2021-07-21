<?php
session_start(); //to return the result of the deletion from delete.php

require "../dbconnection.php";
$sql = "SELECT * FROM product
LEFT JOIN productdetails ON product.details_id = productdetails.id
UNION
SELECT * FROM product
RIGHT JOIN productdetails ON product.details_id = productdetails.id;";

$op = mysqli_query($conn,$sql);



?>
<!DOCTYPE html>
<!--[if lt IE 7]>      <html class="no-js lt-ie9 lt-ie8 lt-ie7"> <![endif]-->
<!--[if IE 7]>         <html class="no-js lt-ie9 lt-ie8"> <![endif]-->
<!--[if IE 8]>         <html class="no-js lt-ie9"> <![endif]-->
<!--[if gt IE 8]>      <html class="no-js"> <![endif]-->
<html>
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <title></title>
        <meta name="description" content="">
        <meta name="viewport" content="width=device-width, initial-scale=1">
         <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" />

        <link rel="stylesheet" href="">
        <!-- custom css -->
    <style>
        .m-r-1em {
            margin-right: 1em;
        }
        
        .m-b-1em {
            margin-bottom: 1em;
        }
        
        .m-l-1em {
            margin-left: 1em;
        }
        
        .mt0 {
            margin-top: 0;
        }
    </style>
    </head>
    <body style="width:95%;margin-left:10px;margin-right:10px">
        <!--[if lt IE 7]>
            <p class="browsehappy">You are using an <strong>outdated</strong> browser. Please <a href="#">upgrade your browser</a> to improve your experience.</p>
        <![endif]-->
        <h1 style="text-align:center;margin-bottom:50px;margin-top:50px">Read Data in The Database </h1>
        <table class="table table-striped">
           <thead>
             <tr>
               <th scope="col">Product Id</th>
               <th scope="col">Details Id</th>
               <th scope="col">Product Name</th>
               <th scope="col">Category Id</th>
               <th scope="col">Brand Id </th>
               <th scope="col">Product Status </th>
               <th scope="col">Featured </th>
               <th scope="col">Product price </th>
               <th scope="col">Product Quantity </th>
               <th scope="col">Product Description </th>
               <th scope="col">Product Specifiction </th>
               <th scope="col">Review Id  </th>
               <th scope="col">Units In Stock  </th>
               <th scope="col">Discount  </th>
               <th scope="col">Product Availablity  </th>
               <th scope="col">Discount Availablity  </th>
               <th scope="col">Product Made Date   </th>
               <th scope="col">Action</th>

            </tr>
           </thead>
        <tbody>
            <?php
              while($data = mysqli_fetch_assoc($op)){
            ?>
         <tr>
             <td><?php echo $data['product_id'];?></td>
             <td><?php echo $data['details_id'];?></td>
             <td><?php echo $data['productname'];?></td>
             <td><?php echo $data['product_cat_id'];?></td>
             <td><?php echo $data['product_brand_id'];?></td>
             <td><?php echo $data['product_status'];?></td>
             <td><?php echo $data['featured'];?></td>
             <td><?php echo $data['productPrice'];?></td>
             <td><?php echo $data['productQuntity'];?></td>
             <td><?php echo $data['product_Description'];?></td>
             <td><?php echo $data['product_Specification'];?></td>
             <td><?php echo $data['Review_id'];?></td>
             <td><?php echo $data['unitsInStock'];?></td>
             <td><?php echo $data['Discount'];?></td>
             <td><?php echo $data['productAvailablity'];?></td>
             <td><?php echo $data['discountAvailablity'];?></td>
             <td><?php echo $data['productMadeDate'];?></td>
             <td>
                 <a class="btn btn-danger  m-r-1em  m-b-1em " href="delete.php?id=<?php echo $data['product_Id']; ?>" role="button">Delete</a>
                 <a class="btn btn-primary m-r-1em" href="edit.php?id=<?php echo $data['product_Id']; ?>" role="button">Edit</a>
             </td>
         </tr>
          <?php } ?>
         </tbody>
        </table>
        <?php 
        if(isset($_SESSION['message'])){
            echo $_SESSION['message'];

        }unset($_SESSION['message']); //after I recieved the message ,I need to end the session directly

       ?>
       
        <!-- jQuery (necessary for Bootstrap's JavaScript plugins) -->
    <script src="https://code.jquery.com/jquery-3.2.1.min.js"></script>

    <!-- Latest compiled and minified Bootstrap JavaScript -->
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
     <script src="" async defer></script>
    </body>
</html>