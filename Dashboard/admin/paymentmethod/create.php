<?php
include '../header.php';
include '../helpers/functions.php';
include '../helpers/dbconnection.php';



if($_SERVER['REQUEST_METHOD']=='POST'){

   
      $paymentType =CleanInputs(Sanitize($_POST["paymentType"],2));    
      $paymentAllowed	 =CleanInputs(Sanitize($_POST["paymentAllowed"],2));
       
    

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


  
 if(count($errorMessages) > 0){
    $_SESSION['errors']=$errorMessages;

 }else{
       $sql =  "INSERT INTO `paymentmethod`( `paymentType`, `paymentAllowed`) VALUES ('$paymentType','$paymentAllowed')";


      $op = mysqli_query($conn,$sql);
     
     
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
                       <li class="breadcrumb-item active"> Add New PaymentMethod</li>
                                    <?php  }?>
                    </ol>
                <div class="container">
           
                      <form method="post" action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']);?>"
                 enctype="multipart/form-data">

                  <div class="form-group">
                     <label for="exampleInputEmail1">Enter Payment Type</label>
                     <input type="text" name="paymentType" class="form-control" id="exampleInputName" aria-describedby=""
                         placeholder="Enter paymentType ">
                 </div>

                 <div class="form-group">
                     <label for="exampleInputEmail1">Enter Payment Allowed</label>
                     <input type="text" name="paymentAllowed" class="form-control" id="exampleInputName" aria-describedby=""
                         placeholder="Enter payment Allowed ">
                  </div>

                     

                 

                 <button type="submit" class="btn btn-primary">Create Payment Method</button>
               </form>
                </div>

                </div>
            </main>
 <?php
include '../footer.php';
 ?>