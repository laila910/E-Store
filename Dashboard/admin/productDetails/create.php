<?php
include '../helpers/functions.php';
include '../helpers/checkLogin.php';
include '../helpers/checkPrem.php';
include '../helpers/dbconnection.php';

include '../header.php';
//fetch product
  $sql2 = "SELECT * FROM product";
  $op2  = mysqli_query($conn,$sql2);
//fetch reviews table
  $sql3 = "SELECT * FROM productreview";
  $op3  = mysqli_query($conn,$sql3);
// fetch product color
$sql5= "SELECT * FROM productcolor";
  $op5 = mysqli_query($conn,$sql5);
//fetch product sizes
$sql6= "SELECT * FROM productsizes";
  $op6 = mysqli_query($conn,$sql6);

if($_SERVER['REQUEST_METHOD']=='POST'){

      $productId=CleanInputs(Sanitize($_POST["product_Id"],1));  
      $productcolor=CleanInputs(Sanitize($_POST["color_id"],1));  
      $productsize=CleanInputs(Sanitize($_POST["size_id"],1));  
      $productPrice=CleanInputs(Sanitize($_POST["productPrice"],1));  
      $productQuntity=CleanInputs(Sanitize($_POST["productQuntity"],1));  
      $product_Description =CleanInputs(Sanitize($_POST["product_Description"],2));  
      $product_Specificaton=CleanInputs(Sanitize($_POST["product_Specificaton"],2));  
  
      $unitsInStock =CleanInputs(Sanitize($_POST["unitsInStock"],1));  
      $Discount =CleanInputs(Sanitize($_POST["Discount"],1));  
      $productAvailablity =CleanInputs(Sanitize($_POST["productAvailablity"],2));
      $discountAvailablity=CleanInputs(Sanitize($_POST["discountAvailablity"],2));  
    

  $errorMessages=array();
  //validate Product Description
   if(!Validator($product_Description,1)){
      $errorMessages['productDescription']="product Description field Required";
   }
    
  if(!Validator($product_Description,2,4)){
    $errorMessages['productDescriptionLength'] = "product Name length must be > 4 ";

  }
//validate Product specification
   if(!Validator($product_Specificaton,1)){
      $errorMessages['productSpecification']="product Specification field Required";
   }
    
  if(!Validator($product_Specificaton,2,10)){
    $errorMessages['productSpecificationLength'] = "product specification length must be > 10 ";

  }
  //validate Product Availability
   if(!Validator($productAvailablity,1)){
      $errorMessages['productAvailabilty']="product Availabilty field Required";
   }
    
  if(!Validator($productAvailablity,2,1)){
    $errorMessages['productSpecificationLength'] = "product specification length must be > 1 ";

  }
  //validate discount Availability
   if(!Validator($discountAvailablity,1)){
      $errorMessages['discountAvailabilty']="discount Availabilty field Required";
   }
    
  if(!Validator($discountAvailablity,2,1)){
    $errorMessages['discontavailabiltyLength'] = "discount availabilty length must be > 1 ";

  }
  //Validate product  Id 
   if(!Validator($productId,1)){
      $errorMessages['productId']="product Id  field Required";
   }
   if(!Validator($productId,3)){
      $errorMessages['productId']="product  Id  must be Integer Number";
   }
 //Validate product Price
   if(!Validator($productPrice,1)){
      $errorMessages['productPrice']="product Price  field Required";
   }
   if(!Validator($productPrice,3)){
      $errorMessages['productPrice']="product Price   must be Integer Number";
   }
//Validate product quantity
   if(!Validator($productQuntity,1)){
      $errorMessages['productQuantity']="product Quantity  field Required";
   }
   if(!Validator($productQuntity,3)){
      $errorMessages['productQuantity']="product Quantity   must be Integer Number";
   }

//Validate units Of Stock
   if(!Validator($unitsInStock,1)){
      $errorMessages['unitsofstock']="units of stock  field Required";
   }
   if(!Validator($unitsInStock,3)){
      $errorMessages['unitsofstock']="units of stock   must be Integer Number";
   }
//Validate Discount
   if(!Validator($Discount,1)){
      $errorMessages['Discount']="Discount  field Required";
   }
   if(!Validator($Discount,3)){
      $errorMessages['Discount']="Discount   must be Integer Number";
   }
//Validate color Id
   if(!Validator($productcolor,1)){
      $errorMessages['productcolorId']="Product Color Id  field Required";
   }
   if(!Validator($productcolor,3)){
      $errorMessages['productcolorId']="Product Color Id   must be Integer Number";
   }
//Validate size Id
   if(!Validator($productsize,1)){
      $errorMessages['productsizeId']="Product Size Id  field Required";
   }
   if(!Validator($productsize,3)){
      $errorMessages['productsizeId']="Product Size Id   must be Integer Number";
   }

 if(count($errorMessages) > 0){
    $_SESSION['errors']=$errorMessages;

 }else{
       $sql4 =  "INSERT INTO `productdetails`( `product_Id`,`color_id`,`size_id`, `productPrice`, `productQuntity`, `product_Description`, `product_Specificaton`, `unitsInStock`, `Discount`, `productAvailablity`, `discountAvailablity`) VALUES ('$productId','$productcolor','$productsize','$productPrice','$productQuntity','$product_Description','$product_Specificaton','$unitsInStock','$Discount','$productAvailablity','$discountAvailablity')";


      $op4 = mysqli_query($conn,$sql4);
     
     
    if($op4){

        $errorMessages['Result'] = "Data inserted.";
    }else{
        $errorMessages['Result']  = "Error Try Again.";
     
       

     }
   
      
    

     $_SESSION['errors']=$errorMessages;
     header('Location: index.php');

     }


    


}








?>

<body class="sb-nav-fixed">
   <?php

include '../nav.php';
?>
    <div id="layoutSidenav">
<?php

include '../sidNave.php';
?>
        <div id="layoutSidenav_content">
            <main>
                <div class="container-fluid">
                    <h1 class="mt-4">Dashboard</h1>
                    <ol class="breadcrumb mb-4">
                       
                            <?php
                               if(isset($_SESSION['errors'])){
                                    foreach($_SESSION['errors'] as $key => $value){
                                             echo '* '.$key.' : '.$value.'<br>';
                                            
                                       }  unset($_SESSION['errors']);
                                     }else{
                                     
                            ?>
                       <li class="breadcrumb-item active"> Add Product Details</li>
                                    <?php  }?>
                    </ol>
                <div class="container">
           
                      <form method="post" action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']);?>"
                 enctype="multipart/form-data">

                   <div class="form-group">
                         <label for="exampleInput"> Product Name </label>
                          <select name="product_Id" class="form-control"> 
                                 <?php 
                                    while($data2 = mysqli_fetch_assoc($op2)){
                                 ?>
                           <option value="<?php echo $data2['id'];?>"><?php echo $data2['productname'];?></option>
                              <?php } ?>
                        </select>  
                    </div>
                   <div class="form-group">
                         <label for="exampleInput"> Product Sizes</label>
                          <select name="size_id" class="form-control"> 
                                 <?php 
                                    while($data6 = mysqli_fetch_assoc($op6)){
                                 ?>
                           <option value="<?php echo $data6['id_size'];?>"><?php echo $data6['S'].','.$data6['M'].','.$data6['L'].','.$data6['XL'];?></option>
                              <?php } ?>
                        </select>  
                    </div>
                   <div class="form-group">
                         <label for="exampleInput"> Product Colors</label>
                          <select name="color_id" class="form-control"> 
                                 <?php 
                                    while($data5 = mysqli_fetch_assoc($op5)){
                                 ?>
                           <option value="<?php echo $data5['id'];?>"><?php echo $data5['firstcolor'].','.$data5['secondcolor'].','.$data5['thirdcolor'];?></option>
                              <?php } ?>
                        </select>  
                    </div>

                  <div class="form-group">
                     <label for="exampleInputEmail1">Enter Product Price</label>
                     <input type="text" name="productPrice" class="form-control" id="exampleInputName" aria-describedby=""
                         placeholder="Enter product price ">
                 </div>

                 <div class="form-group">
                     <label for="exampleInputEmail1">Enter Product Quantity</label>
                     <input type="text" name="productQuntity" class="form-control" id="exampleInputName" aria-describedby=""
                         placeholder="Enter product Quantity">
                  </div>

                  <div class="form-group">
                     <label for="exampleInputEmail1">Enter Product Description</label>
                     <input type="text" name="product_Description" class="form-control" id="exampleInputName" aria-describedby=""
                         placeholder="Enter product Description">
                  </div>

                  <div class="form-group">
                     <label for="exampleInputEmail1">Enter Product Specification</label>
                     <input type="text" name="product_Specificaton" class="form-control" id="exampleInputName" aria-describedby=""
                         placeholder="Enter product Specificaton">
                  </div>
                  
                 
                 <div class="form-group">
                     <label for="exampleInputEmail1">Enter unitsInStock </label>
                     <input type="text" name="unitsInStock" class="form-control" id="exampleInputName" aria-describedby=""
                         placeholder="Enter unitsInStock">
                  </div>
                  
                  <div class="form-group">
                     <label for="exampleInputEmail1">Enter Discount Amount </label>
                     <input type="text" name="Discount" class="form-control" id="exampleInputName" aria-describedby=""
                         placeholder="Enter Discount">
                  </div>

                   <div class="form-group">
                     <label for="exampleInputEmail1">Enter product Availablity </label>
                     <input type="text" name="productAvailablity" class="form-control" id="exampleInputName" aria-describedby=""
                         placeholder="Enter productAvailablity">
                    </div>

                    <div class="form-group">
                     <label for="exampleInputEmail1">Enter discount Availablity </label>
                     <input type="text" name="discountAvailablity" class="form-control" id="exampleInputName" aria-describedby=""
                         placeholder="Enter discountAvailablity">
                    </div>

                 <button type="submit" class="btn btn-primary">Add Product</button>
               </form>
                </div>

                </div>
            </main>
 <?php
include '../footer.php';
 ?>