<?php
include '../header.php';
include '../helpers/functions.php';
include '../helpers/checkLogin.php';
include '../helpers/checkPrem.php';
include '../helpers/dbconnection.php';

//fetch customers 
  $sql2 = "SELECT `customers`.* ,`users`.`firstName`,`users`.`lastName` FROM `customers` join `users` on `customers`.`usersid` =`users`.`id`";
  $op2  = mysqli_query($conn,$sql2);
//fetch productdetails
  $sql3 = "SELECT `productdetails`.* ,`product`.`productname` FROM `productdetails` join `product` on `productdetails`.`product_Id` =`product`.`id` ";
  $op3  = mysqli_query($conn,$sql3);

if($_SERVER['REQUEST_METHOD']=='POST'){

   
      
      $productid =CleanInputs(Sanitize($_POST["productid"],1));  
      $quantity =CleanInputs(Sanitize($_POST["quantity"],1));  
      $customerid =CleanInputs(Sanitize($_POST["customerid"],1));
      $addtocard=CleanInputs(Sanitize($_POST["addtocard"],2));  
    

  $errorMessages=array();
  //validate add to card
   if(!Validator($addtocard,1)){
      $errorMessages['addtocard']="addtocard field Required";
   }
    
  if(!Validator($addtocard,2,1)){
    $errorMessages['addtocardLength'] = "addtocard length must be > 4 ";

  }
 
  //Validate product  Id 
   if(!Validator($productid,1)){
      $errorMessages['productId']="product Id  field Required";
   }
   if(!Validator($productid,3)){
      $errorMessages['productId']="product  Id  must be Integer Number";
   }
 //Validate customers Id 
   if(!Validator($customerid,1)){
      $errorMessages['customerId']="customer Id  field Required";
   }
   if(!Validator($customerid,3)){
      $errorMessages['customerId']="customer Id  must be Integer Number";
   }
 //Validate  quantity
   if(!Validator($quantity,1)){
      $errorMessages['quantity']="quantity  field Required";
   }
   if(!Validator($quantity,3)){
      $errorMessages['quantity']="quantity  must be Integer Number";
   }

  
 if(count($errorMessages) > 0){
    $_SESSION['errors']=$errorMessages;

 }else{
       $sql4 =  "INSERT INTO `whishlist`( `productid`, `quantity`, `customerid`, `addtocard`) VALUES ('$productid','$quantity','$customerid','$addtocard')";


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
                       <li class="breadcrumb-item active"> Add New whishlist</li>
                                    <?php  }?>
                    </ol>
                <div class="container">
           
                      <form method="post" action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']);?>"
                 enctype="multipart/form-data">

                 <div class="form-group">
                         <label for="exampleInput"> Product Name </label>
                          <select name="productid" class="form-control"> 
                                 <?php 
                                    while($data = mysqli_fetch_assoc($op3)){
                                 ?>
                           <option value="<?php echo $data['id'];?>"><?php echo $data['productname'];?></option>
                              <?php } ?>
                        </select>  
                    </div>
                
                      <div class="form-group">
                         <label for="exampleInput"> Customer Name </label>
                          <select name="customerid" class="form-control"> 
                                 <?php 
                                    while($data = mysqli_fetch_assoc($op2)){
                                 ?>
                           <option value="<?php echo $data['id'];?>"><?php echo $data['firstName'].' '.$data['lastName'];?></option>
                              <?php } ?>
                        </select>  
                    </div>

                 <div class="form-group">
                     <label for="exampleInputEmail1">Enter Product quantity</label>
                     <input type="text" name="quantity" class="form-control" id="exampleInputName" aria-describedby=""
                         placeholder="Enter product quantity ">
                  </div>

                    

                 <div class="form-group">
                     <label for="exampleInputEmail1">Enter Add To Card Or Not </label>
                     <input type="text" name="addtocard" class="form-control" id="exampleInputName" aria-describedby=""
                         placeholder="Enter Add To Card Or Not ">
                  </div>

                 <button type="submit" class="btn btn-primary">Create Whishlist</button>
               </form>
                </div>

                </div>
            </main>
 <?php
include '../footer.php';
 ?>