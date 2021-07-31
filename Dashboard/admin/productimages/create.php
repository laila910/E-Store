<?php
include '../helpers/functions.php';
include '../helpers/checkLogin.php';
include '../helpers/checkPrem.php';
include '../helpers/dbconnection.php';
include '../header.php';



$sql1 = "SELECT `product`.`productname` ,`productdetails`.* from `productdetails` join `product` on `productdetails`.`product_Id` = `product`.`id`";

  $op1  = mysqli_query($conn,$sql1);

if($_SERVER['REQUEST_METHOD']=='POST'){

     
        $productId = CleanInputs(Sanitize($_POST["product_id"],1)); 
        $count = count($_FILES['uploadedFile']['name']);
     
    

  $errorMessages=array();
  
 //Validate product  Id 
   if(!Validator($productId,1)){
      $errorMessages['productId']="product  Id  field Required";
   }
   if(!Validator($productId,3)){
      $errorMessages['productId']="product Id  must be Integer Number";
   }
// validation Image 
 if($count > 0 ){
   $FinalName =array();
   for ($i=0; $i < $count ; $i++) { 
      $tmp_path = $_FILES['uploadedFile']['tmp_name'][$i];
      $name     = $_FILES['uploadedFile']['name'][$i];
       $nameArray = explode('.',$name);
       $FileExtension = strtolower($nameArray[1]);

     $FinalName[$i] = rand().time().'.'.$FileExtension;

      $allowedExtension = ['png','jpg','jpeg'];    


       if(in_array($FileExtension,$allowedExtension)){
        // code ....
      
        $disFolder = './uploads/';
        
        $disPath  = $disFolder.$FinalName[$i];

         if(!move_uploaded_file($tmp_path,$disPath))
           {
               $errorMessages['error'] =  'Error In upload try again';
           }

       }else{
        $errorMessages['error'] =  ' extension not allowed';
       }

    
      }
       

    }else{
      $errorMessages['error'] =  '  please  Upload Product Images';
    }


//end of validations

 if(count($errorMessages) > 0){
    $_SESSION['errors']=$errorMessages;

 }else{

 
    
    
       $sql =  "INSERT INTO `productimges`(`product_id`, `firstimage`, `secondimage`, `thirdimage`) VALUES ('$productId ','$FinalName[0]','$FinalName[1]','$FinalName[2]')";


      $op = mysqli_query($conn,$sql);
     
//      echo mysqli_error($conn);
// exit();
    if($op){

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
                       <li class="breadcrumb-item active"> Add  Product Images</li>
                                    <?php  }?>
                    </ol>
                <div class="container">
           
                      <form method="post" action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']);?>"
                 enctype="multipart/form-data">

                  <div class="form-group">
                         <label for="exampleInput"> Product Name </label>
                          <select name="product_id" class="form-control"> 
                                 <?php 
                                    while($data = mysqli_fetch_assoc($op1)){
                                 ?>
                           <option value="<?php echo $data['id'];?>"><?php echo $data['productname'];?></option>
                              <?php } ?>
                        </select>  
                    </div>


                 <div class="form-group">
                      <label for="exampleInputPassword1"> Uploade Images</label>
                      <input type="file"  name="uploadedFile[]"  multiple="multiple">
                 </div>
 
                

                 <button type="submit" class="btn btn-primary">Add Images</button>
               </form>
                </div>

                </div>
            </main>
 <?php
include '../footer.php';
 ?>