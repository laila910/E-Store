<?php
include '../helpers/functions.php';
include '../helpers/checkLogin.php';
include '../helpers/checkPrem.php';
include '../helpers/dbconnection.php';
include '../header.php';



$sql1 = "SELECT `product`.`productname`,`product`.`id` as `productid`,`productdetails`.* from `productdetails` join `product` on `productdetails`.`product_Id` = `product`.`id`";

  $op1  = mysqli_query($conn,$sql1);

if($_SERVER['REQUEST_METHOD']=='POST'){

     
        $productId = CleanInputs(Sanitize($_POST["product_id"],1)); 
         $firstimageName     = $_FILES['firstimage']['name'];
         $secondimageName     = $_FILES['secondimage']['name'];
         $thirdimageName     = $_FILES['thirdimage']['name'];
         
     
    

  $errorMessages=array();
  
 //Validate product  Id 
   if(!Validator($productId,1)){
      $errorMessages['productId']="product  Id  field Required";
   }
   if(!Validator($productId,3)){
      $errorMessages['productId']="product Id  must be Integer Number";
   }
//Validate firstimage
  $nameArray = explode('.',$firstimageName);
  $FileExtensionimage1 = strtolower($nameArray[1]);
   
     if(!Validator($firstimageName,1)){
      
      $errorMessages['firstimage'] = "first image Field Required";

    }


    if(!Validator($FileExtensionimage1,5)){
      
      $errorMessages['Extensionimage1'] = "Invalid Image1 Extension";

    }
//validate second image

  $nameArray = explode('.',$secondimageName);
  $FileExtensionimage2 = strtolower($nameArray[1]);
   
     if(!Validator($secondimageName,1)){
      
      $errorMessages['secondimage'] = "second image Field Required";

    }


    if(!Validator($FileExtensionimage2,5)){
      
      $errorMessages['Extensionimage2'] = "Invalid Image2 Extension";

    }
//Validate third image
  $nameArray = explode('.',$thirdimageName);
  $FileExtensionimage3 = strtolower($nameArray[1]);
   
     if(!Validator($thirdimageName,1)){
      
      $errorMessages['thirdimage'] = "third image Field Required";

    }


    if(!Validator($FileExtensionimage3,5)){
      
      $errorMessages['Extensionimage3'] = "Invalid Image3 Extension";

    }

//end of validations

 if(count($errorMessages) > 0){
    $_SESSION['errors']=$errorMessages;

 }else{

     //add image1 to include folder
     $tmp_path1= $_FILES['firstimage']['tmp_name'];
       $FinalNameimage1 = rand().time().'.'.$FileExtensionimage1;
 
       $disFolder = './uploads/';
         
       $disPath1 = $disFolder.$FinalNameimage1;


     //add image2 to include folder
      $tmp_path2= $_FILES['secondimage']['tmp_name'];
       $FinalNameimage2 = rand().time().'.'.$FileExtensionimage2;
 
       $disFolder = './uploads/';
         
       $disPath2 = $disFolder.$FinalNameimage2;


    //add image3 to include folder
      $tmp_path3= $_FILES['thirdimage']['tmp_name'];
       $FinalNameimage3 = rand().time().'.'.$FileExtensionimage3;
 
       $disFolder = './uploads/';
         
       $disPath2 = $disFolder.$FinalNameimage3;
 
 
 
     if(move_uploaded_file($tmp_path1,$disPath1) && move_uploaded_file($tmp_path2,$disPath2) && move_uploaded_file($tmp_path3,$disPath3) )
       {
    
       $sql =  "INSERT INTO `productimges`(`product_id`, `firstimage`, `secondimage`, `thirdimage`) VALUES ('$productId ','$firstimageName','$secondimageName','$thirdimageName')";


      $op = mysqli_query($conn,$sql);
     
//      echo mysqli_error($conn);
// exit();
    if($op){

        $errorMessages['Result'] = "Data inserted.";
    }else{
        $errorMessages['Result']  = "Error Try Again.";
     
       

     }
    }else{
      
               $errorMessages['Result'] = "Error In Uploading";
           
 
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
                       <li class="breadcrumb-item active"> Add  Product Images</li>
                                    <?php  }?>
                    </ol>
                <div class="container">
           
                      <form method="post" action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']);?>"
                 enctype="multipart/form-data">

                  <div class="form-group">
                         <label for="exampleInput"> Product Name </label>
                          <select name="product_id" class="form-control"> 
                                 <?php 
                                    while($data = mysqli_fetch_assoc($op1)){
                                 ?>
                           <option value="<?php echo $data['id'];?>"><?php echo $data['productname'];?></option>
                              <?php } ?>
                        </select>  
                    </div>


                  <div class="form-group">
                     <label for="exampleInputEmail1">Enter First Image</label>
                     <input type="file" name="firstimage" class="form-control" id="exampleInputName" aria-describedby=""
                         placeholder="Enter First image ">
                 </div>

                 <div class="form-group">
                     <label for="exampleInputEmail1">Enter Second image</label>
                     <input type="file" name="secondimage" class="form-control" id="exampleInputName" aria-describedby=""
                         placeholder="Enter Second image">
                  </div>

                  <div class="form-group">
                     <label for="exampleInputEmail1">Enter Third image</label>
                     <input type="file" name="thirdimage" class="form-control" id="exampleInputName" aria-describedby=""
                         placeholder="Enter Third image">
                  </div>

                

                 <button type="submit" class="btn btn-primary">Add Images</button>
               </form>
                </div>

                </div>
            </main>
 <?php
include '../footer.php';
 ?>