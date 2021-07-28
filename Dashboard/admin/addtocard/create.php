<?php
include '../header.php';
include '../helpers/functions.php';
include '../helpers/dbconnection.php';

//fetch customers
  $sql2 = "SELECT `customers`.* ,`users`.`firstName` FROM `customers` join `users` on `customers`.`usersid`=`users`.`id`";
  $op2  = mysqli_query($conn,$sql2);
//fetch orders
  $sql3 = "SELECT `orders`.* ,`ordershipper`.`companyname` FROM `orders` join `ordershipper`on `orders`.`shipperId`=`ordershipper`.`id`";
  $op3  = mysqli_query($conn,$sql3);
//productdetails
 $sql5 = "SELECT `productdetails`.*,`product`.`productname` FROM `productdetails` join `product` on `productdetails`.`product_Id` =`product`.`id`";
  $op5  = mysqli_query($conn,$sql5);
  

if($_SERVER['REQUEST_METHOD']=='POST'){

   
   
      $customerId=CleanInputs(Sanitize($_POST["customerId"],1));  
      $carditem =CleanInputs(Sanitize($_POST["carditem"],1));  
       $quantity=CleanInputs(Sanitize($_POST["quantity"],1));  
      $orderid =CleanInputs(Sanitize($_POST["orderid"],1));
         $session =CleanInputs(Sanitize($_POST["session"],2));    
    
    

  $errorMessages=array();
  //validate Session
   if(!Validator($session,1)){
      $errorMessages['session']="session field Required";
   }
    
  if(!Validator($session,2,1)){
    $errorMessages['sessionLength'] = "session length must be > 1";

  }
 
  //Validate Customer Id 
   if(!Validator($customerId,1)){
      $errorMessages['customerId']="customer Id  field Required";
   }
   if(!Validator($customerId,3)){
      $errorMessages['customerId']="customer Id  must be Integer Number";
   }
 //Validate cardItem Id 
   if(!Validator($carditem,1)){
      $errorMessages['carditemId']="cardItem Id  field Required";
   }
   if(!Validator($carditem,3)){
      $errorMessages['carditemId']="cardItem Id  must be Integer Number";
   }
//Validate quantity
   if(!Validator($quantity,1)){
      $errorMessages['quantity']="quantity  field Required";
   }
   if(!Validator($quantity,3)){
      $errorMessages['quantity']="quantity must be Integer Number";
   }
//Validate order Id 
   if(!Validator($orderid,1)){
      $errorMessages['orderId']="order Id  field Required";
   }
   if(!Validator($orderid,3)){
      $errorMessages['orderId']="order Id  must be Integer Number";
   }
 
 if(count($errorMessages) > 0){
    $_SESSION['errors']=$errorMessages;

 }else{
       $sql4 =  "INSERT INTO `addtocard`( `customerId`, `carditem`, `quantity`, `session`, `orderid`) VALUES ('$customerId','$carditem','$quantity','$session','$orderid')";


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
                       <li class="breadcrumb-item active"> Add New card</li>
                                    <?php  }?>
                    </ol>
                <div class="container">
           
                      <form method="post" action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']);?>"
                 enctype="multipart/form-data">

                  <div class="form-group">
                     <label for="exampleInputEmail1">Enter session to order </label>
                     <input type="text" name="session" class="form-control" id="exampleInputName" aria-describedby=""
                         placeholder="Enter session Yes or no ">
                 </div>

                  <div class="form-group">
                     <label for="exampleInputEmail1">Enter quantity </label>
                     <input type="text" name="quantity" class="form-control" id="exampleInputName" aria-describedby=""
                         placeholder="Enter quantity ">
                 </div>

                  <div class="form-group">
                         <label for="exampleInput"> Product name </label>
                          <select name="carditem" class="form-control"> 
                                 <?php 
                                    while($data = mysqli_fetch_assoc($op5)){
                                 ?>
                           <option value="<?php echo $data['id'];?>"><?php echo $data['productname'];?></option>
                              <?php } ?>
                        </select>  
                    </div>

                    <div class="form-group">
                         <label for="exampleInput"> Customer Name </label>
                          <select name="customerId" class="form-control"> 
                                 <?php 
                                    while($data = mysqli_fetch_assoc($op2)){
                                 ?>
                           <option value="<?php echo $data['id'];?>"><?php echo $data['firstName'];?></option>
                              <?php } ?>
                        </select>  
                    </div>
                
                    <div class="form-group">
                         <label for="exampleInput"> order shipper </label>
                          <select name="orderid" class="form-control"> 
                                 <?php 
                                    while($data = mysqli_fetch_assoc($op3)){
                                 ?>
                           <option value="<?php echo $data['id'];?>"><?php echo $data['companyname'];?></option>
                              <?php } ?>
                        </select>  
                    </div>
                

                 <button type="submit" class="btn btn-primary">Create Product</button>
               </form>
                </div>

                </div>
            </main>
 <?php
include '../footer.php';
 ?>