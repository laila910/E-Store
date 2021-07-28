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
       
      $productid =CleanInputs(Sanitize($_POST["productid"],1));  
      $quantity =CleanInputs(Sanitize($_POST["quantity"],1));  
      $customerid =CleanInputs(Sanitize($_POST["customerid"],1));
      $addtocard=CleanInputs(Sanitize($_POST["addtocard"],2));    
       $id  = CleanInputs(Sanitize($_POST['id'],1));
      

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

  
 //Validate whishlist  Id 
  if(!Validator($id,1)){
      $errorMessages['productid']="id  field Required";
   }
      if(!Validator($id,3)){
          $errorMessages['productid'] = " id must be integer number ";
      }
   

     if(count($errorMessages) == 0){
       
      
         $sql="UPDATE `whishlist` SET `productid`='$productid',`quantity`='$quantity',`customerid`='$customerid',`addtocard`='$addtocard' WHERE `id`=". $id;

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

   # Fetch whishlist
   $sql  ="SELECT * FROM `whishlist` WHERE `id`= $id";
   $op   = mysqli_query($conn,$sql);
   $FData = mysqli_fetch_assoc($op);

   //fetch productname
   $sql1 = "SELECT `productdetails`.* ,`product`.`productname` FROM `productdetails` join `product` on `productdetails`.`product_Id` =`product`.`id`";
   $op1  = mysqli_query($conn,$sql1);

   //fetch customername
   $sql2 = "SELECT `customers`.*,`users`.`firstName`,`users`.`lastName` FROM `customers` join `users` on `customers`.`usersid`=`users`.`id`";
   $op2 = mysqli_query($conn,$sql2);
    

                 

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
                        
                        <li class="breadcrumb-item active">Edit Whishlist </li>
                        <?php }        
                ?>
                        
                 
                        
                        </ol>

                      

<div class="container">

 <form  method="post"  action="edit.php?id=<?php echo $FData['id'];?>"  enctype ="multipart/form-data">
  
                 <div class="form-group">
                            <label for="exampleInput"> Product Name </label>
                            <select name="productid" class="form-control"> 
                                 <?php 
                                     while($data1 = mysqli_fetch_assoc($op1)){
                                  ?>
                              <option value="<?php echo $data1['product_Id'];?>"    <?php if($data1['id'] == $FData['productid'] ){ echo 'selected';}?>    >
                              <?php echo $data1['productname'];?></option>
                                   <?php } ?>
                            </select>  
                      </div>
                
                     <div class="form-group">
                            <label for="exampleInput">Customer Name</label>
                            <select name="customerid" class="form-control"> 
                                 <?php 
                                     while($data2= mysqli_fetch_assoc($op2)){
                                  ?>
                              <option value="<?php echo $data2['id'];?>"    <?php if($data2['id'] == $FData['customerid'] ){ echo 'selected';}?>    >
                              <?php echo $data2['firstName'];?></option>
                                   <?php } ?>
                            </select>  
                      </div>
               <div class="form-group">
                     <label for="exampleInputEmail1">Enter Product Quantity</label>
                     <input type="text" name="quantity"  value="<?php echo $FData['quantity']; ?>"class="form-control" id="exampleInputName" aria-describedby=""
                         placeholder="Enter product quantity ">
                 </div>

                 <div class="form-group">
                     <label for="exampleInputEmail1">Enter Product add to card or not</label>
                     <input type="text" name="addtocard"  value="<?php echo $FData['addtocard']; ?>"class="form-control" id="exampleInputName" aria-describedby=""
                         placeholder="Enter Product add to card or not">
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