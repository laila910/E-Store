<?php
include '../helpers/functions.php';
include '../helpers/checkLogin.php';
include '../helpers/checkPrem.php';
include '../helpers/dbconnection.php';
include '../header.php';




if($_SERVER['REQUEST_METHOD']=='POST'){

   
      $brandName =CleanInputs(Sanitize($_POST["brandName"],2));  
       $brandImage     = $_FILES['brandImage']['name'];
   
    

  $errorMessages=array();
  //validate brand Name
   if(!Validator($brandName,1)){
      $errorMessages['brandName']="Brand Name field Required";
   }
    
  if(!Validator($brandName,2,4)){
    $errorMessages['brandnameLength'] = "brand Name length must be > 4 ";

  }
  //validate brandImage 
   $nameArray = explode('.',$brandImage);
   $FileExtension = strtolower($nameArray[1]);
   
     if(!Validator($brandName,1)){
      
      $errorMessages['BrandImage'] = " Brand image Field Required";

    }


    if(!Validator($FileExtension,5)){
      
      $errorMessages['BrandimageExtension'] = "Invalid Image Extension";

    }

  
 if(count($errorMessages) > 0){
    $_SESSION['errors']=$errorMessages;

 }else{
      $tmp_path = $_FILES['brandImage']['tmp_name'];
       $FinalName = rand().time().'.'.$FileExtension;
 
       $disFolder = './uploads/';
         
       $disPath  = $disFolder.$FinalName;
 
     if(move_uploaded_file($tmp_path,$disPath))
       {
              
  
       $sql4 =  "INSERT INTO `brand`( `brandName`, `brandImage`) VALUES ('$brandName','$brandImage')";


      $op4 = mysqli_query($conn,$sql4);
     
     
    if($op4){

        $errorMessages['Result'] = "Data inserted.";
    }else{
        $errorMessages['Result']  = "Error Try Again.";
     
       
    }
     }else{
               $Message['Result'] = "Error In Uploading";
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
                       <li class="breadcrumb-item active"> Add New Brand</li>
                                    <?php  }?>
                    </ol>
                <div class="container">
           
                      <form method="post" action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']);?>"
                 enctype="multipart/form-data">

                 <div class="form-group">
                     <label for="exampleInputEmail1">Enter brandName </label>
                     <input type="text" name="brandName" class="form-control" id="exampleInputName" aria-describedby=""
                         placeholder="Enter BrandName ">
                  </div>

                  <div class="form-group">
                        <label for="exampleInputEmail1">Upload Brand Image</label>
                         <br>
                        <input type="file" name="brandImage"  >
                  </div>

                 <button type="submit" class="btn btn-primary">Create Brand</button>
               </form>
                </div>

                </div>
            </main>
 <?php
include '../footer.php';
 ?>