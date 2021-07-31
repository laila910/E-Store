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
       
        
        $productId = CleanInputs(Sanitize($_POST["product_id"],1)); 
        
          $image1  = $_POST['OldImage1'];
          $finalImage1 = $image1;

          $image2  = $_POST['OldImage2'];
          $finalImage2 = $image2;

          $image3  = $_POST['OldImage3'];
          $finalImage3 = $image3;
         
            $id = CleanInputs(Sanitize($_POST['id'],1));
    

  $errorMessages=array();
  //Validate product  Id 
   if(!Validator($productId,1)){
      $errorMessages['productId']="product  Id  field Required";
   }
   if(!Validator($productId,3)){
      $errorMessages['productId']="product Id  must be Integer Number";
   }
  //Validate images Id 
   if(!Validator($id,1)){
      $errorMessages['imageid']="Image Id  field Required";
   }
   if(!Validator($id,3)){
      $errorMessages['imageid']="Image Id  must be Integer Number";
   }
    //Validate ProductFirstImage
   
    $imageName1     = $_FILES['firstimage']['name'];

   if(Validator($imageName1,1)){

      $nameArray = explode('.',$imageName1);
      $FileExtension1 = strtolower($nameArray[1]);
      
      $newName1 = rand().time().'.'.$FileExtension1;

 
   if(!Validator($imageName1,1)){
    
    $errorMessages['firstimage'] = "first image Field Required";

  }
   if(!Validator($FileExtension1,5)){
    
    $errorMessages['imageExtension1'] = "Invalid Image1 Extension";

        }
      }
    //Validate ProductsecondImage
   
    $imageName2    = $_FILES['secondimage']['name'];

   if(Validator($imageName2,1)){

      $nameArray = explode('.',$imageName2);
      $FileExtension2 = strtolower($nameArray[1]);
      
      $newName2 = rand().time().'.'.$FileExtension2;

 
   if(!Validator($imageName2,1)){
    
    $errorMessages['secondimage'] = "second image Field Required";

  }
   if(!Validator($FileExtension2,5)){
    
    $errorMessages['imageExtension2'] = "Invalid Image2 Extension";

        }
      }
    //Validate ProductThirdImage
   
    $imageName3    = $_FILES['thirdimage']['name'];

   if(Validator($imageName3,1)){

      $nameArray = explode('.',$imageName3);
      $FileExtension3= strtolower($nameArray[1]);
      
      $newName3 = rand().time().'.'.$FileExtension3;

 
   if(!Validator($imageName3,1)){
    
    $errorMessages['thirdimage'] = "third image Field Required";

  }
   if(!Validator($FileExtension3,5)){
    
    $errorMessages['imageExtension3'] = "Invalid Image3 Extension";

        }
      }


//end of validations


     if(count($errorMessages) == 0){

    //add image1 to include folder
       if(Validator($imageName1,1)){
       

        $fileTmp1     = $_FILES['firstimage']['tmp_name'];
        $uplodeFolder = './uploads/';
        $desPath1    = $uplodeFolder.$newName1;


        
        if(move_uploaded_file($fileTmp1,$desPath1)){
          // 
         
           $finalImage1 = $newName1;
      

          if(file_exists('./uploads/'.$image1)){
             
             unlink('./uploads/'.$image1);
          }

        }else{

          $errorMessages['imageMove1'] = "Error in Upload Image1 Try Again";

          }

      }
    //add image2 to include folder
       if(Validator($imageName2,1)){
       

        $fileTmp2    = $_FILES['secondimage']['tmp_name'];
        $uplodeFolder = './uploads/';
        $desPath2   = $uplodeFolder.$newName2;


        
        if(move_uploaded_file($fileTmp2,$desPath2)){
          // 
         
           $finalImage2 = $newName2;
      

          if(file_exists('./uploads/'.$image2)){
             
             unlink('./uploads/'.$image2);
          }

        }else{

          $errorMessages['imageMove2'] = "Error in Upload Image2 Try Again";

          }

      }
    //add image3 to include folder
       if(Validator($imageName3,1)){
       

        $fileTmp3   = $_FILES['thirdimage']['tmp_name'];
        $uplodeFolder = './uploads/';
        $desPath3  = $uplodeFolder.$newName3;


        
        if(move_uploaded_file($fileTmp3,$desPath3)){
          // 
         
           $finalImage3= $newName3;
      

          if(file_exists('./uploads/'.$image3)){
             
             unlink('./uploads/'.$image3);
          }

        }else{

          $errorMessages['imageMove3'] = "Error in Upload Image3 Try Again";

          }

      }
 
 
      $sql="UPDATE `productimges` SET `product_id`='$productId',`firstimage`='$finalImage1',`secondimage`='$finalImage2',`thirdimage`='$finalImage3' WHERE `id`=". $id;

         $op = mysqli_query($conn,$sql);
        
       if($op){

            $errorMessages['Result'] = "Data updated.";
       
       }else{
            $errorMessages['Result']  = "Error Try Again.";
     
         }
             $_SESSION['errors'] = $errorMessages;
               header('Location: index.php');

      
     }else{

         $_SESSION['errors'] = $errorMessages;
            header('Location: index.php');

   }

  }

   # Fetch productimages
   $sql  ="SELECT * FROM `productimges` WHERE `id`= $id";
   $op   = mysqli_query($conn,$sql);
   $FData = mysqli_fetch_assoc($op);

   #fetch productName
 
     $sql1 = "SELECT `product`.`productname` ,`productdetails`.* from `productdetails` join `product` on `productdetails`.`product_Id` = `product`.`id`";

     $op1  = mysqli_query($conn,$sql1);
  
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
                        
                        <li class="breadcrumb-item active">Edit Product Images </li>
                        <?php } ?>
                        
                        
                        
                        </ol>

                      

<div class="container">

 <form  method="post"  action="edit.php?id=<?php echo $FData['id'];?>"  enctype ="multipart/form-data">
               
                 <div class="form-group">
                            <label for="exampleInput"> Product Name</label>
                            <select name="product_id" class="form-control"> 
                                 <?php 
                                     while($data = mysqli_fetch_assoc($op1)){
                                  ?>
                              <option value="<?php echo $data['id'];?>"    <?php if($data['id'] == $FData['product_id'] ){ echo 'selected';}?>    >
                              <?php echo $data['productname'];?></option>
                                   <?php } ?>
                            </select>  
                  </div>


                   <div class="form-group">
                        <label for="exampleInputEmail1">Upload first Image</label>
                         <br>
                        <input type="file" name="firstimage"  >
                        <br>

                      <img src='./uploads/<?php echo $FData['firstimage'];?>'  width="70px" >

                      <input type="hidden" name = "OldImage1" value="<?php echo $FData['firstimage'];?>">
                  </div>

                   <div class="form-group">
                        <label for="exampleInputEmail1">Upload second Image</label>
                         <br>
                        <input type="file" name="secondimage"  >
                        <br>

                      <img src='./uploads/<?php echo $FData['secondimage'];?>'  width="70px" >

                      <input type="hidden" name = "OldImage2" value="<?php echo $FData['secondimage'];?>">
                  </div>

                   <div class="form-group">
                        <label for="exampleInputEmail1">Upload Third Image</label>
                         <br>
                        <input type="file" name="thirdimage"  >
                        <br>

                      <img src='./uploads/<?php echo $FData['thirdimage'];?>'  width="70px" >

                      <input type="hidden" name = "OldImage3" value="<?php echo $FData['thirdimage'];?>">
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