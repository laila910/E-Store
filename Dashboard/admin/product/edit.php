<?php 
    
   include '../helpers/functions.php';
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
       
      $productname =CleanInputs(Sanitize($_POST["productname"],2));  
      $productCat=CleanInputs(Sanitize($_POST["product_cat_id"],1));  
      $productBrand =CleanInputs(Sanitize($_POST["product_brand_id"],1));  
      $productStatus =CleanInputs(Sanitize($_POST["product_status"],2));
      $Featured=CleanInputs(Sanitize($_POST["featured"],2));  
       $id  = CleanInputs(Sanitize($_POST['id'],1));
      

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
    if(!Validator($Featured,2,4)){
      $errorMessages['featured']="featured  field must be  > 4";
   }
 //Validate product  Id 
  if(!Validator($id,1)){
      $errorMessages['productid']="id  field Required";
   }
      if(!Validator($id,3)){
          $errorMessages['productid'] = " id must be integer number ";
      }
   

     if(count($errorMessages) == 0){
       
      
         $sql="UPDATE `product` SET `productname`='$productname',`product_cat_id`='$productCat',`product_brand_id`='$productBrand',`product_status`='$productStatus',`featured`='$Featured' WHERE `id`=". $id;

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
   $sql  ="SELECT * FROM `product` WHERE `id`= $id";
   $op   = mysqli_query($conn,$sql);
   $FData = mysqli_fetch_assoc($op);

   //fetch categoreis
   $sql1 = "SELECT * FROM categoreis";
   $op1  = mysqli_query($conn,$sql1);

   //fetch Brands
   $sql2 = "SELECT * FROM brand";
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
                     <label for="exampleInputEmail1">Enter Product Name</label>
                     <input type="text" name="productname"  value="<?php echo $FData['productname']; ?>"class="form-control" id="exampleInputName" aria-describedby=""
                         placeholder="Enter product name ">
                 </div>

                 <div class="form-group">
                     <label for="exampleInputEmail1">Enter Product Status</label>
                     <input type="text" name="product_status"  value="<?php echo $FData['product_status']; ?>"class="form-control" id="exampleInputName" aria-describedby=""
                         placeholder="Enter Product Status">
                  </div>

                  <div class="form-group">
                     <label for="exampleInputEmail1">Enter Product Featured Or Not </label>
                     <input type="text" name="featured"  value="<?php echo $FData['featured']; ?>"class="form-control" id="exampleInputEmail1"
                         aria-describedby="emailHelp" placeholder="Enter featured or not ">
                 </div>

                     <div class="form-group">
                            <label for="exampleInput"> Product Category</label>
                            <select name="product_cat_id" class="form-control"> 
                                 <?php 
                                     while($data1 = mysqli_fetch_assoc($op1)){
                                  ?>
                              <option value="<?php echo $data1['id'];?>"    <?php if($data1['id'] == $FData['product_cat_id'] ){ echo 'selected';}?>    >
                              <?php echo $data1['categoryname'];?></option>
                                   <?php } ?>
                            </select>  
                      </div>
                        <div class="form-group">
                            <label for="exampleInput"> Product Brand</label>
                            <select name="product_brand_id" class="form-control"> 
                                 <?php 
                                     while($data2 = mysqli_fetch_assoc($op2)){
                                  ?>
                              <option value="<?php echo $data2['brand_Id'];?>"    <?php if($data2['brand_Id'] == $FData['product_brand_id'] ){ echo 'selected';}?>    >
                              <?php echo $data2['brandName'];?></option>
                                   <?php } ?>
                            </select>  
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