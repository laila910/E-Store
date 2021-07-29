<?php
include '../helpers/functions.php';
include '../helpers/checkLogin.php';
include '../helpers/checkPrem.php';
include '../helpers/dbconnection.php';
include '../header.php';



//fetch categoreis
  $sql2 = "SELECT * FROM `users`";
  $op2  = mysqli_query($conn,$sql2);
  $data2 =mysqli_fetch_assoc($op2);

if($_SERVER['REQUEST_METHOD']=='POST'){
      $userid =CleanInputs(Sanitize($_POST["userid"],1));  
      $companyname =CleanInputs(Sanitize($_POST["companyname"],2));
      $ShippingMethod=CleanInputs(Sanitize($_POST["ShippingMethod"],2));  
    

  $errorMessages=array();
  //validate company name
   if(!Validator($companyname,1)){
      $errorMessages['companyname']="company Name field Required";
   }
    
  if(!Validator($companyname,2,4)){
    $errorMessages['companynameLength'] = "company Name length must be > 4 ";

  }
  //validate shippinng method
    if(!Validator($ShippingMethod,1)){
      $errorMessages['shippingMethod']="shipping Method field Required";
   }
    
  if(!Validator($ShippingMethod,2,0)){
    $errorMessages['shippingMethodLength'] = "shipping Method  length must be > 0";

  }
  //Validate user Id 
   if(!Validator($userid,1)){
      $errorMessages['userId']="user Id  field Required";
   }
   if(!Validator($userid,3)){
      $errorMessages['userId']="user Id  must be Integer Number";
   }
 
 if(count($errorMessages) > 0){
    $_SESSION['errors']=$errorMessages;

 }else{
       $sql4 ="INSERT INTO `ordershipper`( `userid`, `companyname`, `ShippingMethod`) VALUES ('$userid','$companyname','$ShippingMethod')";


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
                       <li class="breadcrumb-item active"> Add New shipper company </li>
                                    <?php  }?>
                    </ol>
                <div class="container">
           
                      <form method="post" action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']);?>"
                 enctype="multipart/form-data">
                    <div class="form-group">
                         <label for="exampleInput">shipper Name</label>
                          <select name="userid" class="form-control"> 
                                 <?php 
                                    while($data = mysqli_fetch_assoc($op2)){
                                 ?>
                           <option value="<?php echo $data2['id'];?>" >
                           <?php echo $data['firstName'];?></option>
                              <?php } ?>
                        </select>  
                    </div>

                  <div class="form-group">
                     <label for="exampleInputEmail1">Enter shipper company </label>
                     <input type="text" name="companyname" class="form-control" id="exampleInputName" aria-describedby=""
                         placeholder="Enter company name ">
                 </div>

                 <div class="form-group">
                     <label for="exampleInputEmail1">Enter Shipping Method</label>
                     <input type="text" name="ShippingMethod" class="form-control" id="exampleInputName" aria-describedby=""
                         placeholder="Enter ShippingMethod ">
                  </div>

                    


                 <button type="submit" class="btn btn-primary">Create Product</button>
               </form>
                </div>

                </div>
            </main>
 <?php
include '../footer.php';
 ?>