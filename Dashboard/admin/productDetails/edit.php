<?php 
    
  include '../helpers/functions.php';
include '../helpers/checkLogin.php';
include '../helpers/checkPrem.php';
include '../helpers/dbconnection.php';



   $id = '';
   if($_SERVER['REQUEST_METHOD'] == "GET"){

    // LOGIC .... 
      $errorMessages = [];
      $id  = Sanitize($_GET['id'],1);
     
       if(!Validator($id,3)){
 
        $errorMessages['id'] = "Invalid ID";
        
        $_SESSION['errors'] = $errorMessages;
       header("Location: index.php");
       }

    }

   if($_SERVER['REQUEST_METHOD'] == "POST"){
       
      $productId=CleanInputs(Sanitize($_POST["product_Id"],1));  
      $productPrice=CleanInputs(Sanitize($_POST["productPrice"],1));  
      $productQuntity=CleanInputs(Sanitize($_POST["productQuntity"],1));  
      $product_Description =CleanInputs(Sanitize($_POST["product_Description"],2));  
      $product_Specificaton=CleanInputs(Sanitize($_POST["product_Specificaton"],2));  
    
      $unitsInStock =CleanInputs(Sanitize($_POST["unitsInStock"],1));  
      $Discount =CleanInputs(Sanitize($_POST["Discount"],1));  
      $productAvailablity =CleanInputs(Sanitize($_POST["productAvailablity"],2));
      $discountAvailablity=CleanInputs(Sanitize($_POST["discountAvailablity"],2));  
        $id  = CleanInputs(Sanitize($_POST['id'],1));
      $productMadeDate=CleanInputs($_POST["productMadeDate"]);
    

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
 //Validate product  Id 
  if(!Validator($id,1)){
      $errorMessages['productid']="id  field Required";
   }
      if(!Validator($id,3)){
          $errorMessages['productid'] = " id must be integer number ";
      }
     

     if(count($errorMessages) == 0){
       
      
         $sql="UPDATE `productdetails` SET `product_Id`='$productId',`productPrice`='$productPrice',`productQuntity`='$productQuntity',`product_Description`='$product_Description',`product_Specificaton`='$product_Specificaton',`unitsInStock`='$unitsInStock',`Discount`='$Discount',`productAvailablity`='$productAvailablity',`discountAvailablity`='$discountAvailablity',`productMadeDate`='$productMadeDate' WHERE id=". $id;

         $op = mysqli_query($conn,$sql);
        //  echo mysqli_error($conn);
        //  exit();

       if($op){

            $errorMessages['Result'] = "Data updated.";
       
       }else{
            $errorMessages['Result']  = "Error Try Again.";
     
         }
        $_SESSION['errors'] = $errorMessages;
       
        header('Location: index.php');

     }else{

       $_SESSION['errors'] = $errorMessages;
   }

  }

   # Fetch product
   $sql  ="SELECT * FROM `productdetails` WHERE `id`= $id";
   $op   = mysqli_query($conn,$sql);
   $FData = mysqli_fetch_assoc($op);

   //fetch product
   $sql1 = "SELECT * FROM product";
   $op1  = mysqli_query($conn,$sql1);

   //fetch reviews
   $sql2 = "SELECT * FROM productreview";
   $op2 = mysqli_query($conn,$sql2);

    include '../header.php';
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

                               foreach($_SESSION['errors'] as $key =>  $value){

                                echo '* '.$key.' : '.$value.'<br>';
                               }

                             unset($_SESSION['errors']);
                             }else{
                        ?>
                        
                        <li class="breadcrumb-item active">Add product </li>
                        <?php } ?>
                        
                        
                        
                        </ol>

                      

<div class="container">

 <form  method="post"  action="edit.php?id=<?php echo $FData['id'];?>"  enctype ="multipart/form-data">
  
                <div class="form-group">
                            <label for="exampleInput"> Product Name</label>
                            <select name="product_Id" class="form-control"> 
                                 <?php 
                                     while($data1 = mysqli_fetch_assoc($op1)){
                                  ?>
                              <option value="<?php echo $data1['id'];?>"    <?php if($data1['id'] == $FData['product_Id'] ){ echo 'selected';}?>    >
                              <?php echo $data1['productname'];?></option>
                                   <?php } ?>
                            </select>  
                 </div>

                <div class="form-group">
                     <label for="exampleInputEmail1">Enter Product Price</label>
                     <input type="text" name="productPrice"   value="<?php echo $FData['productPrice']; ?>"class="form-control" id="exampleInputName" aria-describedby=""
                         placeholder="Enter product price ">
                 </div>

                 <div class="form-group">
                     <label for="exampleInputEmail1">Enter Product Quantity</label>
                     <input type="text" name="productQuntity"   value="<?php echo $FData['productQuntity']; ?>"class="form-control" id="exampleInputName" aria-describedby=""
                         placeholder="Enter product Quantity">
                  </div>

                  <div class="form-group">
                     <label for="exampleInputEmail1">Enter Product Description</label>
                     <input type="text" name="product_Description"   value="<?php echo $FData['product_Description']; ?>"class="form-control" id="exampleInputName" aria-describedby=""
                         placeholder="Enter product Description">
                  </div>

                  <div class="form-group">
                     <label for="exampleInputEmail1">Enter Product Specification</label>
                     <input type="text" name="product_Specificaton"  value="<?php echo $FData['product_Specificaton']; ?>" class="form-control" id="exampleInputName" aria-describedby=""
                         placeholder="Enter product Specificaton">
                  </div>
                  
                 

                  <div class="form-group">
                     <label for="exampleInputEmail1">Enter unitsInStock </label>
                     <input type="text" name="unitsInStock" value="<?php echo $FData['unitsInStock']; ?>"  class="form-control" id="exampleInputName" aria-describedby=""
                         placeholder="Enter unitsInStock">
                  </div>
                  
                  <div class="form-group">
                     <label for="exampleInputEmail1">Enter Discount Amount </label>
                     <input type="text" name="Discount" value="<?php echo $FData['Discount']; ?>" class="form-control" id="exampleInputName" aria-describedby=""
                         placeholder="Enter Discount">
                  </div>

                   <div class="form-group">
                     <label for="exampleInputEmail1">Enter product Availablity </label>
                     <input type="text" name="productAvailablity" value="<?php echo $FData['productAvailablity']; ?>" class="form-control" id="exampleInputName" aria-describedby=""
                         placeholder="Enter productAvailablity">
                    </div>

                    <div class="form-group">
                     <label for="exampleInputEmail1">Enter discount Availablity </label>
                     <input type="text" name="discountAvailablity" value="<?php echo $FData['discountAvailablity']; ?>" class="form-control" id="exampleInputName" aria-describedby=""
                         placeholder="Enter discountAvailablity">
                    </div>
 
                      <input type="hidden" name="id" value="<?php echo $FData['id'];?>">

                
  
                     <button type="submit"  name="submit"class="btn btn-primary">Submit</button>
</form>
</div>

              </div>
              </main>   
 <?php
include '../footer.php';
 ?>