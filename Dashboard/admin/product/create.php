<?php
include '../helpers/functions.php';
include '../helpers/checkLogin.php';
include '../helpers/checkPrem.php';
include '../helpers/dbconnection.php';
include '../header.php';



//fetch categoreis
  $sql2 = "SELECT * FROM categoreis";
  $op2  = mysqli_query($conn,$sql2);
//fetch brands
  $sql3 = "SELECT * FROM brand";
  $op3  = mysqli_query($conn,$sql3);

if($_SERVER['REQUEST_METHOD']=='POST'){

   
      $productname =CleanInputs(Sanitize($_POST["productname"],2));  
      $productCat=CleanInputs(Sanitize($_POST["product_cat_id"],1));  
      $productBrand =CleanInputs(Sanitize($_POST["product_brand_id"],1));  
      $productStatus =CleanInputs(Sanitize($_POST["product_status"],2));
      $Featured=CleanInputs(Sanitize($_POST["featured"],2));  
    

  $errorMessages=array();
  //validate Product Name
   if(!Validator($productname,1)){
      $errorMessages['productname']="product Name field Required";
   }
    
  if(!Validator($productname,2,4)){
    $errorMessages['productnameLength'] = "product Name length must be > 4 ";

  }
  //validate Product Status
    if(!Validator($productStatus,1)){
      $errorMessages['productstatus']="product status field Required";
   }
    
  if(!Validator($productStatus,2,0)){
    $errorMessages['productstatusLength'] = "product status length must be > 0";

  }

  


  //Validate product Category Id 
   if(!Validator($productCat,1)){
      $errorMessages['productCatId']="product Category Id  field Required";
   }
   if(!Validator($productCat,3)){
      $errorMessages['productCatId']="product Category Id  must be Integer Number";
   }
 //Validate product Brand Id 
   if(!Validator($productBrand,1)){
      $errorMessages['productBrandId']="product Brand Id  field Required";
   }
   if(!Validator($productBrand,3)){
      $errorMessages['productBrandId']="product Brand Id  must be Integer Number";
   }
//validate featured
   if(!Validator($Featured,1)){
      $errorMessages['featured']="featured  field Required";
   }
    if(!Validator($Featured,2,2)){
      $errorMessages['featured']="featured  field must be  > 2";
   }
  
 if(count($errorMessages) > 0){
    $_SESSION['errors']=$errorMessages;

 }else{
       $sql4 =  "INSERT INTO `product`( `productname`, `product_cat_id`, `product_brand_id`, `product_status`, `featured`) VALUES ('$productname','$productCat','$productBrand','$productStatus','$Featured')";


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
                       <li class="breadcrumb-item active"> Add New Product</li>
                                    <?php  }?>
                    </ol>
                <div class="container">
           
                      <form method="post" action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']);?>"
                 enctype="multipart/form-data">

                  <div class="form-group">
                     <label for="exampleInputEmail1">Enter Product Name</label>
                     <input type="text" name="productname" class="form-control" id="exampleInputName" aria-describedby=""
                         placeholder="Enter product name ">
                 </div>

                 <div class="form-group">
                     <label for="exampleInputEmail1">Enter Product Status</label>
                     <input type="text" name="product_status" class="form-control" id="exampleInputName" aria-describedby=""
                         placeholder="Enter product status ">
                  </div>

                     <div class="form-group">
                         <label for="exampleInput"> Product Category </label>
                          <select name="product_cat_id" class="form-control"> 
                                 <?php 
                                    while($data = mysqli_fetch_assoc($op2)){
                                 ?>
                           <option value="<?php echo $data['id'];?>"><?php echo $data['categoryname'];?></option>
                              <?php } ?>
                        </select>  
                    </div>

                    <div class="form-group">
                         <label for="exampleInput"> Product Brand </label>
                          <select name="product_brand_id" class="form-control"> 
                                 <?php 
                                    while($data = mysqli_fetch_assoc($op3)){
                                 ?>
                           <option value="<?php echo $data['brand_Id'];?>"><?php echo $data['brandName'];?></option>
                              <?php } ?>
                        </select>  
                    </div>
                 <div class="form-group">
                     <label for="exampleInputEmail1">Enter Product Featured Or Not </label>
                     <input type="text" name="featured" class="form-control" id="exampleInputName" aria-describedby=""
                         placeholder="Enter product featured ">
                  </div>

                 <button type="submit" class="btn btn-primary">Create Product</button>
               </form>
                </div>

                </div>
            </main>
 <?php
include '../footer.php';
 ?>