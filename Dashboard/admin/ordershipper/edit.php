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
       
      $userid =CleanInputs(Sanitize($_POST["userid"],1));  
      $companyname =CleanInputs(Sanitize($_POST["companyname"],2));
      $ShippingMethod=CleanInputs(Sanitize($_POST["ShippingMethod"],2));  
     
       $id  = CleanInputs(Sanitize($_POST['id'],1));
      

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
 
 //Validate ordershipper Id 
  if(!Validator($id,1)){
      $errorMessages['ordershipperid']=" ordershipper id  field Required";
   }
      if(!Validator($id,3)){
          $errorMessages['ordershipperid'] = "  ordershipper id must be integer number ";
      }
   

     if(count($errorMessages) == 0){
       
      
         $sql="UPDATE `ordershipper` SET `userid`='$userid',`companyname`='$companyname',`ShippingMethod`='$ShippingMethod' WHERE `id`=". $id;

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

   # Fetch ordershipper
   $sql  ="SELECT * FROM `ordershipper` WHERE `id`= $id";
   $op   = mysqli_query($conn,$sql);
   $FData = mysqli_fetch_assoc($op);

   //fetch users
   $sql1 = "SELECT * FROM users";
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
                        
                        <li class="breadcrumb-item active">Edit shipper data</li>
                        <?php } ?>
                        
                        
                        
                        </ol>

                      

<div class="container">

 <form  method="post"  action="edit.php?id=<?php echo $FData['id'];?>"  enctype ="multipart/form-data">
               
                  <div class="form-group">
                         <label for="exampleInput">shipper Name</label>
                          <select name="userid" class="form-control"> 
                                 <?php 
                                    while($data = mysqli_fetch_assoc($op1)){
                                 ?>
                           <option value="<?php echo $data['id'];?>"  <?php if($data['id'] == $FData['userid'] ){ echo 'selected';}?>     >
                           <?php echo $data['firstName'];?></option>
                              <?php } ?>
                        </select>  
                    </div>

                  <div class="form-group">
                     <label for="exampleInputEmail1">Enter shipper company </label>
                     <input type="text" name="companyname" value="<?php echo $FData['companyname']; ?>" class="form-control" id="exampleInputName" aria-describedby=""
                         placeholder="Enter company name ">
                 </div>

                 <div class="form-group">
                     <label for="exampleInputEmail1">Enter Shipping Method</label>
                     <input type="text" name="ShippingMethod" value="<?php echo $FData['ShippingMethod']; ?>"class="form-control" id="exampleInputName" aria-describedby=""
                         placeholder="Enter ShippingMethod ">
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