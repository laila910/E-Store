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
       
        
        $productId = CleanInputs(Sanitize($_POST["product_id"],1)); 
         $firstimageName     = $_FILES['firstimage']['name'];
         $secondimageName     = $_FILES['secondimage']['name'];
         $thirdimageName     = $_FILES['thirdimage']['name'];
          $image   = $_POST['OldImage'];
          $finalImage = $image;
         
  
    

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


     if(count($errorMessages) == 0){
          //add image1 to include folder
      $tmp_path1= $_FILES['firstimage']['tmp_name'];
       $FinalNameimage1 = rand().time().'.'.$FileExtensionimage1;
 
       $disFolder = './uploads/';
         
       $disPath  = $disFolder.$FinalNameimage1;
     //add image2 to include folder
      $tmp_path2= $_FILES['secondimage']['tmp_name'];
       $FinalNameimage2 = rand().time().'.'.$FileExtensionimage2;
 
       $disFolder = './uploads/';
         
       $disPath  = $disFolder.$FinalNameimage2;
    //add image3 to include folder
      $tmp_path3= $_FILES['thirdimage']['tmp_name'];
       $FinalNameimage3 = rand().time().'.'.$FileExtensionimage3;
 
       $disFolder = './uploads/';
         
       $disPath  = $disFolder.$FinalNameimage3;
 
 
 
     if(move_uploaded_file($tmp_path1,$disPath) && move_uploaded_file($tmp_path2,$disPath) && move_uploaded_file($tmp_path3,$disPath) )
       {
      
         $sql="UPDATE `productimges` SET `product_id`='$productId',`firstimage`='$firstimageName',`secondimage`='$secondimageName',`thirdimage`='$thirdimageName' WHERE `id`=". $id;

         $op = mysqli_query($conn,$sql);
        //  echo mysqli_error($conn);
        //  exit();

       if($op){

            $errorMessages['Result'] = "Data updated.";
       
       }else{
            $errorMessages['Result']  = "Error Try Again.";
     
         }
        }else{
             $errorMessages['Result'] = "Error In Uploading";
        }
        $_SESSION['errors'] = $errorMessages;
       
        header('Location: index.php');

     }else{

       $_SESSION['errors'] = $errorMessages;
   }

  }

   # Fetch productimages
   $sql  ="SELECT * FROM `productimages` WHERE `id`= $id";
   $op   = mysqli_query($conn,$sql);
   $FData = mysqli_fetch_assoc($op);
   #fetch productdetails
  
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
                        
                        <li class="breadcrumb-item active">Edit Color </li>
                        <?php } ?>
                        
                        
                        
                        </ol>

                      

<div class="container">

 <form  method="post"  action="edit.php?id=<?php echo $FData['id'];?>"  enctype ="multipart/form-data">
  
               <div class="form-group">
                     <label for="exampleInputEmail1">Enter First image</label>
                     <input type="file" name="firstimage"   class="form-control" id="exampleInputName" aria-describedby=""
                         placeholder="Enter First image ">
                     <br>

                     <img src='./uploads/<?php echo $FetchedData['firstimage'];?>'  width="70px" >

                    <input type="hidden" name = "OldImage1" value="<?php echo $FetchedData['firstimage'];?>">
                 </div>

                 <div class="form-group">
                     <label for="exampleInputEmail1">Enter Second Image</label>
                     <input type="file" name="secondimage" value="<?php echo $FData['secondimage']; ?>"  class="form-control" id="exampleInputName" aria-describedby=""
                         placeholder="Enter Second image">
                  </div>

                  <div class="form-group">
                     <label for="exampleInputEmail1">Enter Third Image</label>
                     <input type="file" name="thirdimage" value="<?php echo $FData['thirdimage']; ?>"  class="form-control" id="exampleInputName" aria-describedby=""
                         placeholder="Enter Third image">
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