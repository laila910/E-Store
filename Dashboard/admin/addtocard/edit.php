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
       
        $customerId=CleanInputs(Sanitize($_POST["customerId"],1));  
      $carditem =CleanInputs(Sanitize($_POST["carditem"],1));  
       $quantity=CleanInputs(Sanitize($_POST["quantity"],1));  
     
         $session =CleanInputs(Sanitize($_POST["session"],2));    
       $id  = CleanInputs(Sanitize($_POST['id'],1));
      

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

//Validate  Id 
   if(!Validator($id,1)){
      $errorMessages['id']="id  field Required";
   }
   if(!Validator($id,3)){
      $errorMessages['id']="id  must be Integer Number";
   }
 

     if(count($errorMessages) == 0){
       
      
         $sql="UPDATE `addtocard` SET `customerId`='$customerId',`carditem`='$carditem',`quantity`='$quantity',`session`='$session', WHERE `id`=$id";

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
   $sql  ="SELECT * FROM `addtocard` WHERE `id`= $id";
   $op   = mysqli_query($conn,$sql);
   $FData = mysqli_fetch_assoc($op);

   //fetch product name
   $sql1 = "SELECT `productdetails`.*,`product`.`productname` FROM `productdetails` join `product` on `productdetails`.`product_Id`=`product`.`id`";
   $op1  = mysqli_query($conn,$sql1);

   //fetch firstname
   $sql2 = "SELECT `customers`.*,`users`.`firstName` FROM `customers` join `users` on `customers`.`usersid`=`users`.`id`";
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
                        
                        <li class="breadcrumb-item active">Edit card </li>
                        <?php } ?>
                        
                        
                        
                        </ol>

                      

<div class="container">

 <form  method="post"  action="edit.php?id=<?php echo $FData['id'];?>"  enctype ="multipart/form-data">
  
 
               <div class="form-group">
                     <label for="exampleInputEmail1">Enter session to order </label>
                     <input type="text" name="session"  value="<?php echo $FData['session']; ?>"class="form-control" id="exampleInputName" aria-describedby=""
                         placeholder="Enter session ">
                 </div>

                 <div class="form-group">
                     <label for="exampleInputEmail1">Enter Product quantity</label>
                     <input type="text" name="quantity"  value="<?php echo $FData['quantity']; ?>"class="form-control" id="exampleInputName" aria-describedby=""
                         placeholder="Enter Product quantity">
                  </div>

                     <div class="form-group">
                            <label for="exampleInput"> Product Name</label>
                            <select name="carditem" class="form-control"> 
                                 <?php 
                                     while($data1 = mysqli_fetch_assoc($op1)){
                                  ?>
                              <option value="<?php echo $data1['id'];?>"    <?php if($data1['id'] == $FData['carditem'] ){ echo 'selected';}?>    >
                              <?php echo $data1['productname'];?></option>
                                   <?php } ?>
                            </select>  
                      </div>
                        <div class="form-group">
                            <label for="exampleInput">Customer Id</label>
                            <select name="customerId" class="form-control"> 
                                 <?php 
                                     while($data2 = mysqli_fetch_assoc($op2)){
                                  ?>
                              <option value="<?php echo $data2['id'];?>" <?php if($data2['id'] == $FData['customerId'] ){ echo 'selected';}?>    >
                              <?php echo $data2['firstName'];?></option>
                                   <?php } ?>
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