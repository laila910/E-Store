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
       
      $paymentId=CleanInputs(Sanitize($_POST["paymentId"],1));  
      $card_id=CleanInputs(Sanitize($_POST["card_id"],1));  
      $shipperId =CleanInputs(Sanitize($_POST["shipperId"],1));  
      $salestax=CleanInputs(Sanitize($_POST["salestax"],1));  
      $paid=CleanInputs(Sanitize($_POST["paid"],2));  
      $delivered=CleanInputs(Sanitize($_POST["delivered"],2));  
      $ordercanceled=CleanInputs(Sanitize($_POST["ordercanceled"],2));  
      $shipdate =CleanInputs(Sanitize($_POST["shipdate"],2));  
      $requireddate =CleanInputs(Sanitize($_POST["requireddate"],2));
      $paymentdate =CleanInputs(Sanitize($_POST["paymentdate"],2));
    
       $id  = CleanInputs(Sanitize($_POST['id'],1));
      

       $errorMessages=array();
//Validate orders id 
   if(!Validator($id,1)){
      $errorMessages['ordersid']="orders Id  field Required";
   }
   if(!Validator($id,3)){
      $errorMessages['ordersid']="orders Id  must be Integer Number";
   }
 //Validate payment Id 
   if(!Validator($paymentId,1)){
      $errorMessages['paymentId']="payment Id  field Required";
   }
   if(!Validator($paymentId,3)){
      $errorMessages['paymentId']="payment Id  must be Integer Number";
   }
  //Validate card Id 
   if(!Validator($card_id,1)){
      $errorMessages['cardId']="card Id  field Required";
   }
   if(!Validator($card_id,3)){
      $errorMessages['cardId']="card Id  must be Integer Number";
   }
  //Validate shipper Id 
   if(!Validator($shipperId,1)){
      $errorMessages['shipperId']="shipper Id  field Required";
   }
   if(!Validator($shipperId,3)){
      $errorMessages['shipperId']="shipper Id  must be Integer Number";
   }
  //Validate salestax
   if(!Validator($salestax,1)){
      $errorMessages['salestax']="salestax  field Required";
   }
   if(!Validator($salestax,3)){
      $errorMessages['salestax']="salestax  must be Integer Number";
   }
  //Validate paid status
   if(!Validator($paid,1)){
      $errorMessages['paidStatus']="paidStatus  field Required";
   }
   if(!Validator($paid,2,1)){
      $errorMessages['paidStatus']="paidStatus Length must be >1";
   }
  //Validate delivered status
   if(!Validator($delivered,1)){
      $errorMessages['deliveredStatus']="deliveredStatus  field Required";
   }
   if(!Validator($delivered,2,1)){
      $errorMessages['deliveredStatus']="deliveredStatus length  must be >1";
   }
  //Validate ordercanceled status
   if(!Validator($ordercanceled,1)){
      $errorMessages['ordercanceled']="ordercanceledStatus  field Required";
   }
   if(!Validator($ordercanceled,2,1)){
      $errorMessages['ordercanceledStatus']="ordercanceledStatus length  must be >1 ";
   }
  //validate shipdate
   if(!Validator($shipdate,1)){
      $errorMessages['shipdate']="shipdate field Required";
   }
    
  if(!Validator($shipdate,2,4)){
    $errorMessages['shipdateLength'] = "shipdate length must be > 1";

  }
  //validate requiredate
    if(!Validator($requireddate,1)){
      $errorMessages['requiredate']="require date field Required";
   }
    
  if(!Validator($requireddate,2,4)){
    $errorMessages['requiredateLength'] = "requiredate length must be > 0";

  }
 //validate paymentdate
    if(!Validator($paymentdate,1)){
      $errorMessages['paymentdate']="payment date field Required";
   }
    
  if(!Validator($paymentdate,2,4)){
    $errorMessages['paymentdateLength'] = "paymentdate length must be > 0";

  }


     if(count($errorMessages) == 0){
       
      
         $sql="UPDATE `orders` SET `card_id`='$card_id',`paymentId`='$paymentId',`shipdate`='$shipdate',`requireddate`='$requireddate',`shipperId`='$shipperId',`salestax`='$salestax',`paid`='$paid',`paymentdate`='$paymentdate',`delivered`='$delivered',`ordercanceled`='$ordercanceled' WHERE `id`=". $id;

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
   $sql  ="SELECT * FROM `orders` WHERE `id`= $id";
   $op   = mysqli_query($conn,$sql);
   $FData = mysqli_fetch_assoc($op);

//fetch paymentmethod
  $sql2 = "SELECT * FROM paymentmethod";
  $op2  = mysqli_query($conn,$sql2);
//fetch ordershipper
  $sql3 = "SELECT * FROM `ordershipper`";
  $op3  = mysqli_query($conn,$sql3);
//fetch address from customers join addtocard
 $sql5= "SELECT `customers`.* ,`users`.`firstName` FROM `customers` join `addtocard` on `customers`.`id` =`addtocard`.`customerId` join `users` on `customers`.`usersid`=`users`.`id`";
  $op5 = mysqli_query($conn,$sql5);
  

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
                        
                        <li class="breadcrumb-item active">Add order Data </li>
                        <?php } ?>
                        
                        
                        
                        </ol>

                      

<div class="container">

 <form  method="post"  action="edit.php?id=<?php echo $FData['id'];?>"  enctype ="multipart/form-data">
  
                <div class="form-group">
                     <label for="exampleInputEmail1">Enter ship Date</label>
                     <input type="text" name="shipdate" value="<?php echo $FData['shipdate']; ?>"class="form-control" id="exampleInputName" aria-describedby=""
                         placeholder="Enter shipdate">
                 </div>
                  <div class="form-group">
                     <label for="exampleInputEmail1">Enter Require Date</label>
                     <input type="text" name="requireddate" value="<?php echo $FData['requireddate']; ?>"class="form-control" id="exampleInputName" aria-describedby=""
                         placeholder="Enter requireddate">
                 </div>
                  <div class="form-group">
                     <label for="exampleInputEmail1">Enter SalesTax</label>
                     <input type="text" name="salestax"value="<?php echo $FData['salestax']; ?>" class="form-control" id="exampleInputName" aria-describedby=""
                         placeholder="Enter salestax">
                 </div>
                  <div class="form-group">
                     <label for="exampleInputEmail1">Enter paid status</label>
                     <input type="text" name="paid"value="<?php echo $FData['paid']; ?>" class="form-control" id="exampleInputName" aria-describedby=""
                         placeholder="Enter paid">
                 </div>
                  <div class="form-group">
                     <label for="exampleInputEmail1">Enter paymentdate</label>
                     <input type="text" name="paymentdate"value="<?php echo $FData['paymentdate']; ?>" class="form-control" id="exampleInputName" aria-describedby=""
                         placeholder="Enter paymentdate">
                 </div>
                  <div class="form-group">
                     <label for="exampleInputEmail1">Enter 	delivered status</label>
                     <input type="text" name="delivered" value="<?php echo $FData['delivered']; ?>"class="form-control" id="exampleInputName" aria-describedby=""
                         placeholder="Enter	delivered Status">
                 </div>
                  <div class="form-group">
                     <label for="exampleInputEmail1">Enter 	ordercanceled Status</label>
                     <input type="text" name="ordercanceled"value="<?php echo $FData['ordercanceled']; ?>" class="form-control" id="exampleInputName" aria-describedby=""
                         placeholder="Enter	ordercanceled">
                 </div>

               

                     <div class="form-group">
                            <label for="exampleInput"> Payment Method</label>
                            <select name="paymentId" class="form-control"> 
                                 <?php 
                                     while($data1 = mysqli_fetch_assoc($op2)){
                                  ?>
                              <option value="<?php echo $data1['id'];?>"    <?php if($data1['id'] == $FData['paymentId'] ){ echo 'selected';}?>    >
                              <?php echo $data1['paymentType'];?></option>
                                   <?php } ?>
                            </select>  
                      </div>
                        <div class="form-group">
                            <label for="exampleInput">  Customer Name</label>
                            <select name="card_id" class="form-control"> 
                                 <?php 
                                     while($data2 = mysqli_fetch_assoc($op5)){
                                  ?>
                              <option value="<?php echo $data2['id'];?>" <?php if($data2['id'] == $FData['card_id'] ){ echo 'selected';}?>    >
                              <?php echo $data2['firstName'];?></option>
                                   <?php } ?>
                            </select>  
                      </div>
                     
                         <div class="form-group">
                         <label for="exampleInput"> shipper company name </label>
                          <select name="shipperId" class="form-control"> 
                                 <?php 
                                    while($data = mysqli_fetch_assoc($op3)){
                                 ?>
                           <option value="<?php echo $data['id'];?>" <?php if($data2['id'] == $FData['shipperId'] ){ echo 'selected';}?>><?php echo $data['companyname'];?></option>
                              <?php }?>
                        </select>  
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