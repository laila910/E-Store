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
       
      $ordernumber=CleanInputs(Sanitize($_POST["ordernumber"],1));  
      $shippingcost =CleanInputs(Sanitize($_POST["shippingcost"],1));  
      $quntity =CleanInputs(Sanitize($_POST["quntity"],1));  
      $discount =CleanInputs(Sanitize($_POST["discount"],1));  
      $totalprice =CleanInputs(Sanitize($_POST["totalprice"],1));
       $id  = CleanInputs(Sanitize($_POST['id'],1));
      

       $errorMessages=array();
 //Validate orderdetails Id
   if(!Validator($id,1)){
      $errorMessages['id']="id field Required";
   }
   if(!Validator($id,3)){
      $errorMessages['id']="id must be Integer Number";
   }
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

     if(count($errorMessages) == 0){
       
      
         $sql="UPDATE `orderdetailes` SET `ordernumber`='$ordernumber',`shippingcost`='$shippingcost',`quntity`='$quntity',`discount`='$discount',`totalprice`='$totalprice' WHERE `id`=". $id;

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
   $sql  =" SELECT `id`, `ordernumber`, `shippingcost`, `quntity`, `discount`, `totalprice` FROM `orderdetailes` WHERE `id`=$id";
   $op   = mysqli_query($conn,$sql);
  
   $FData = mysqli_fetch_assoc($op);
 

   //fetch orders
   $sql1 = "  SELECT * FROM `orders`";
   $op1  = mysqli_query($conn,$sql1);

  
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
                        
                        <li class="breadcrumb-item active">Add orderdetails </li>
                        <?php } ?>
                        
                        
                        
                        </ol>

                      

<div class="container">

 <form  method="post"  action="edit.php?id=<?php echo $FData['id'];?>"  enctype ="multipart/form-data">
  
              <div class="form-group">
                         <label for="exampleInput"> salestax</label>
                          <select name="ordernumber" class="form-control"> 
                                 <?php 
                                    while($data = mysqli_fetch_assoc($op1)){
                                 ?>
                           <option value="<?php echo $data['id'];?>"  ><?php echo $data['salestax'];?></option>
                              <?php } ?>
                        </select>  
                    </div>

                  <div class="form-group">
                     <label for="exampleInputEmail1">Enter shippingcost</label>
                     <input type="text" name="shippingcost"  value="<?php echo $FData['shippingcost']; ?>" class="form-control" id="exampleInputName" aria-describedby=""
                         placeholder="Enter shippingcost ">
                 </div>

                 <div class="form-group">
                     <label for="exampleInputEmail1">Enter quntity</label> <?php //remeber to move this from here to orderstable ?>
                     <input type="text" name="quntity"  value="<?php echo $FData['quntity']; ?>"class="form-control" id="exampleInputName" aria-describedby=""
                         placeholder="Enter quntity">
                  </div>

                  

                 <div class="form-group">
                     <label for="exampleInputEmail1">Enter discount </label>
                     <input type="text" name="discount"  value="<?php echo $FData['discount']; ?>"class="form-control" id="exampleInputName" aria-describedby=""
                         placeholder="Enter discount">
                  </div>

                 <div class="form-group">
                     <label for="exampleInputEmail1">Enter 	totalprice</label>
                     <input type="text" name="totalprice"  value="<?php echo $FData['totalprice']; ?>" class="form-control" id="exampleInputName" aria-describedby=""
                         placeholder="Enter totalprice">
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