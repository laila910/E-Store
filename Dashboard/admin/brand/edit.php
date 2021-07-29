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
       
      $brandName =CleanInputs(Sanitize($_POST["brandName"],2));  
    //    $brandImage     = $_FILES['brandImage']['name'];  
     $image   = $_POST['OldImage'];
     $finalImage = $image;
       $id = CleanInputs(Sanitize($_POST['brand_Id'],1));
      

       $errorMessages=array();
    //validate brand Name
   if(!Validator($brandName,1)){
      $errorMessages['brandName']="Brand Name field Required";
   }
    
  if(!Validator($brandName,2,4)){
    $errorMessages['brandnameLength'] = "brand Name length must be > 4 ";

  }
  //validate Id 
    
  if(!Validator($id,1)){
      $errorMessages['brandid']=" brand id  field Required";
   }
      if(!Validator($id,3)){
          $errorMessages['brandid'] = "brand must be integer number ";
      }
  //Validate BrandImage
   
    $imageName     = $_FILES['brandImage']['name'];

   if(Validator($imageName,1)){

      $nameArray = explode('.',$imageName);
      $FileExtension = strtolower($nameArray[1]);
      
      $newName = rand().time().'.'.$FileExtension;

 
   if(!Validator($imageName,1)){
    
    $errorMessages['image'] = "image Field Required";

  }
   if(!Validator($FileExtension,5)){
    
    $errorMessages['imageExtension'] = "Invalid Image Extension";

        }
      }

     if(count($errorMessages) == 0){
     
        if(Validator($imageName,1)){
       

        $fileTmp      = $_FILES['brandImage']['tmp_name'];
        $uplodeFolder = './uploads/';
        $desPath      = $uplodeFolder.$newName;


        
        if(move_uploaded_file($fileTmp,$desPath)){
          // 
         
           $finalImage = $newName;
      

          if(file_exists('./uploads/'.$image)){
             
             unlink('./uploads/'.$image);
          }

        }else{

          $errorMessages['imageMove'] = "Error in Upload Tru Again";

          }

      }
      
         $sql="UPDATE `brand` SET`brandName`='$brandName',`brandImage`='$imageName' WHERE `brand_Id`=". $id;

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
    

   }

  }

   # Fetch product
   $sql  ="SELECT * FROM `brand` WHERE `brand_Id`= $id";
   $op   = mysqli_query($conn,$sql);
   $FData = mysqli_fetch_assoc($op);

  

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
                        
                        <li class="breadcrumb-item active">Edit Brand</li>
                        <?php } ?>
                        
                        
                        
                        </ol>

                      

<div class="container">

 <form  method="post"  action="edit.php?id=<?php echo $FData['brand_Id'];?>"  enctype ="multipart/form-data">
  
 
              <div class="form-group">
                     <label for="exampleInputEmail1">Enter brandName </label>
                     <input type="text" name="brandName" value="<?php echo $FData['brandName'];?>" class="form-control" id="exampleInputName" aria-describedby=""
                         placeholder="Enter BrandName ">
                  </div>

                  <div class="form-group">
                        <label for="exampleInputEmail1">Upload Brand Image</label>
                         <br>
                        <input type="file" name="brandImage"  >
                        <br>

                      <img src='./uploads/<?php echo $FData['brandImage'];?>'  width="70px" >

                      <input type="hidden" name = "OldImage" value="<?php echo $FData['brandImage'];?>">
                  </div>
 
                      <input type="hidden" name="brand_Id" value="<?php echo $FData['brand_Id'];?>">

                
  
                     <button type="submit"  name="submit"class="btn btn-primary">Submit</button>
</form>
</div>

              </div>
              </main>   
 <?php
include '../footer.php';
 ?>