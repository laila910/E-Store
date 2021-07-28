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
       
          $firstcolor=CleanInputs(Sanitize($_POST["firstcolor"],2));  
      $secondcolor=CleanInputs(Sanitize($_POST["secondcolor"],2));  
     
      $thirdcolor=CleanInputs(Sanitize($_POST["thirdcolor"],2));
     
    
        $id  = CleanInputs(Sanitize($_POST['id'],1));
  
    

  $errorMessages=array();
   //validate First Color
   if(!Validator($firstcolor,1)){
      $errorMessages['firstColor']="First Color field Required";
   }
    
  if(!Validator($firstcolor,2,2)){
    $errorMessages['firstcolorLength'] = "product Name length must be > 2 ";

  }
//validate Second Color
   if(!Validator($secondcolor,1)){
      $errorMessages['secondColor']="Second Color field Required";
   }
    
  if(!Validator($secondcolor,2,2)){
    $errorMessages['secondcolorLength'] = "Second Color length must be > 2 ";

  }
//validate Third Color
   if(!Validator($thirdcolor,1)){
      $errorMessages['thirdColor']="Third Color field Required";
   }

 //Validate color Id 
  if(!Validator($id,1)){
      $errorMessages['colorId']=" color Id  field Required";
   }
      if(!Validator($id,3)){
          $errorMessages['colorId'] = " color Id must be integer number ";
      }
     

     if(count($errorMessages) == 0){
       
      
         $sql="UPDATE `productcolor` SET `firstcolor`='$firstcolor',`secondcolor`='$secondcolor',`thirdcolor`='$thirdcolor' WHERE `id`=". $id;

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
   $sql  ="SELECT * FROM `productcolor` WHERE `id`= $id";
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
                        
                        <li class="breadcrumb-item active">Edit Color </li>
                        <?php } ?>
                        
                        
                        
                        </ol>

                      

<div class="container">

 <form  method="post"  action="edit.php?id=<?php echo $FData['id'];?>"  enctype ="multipart/form-data">
  
               <div class="form-group">
                     <label for="exampleInputEmail1">Enter First Color</label>
                     <input type="text" name="firstcolor" value="<?php echo $FData['firstcolor']; ?>"  class="form-control" id="exampleInputName" aria-describedby=""
                         placeholder="Enter First Color ">
                 </div>

                 <div class="form-group">
                     <label for="exampleInputEmail1">Enter Second Color</label>
                     <input type="text" name="secondcolor" value="<?php echo $FData['secondcolor']; ?>"  class="form-control" id="exampleInputName" aria-describedby=""
                         placeholder="Enter Second Color">
                  </div>

                  <div class="form-group">
                     <label for="exampleInputEmail1">Enter Third Color</label>
                     <input type="text" name="thirdcolor" value="<?php echo $FData['thirdcolor']; ?>"  class="form-control" id="exampleInputName" aria-describedby=""
                         placeholder="Enter Third Color">
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