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
       
      $paymentType =CleanInputs(Sanitize($_POST["paymentType"],2));    
      $paymentAllowed	 =CleanInputs(Sanitize($_POST["paymentAllowed"],2));
      $id =CleanInputs(Sanitize($_POST["id"],1));
       
    
      

       $errorMessages=array();
    //validate Payment Type
   if(!Validator($paymentType,1)){
      $errorMessages['paymenttype']="paymenttype field Required";
   }
    
  if(!Validator($paymentType,2,3)){
    $errorMessages['paymenttypeLength'] = "paymenttype length must be > 3 ";

  }
  //validate Paymentallowed
    if(!Validator($paymentAllowed,1)){
      $errorMessages['paymentAllowed']="paymentAllowed field Required";
   }
    
  if(!Validator($paymentAllowed,2,0)){
    $errorMessages['paymentAllowedLength'] = "paymentAllowed length must be > 0";

  }

  


  
 //Validate product  Id 
  if(!Validator($id,1)){
      $errorMessages['paymentmethodid']="payment Method Id  field Required";
   }
      if(!Validator($id,3)){
          $errorMessages['paymentmethodid'] = "payment Method Id must be integer number ";
      }
   

     if(count($errorMessages) == 0){
       
      
         $sql="UPDATE `paymentmethod` SET`paymentType`='$paymentType',`paymentAllowed`='$paymentAllowed' WHERE `id`=". $id;

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
   $sql  ="SELECT `id`, `paymentType`, `paymentAllowed` FROM `paymentmethod` WHERE `id`= $id";
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
                        
                        <li class="breadcrumb-item active">Edit PaymentMethod</li>
                        <?php } ?>
                        
                        
                        
                        </ol>

                      

<div class="container">

 <form  method="post"  action="edit.php?id=<?php echo $FData['id'];?>"  enctype ="multipart/form-data">
  
 
               <div class="form-group">
                     <label for="exampleInputEmail1">Enter paymentType</label>
                     <input type="text" name="paymentType"  value="<?php echo $FData['paymentType']; ?>"class="form-control" id="exampleInputName" aria-describedby=""
                         placeholder="Enter paymentType ">
                 </div>

                 <div class="form-group">
                     <label for="exampleInputEmail1">Enter payment Allowed</label>
                     <input type="text" name="paymentAllowed"  value="<?php echo $FData['paymentAllowed']; ?>"class="form-control" id="exampleInputName" aria-describedby=""
                         placeholder="Enter paymentAllowed">
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