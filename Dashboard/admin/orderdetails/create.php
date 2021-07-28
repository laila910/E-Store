<?php
include '../header.php';
include '../helpers/functions.php';
include '../helpers/checkLogin.php';
include '../helpers/checkPrem.php';
include '../helpers/dbconnection.php';

//fetch orders
  $sql2 = "SELECT * FROM orders";
  $op2  = mysqli_query($conn,$sql2);


if($_SERVER['REQUEST_METHOD']=='POST'){

      $ordernumber=CleanInputs(Sanitize($_POST["ordernumber"],1));  
      $shippingcost =CleanInputs(Sanitize($_POST["shippingcost"],1));  
      $quntity =CleanInputs(Sanitize($_POST["quntity"],1));  
      $discount =CleanInputs(Sanitize($_POST["discount"],1));  
      $totalprice =CleanInputs(Sanitize($_POST["totalprice"],1));  
 
  $errorMessages=array();
 
  //Validate orderNumber 
   if(!Validator($ordernumber,1)){
      $errorMessages['ordernumber']="ordernumber field Required";
   }
   if(!Validator($ordernumber,3)){
      $errorMessages['ordernumber']="ordernumber must be Integer Number";
   }
 //Validate shipping cost
   if(!Validator($shippingcost,1)){
      $errorMessages['shippingcost']="shippingcost  field Required";
   }
   if(!Validator($shippingcost,3)){
      $errorMessages['shippingcost']="shippingcost must be Integer Number";
   }
 //Validate quantity
   if(!Validator($quntity,1)){
      $errorMessages['quantity']="quantity field Required";
   }
   if(!Validator($quntity,3)){
      $errorMessages['quantity']="quantity must be Integer Number";
   }
 //Validate discount
   if(!Validator($discount,1)){
      $errorMessages['discount']="discount field Required";
   }
   if(!Validator($discount,3)){
      $errorMessages['quantity']="discount must be Integer Number";
   }
 //Validate totalprice
   if(!Validator($totalprice,1)){
      $errorMessages['totalprice']="totalprice field Required";
   }
   if(!Validator($totalprice,3)){
      $errorMessages['totalprice']="totalprice must be Integer Number";
   }

  
 if(count($errorMessages) > 0){
    $_SESSION['errors']=$errorMessages;

 }else{
       $sql4 =  "INSERT INTO `orderdetailes`( `ordernumber`, `shippingcost`, `quntity`, `discount`, `totalprice`) VALUES ('$ordernumber','$shippingcost','$quntity','$discount','$totalprice')";


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
                       <li class="breadcrumb-item active"> Add productdetails </li>
                                    <?php  }?>
                    </ol>
                <div class="container">
           
                      <form method="post" action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']);?>"
                 enctype="multipart/form-data">

                  <div class="form-group">
                         <label for="exampleInput"> order number </label>
                          <select name="ordernumber" class="form-control"> 
                                 <?php 
                                    while($data = mysqli_fetch_assoc($op2)){
                                 ?>
                           <option value="<?php echo $data['id'];?>"><?php echo $data['id'];?></option>
                              <?php } ?>
                        </select>  
                    </div>

                  <div class="form-group">
                     <label for="exampleInputEmail1">Enter shippingcost</label>
                     <input type="text" name="shippingcost" class="form-control" id="exampleInputName" aria-describedby=""
                         placeholder="Enter shippingcost ">
                 </div>

                 <div class="form-group">
                     <label for="exampleInputEmail1">Enter quntity</label> <?php //remeber to move this from here to orderstable ?>
                     <input type="text" name="quntity" class="form-control" id="exampleInputName" aria-describedby=""
                         placeholder="Enter quntity">
                  </div>

                  

                 <div class="form-group">
                     <label for="exampleInputEmail1">Enter discount </label>
                     <input type="text" name="discount" class="form-control" id="exampleInputName" aria-describedby=""
                         placeholder="Enter discount">
                  </div>

                 <div class="form-group">
                     <label for="exampleInputEmail1">Enter 	totalprice</label>
                     <input type="text" name="totalprice" class="form-control" id="exampleInputName" aria-describedby=""
                         placeholder="Enter totalprice">
                  </div>

                 <button type="submit" class="btn btn-primary">create</button>
               </form>
                </div>

                </div>
            </main>
 <?php
include '../footer.php';
 ?>