 <?php 
 
    require "../dbconnection.php";
  $errorMessages=array(); //associative array to carry the errors during check the validation 
  
function CleanInputs($input)
{ 
    $input=trim($input);
    $input=stripcslashes($input);
    $input=htmlspecialchars($input);
    return $input; 
}

 if($_SERVER['REQUEST_METHOD']=="POST"){
     
     $ProductName=CleanInputs($_POST["productname"]);  
     $CategoryId=CleanInputs($_POST["product_cat_id"]);  
     $BrandId =CleanInputs($_POST["product_brand_id"]);  
     $ProductStatus=CleanInputs($_POST["product_status"]);  
     $featured=CleanInputs($_POST["featured"]);  
     $ProductPrice=CleanInputs($_POST["productPrice"]);  
     $ProductQuantity=CleanInputs($_POST["productQuantity"]);  
     $ProductDescription=CleanInputs($_POST["product_Description"]);  
     $ProductSpecification=CleanInputs($_POST["product_Specification"]);  
     $ReviewId=CleanInputs($_POST["Review_id"]);  
     $UnitsInStock =CleanInputs($_POST["unitsInStock"]);  
     $Discount=CleanInputs($_POST["Discount"]);  
     $productAvailablity =CleanInputs($_POST["productAvailablity"]);  
     $discountAvailablity =CleanInputs($_POST["discountAvailablity"]);  
     $productMadeDate =CleanInputs($_POST["productMadeDate"]); 

     
       // Name Validation ...
        if(!empty($ProductName)){
           if(strlen($ProductName) < 3){
              $errorMessages['productName'] = "Product Name Length must be > 2 "; 
             }
        }else{
          $errorMessages['productName'] = " Product Name is Required!";
        }
     
 
    
     //print the result 
     
     if(count($errorMessages) == 0){
     
        $sql1 = "INSERT INTO product(productname,product_cat_id,product_brand_id,product_status,featured) VALUES ('$ProductName','$CategoryId','$BrandId','$ProductStatus','$featured');";
        $op1 = mysqli_query($conn,$sql1);
        if($op1){
              echo'Data Inserted In Product Table';
        }else{
            echo'ERROR In Insert the data In Product Table';
        }

        $sql2 = "INSERT INTO productdetails(productPrice,productQuantity,product_Description,product_Specification,Review_id,untsInStock,Discount,productAvailablity,discountAvailablity,productMadeDate) VALUES ('$ProductPrice','$ProductQuantity','$ProductDescription','$ProductSpecification','$ReviewId','$UnitsInStock','$Discount','$productAvailablity','$discountAvailablity','$productMadeDate');";
        $op2 = mysqli_query($conn,$sql2);
        if($op2){
              echo'Data Inserted In Productdetails Table';
        }else{
            echo'ERROR In Insert the data In Productdetails Table';
        }

      
     }else{

     // print error messages 
     foreach($errorMessages as $key => $value){

        echo '* '.$key.' : '.$value.'<br>';
     }


    }
}
        
    
                    
  ?>
 <!DOCTYPE html>
 <html lang="en">

     <head>
         <title>register </title>
         <meta charset="utf-8">
         <meta name="viewport" content="width=device-width, initial-scale=1">
         <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">
         <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
         <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>
     </head>

     <body>

         <div class="container">
             
             <form method="post" action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']);?>"
                 enctype="multipart/form-data">

               <div class="form-group">
                     <label for="exampleInputEmail1">Enter The Product Name</label>
                     <input type="text" name="productname"  value="<?php echo $data['productname']; ?>"class="form-control" id="exampleInputName" aria-describedby=""
                         placeholder="Enter The product name ">
                 </div>


                 <div class="form-group">
                     <label for="exampleInputEmail1">Enter Product Category Id </label>
                     <input type="text" name="product_cat_id"  value="<?php echo $data['product_cat_id']; ?>" class="form-control" id="exampleInputEmail1"
                         placeholder="Enter your category Id">
                 </div>

                 
                 
                 <div class="form-group">
                     <label for="exampleInputEmail1">Enter Product Brand Id </label>
                     <input type="text" name="product_brand_id"   value="<?php echo $data['product_brand_id'];?> " id=" exampleInputName" aria-describedby="">
                 </div>
                 <div class="form-group">
                     <label for="exampleInputEmail1">Enter product status  </label>
                     <input type="text" name="product_status"   value="<?php echo $data['product_status'];?> " id=" exampleInputName" aria-describedby="">
                 </div>
                 <div class="form-group">
                     <label for="exampleInputEmail1">Enter featured product or not  </label>
                     <input type="text" name="featured"   value="<?php echo $data['featured'];?> " id=" exampleInputName" aria-describedby="">
                 </div>
                 <div class="form-group">
                     <label for="exampleInputEmail1">Enter Product Price </label>
                     <input type="text" name="productPrice"   value="<?php echo $data['productPrice'];?> " id=" exampleInputName" aria-describedby="">
                 </div>
                 <div class="form-group">
                     <label for="exampleInputEmail1">Enter Product Quantity</label>
                     <input type="text" name="productQuntity"   value="<?php echo $data['productQuntity'];?> " id=" exampleInputName" aria-describedby="">
                 </div>
                 <div class="form-group">
                     <label for="exampleInputEmail1">Enter Product Description</label>
                     <input type="text" name="product_Description"   value="<?php echo $data['product_Description'];?> " id=" exampleInputName" aria-describedby="">
                 </div>
                 <div class="form-group">
                     <label for="exampleInputEmail1">Enter Product Specification </label>
                     <input type="text" name="product_Specification"   value="<?php echo $data['product_Specification'];?> " id=" exampleInputName" aria-describedby="">
                 </div>
                 <div class="form-group">
                     <label for="exampleInputEmail1">Enter Product Units Of Stock</label>
                     <input type="text" name="unitsInStock"   value="<?php echo $data['unitsInStock'];?> " id=" exampleInputName" aria-describedby="">
                 </div>
                 <div class="form-group">
                     <label for="exampleInputEmail1">Enter Product Discount</label>
                     <input type="text" name="Discount"   value="<?php echo $data['Discount'];?> " id=" exampleInputName" aria-describedby="">
                 </div>
                 <div class="form-group">
                     <label for="exampleInputEmail1">Enter Product Availablity</label>
                     <input type="text" name="productAvailablity"   value="<?php echo $data['productAvailablity'];?> " id=" exampleInputName" aria-describedby="">
                 </div>
                 <div class="form-group">
                     <label for="exampleInputEmail1">Enter Discount Availablity</label>
                     <input type="text" name="discountAvailablity"   value="<?php echo $data['discountAvailablity'];?> " id=" exampleInputName" aria-describedby="">
                 </div>
                 <div class="form-group">
                     <label for="exampleInputEmail1">Enter Product Made Date</label>
                     <input type="text" name="productMadeDate"   value="<?php echo $data['productMadeDate'];?> " id=" exampleInputName" aria-describedby="">
                 </div>

                 <button type="submit" class="btn btn-primary">create Product</button>
             </form>
         </div>

     </body>

 </html>