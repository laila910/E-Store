<?php
include '../header.php';
include '../helpers/functions.php';
include '../helpers/checkLogin.php';
include '../helpers/checkPrem.php';
include '../helpers/dbconnection.php';



if($_SERVER['REQUEST_METHOD']=='POST'){

     
       
      $Small=CleanInputs(Sanitize($_POST["S"],2));  
      $Medium=CleanInputs(Sanitize($_POST["M"],2));  
     
      $Large=CleanInputs(Sanitize($_POST["L"],2));
      $XLarge=CleanInputs(Sanitize($_POST["XL"],2));
     
    

  $errorMessages=array();
  //validate Small size
   if(!Validator($Small,1)){
      $errorMessages['Smallsize']="Small Size field Required";
   }
    
  if(!Validator($Small,2,0)){
    $errorMessages['SmallsizeLength'] = "Small Size length must be > 0 ";

  }
//validate Medium Size
   if(!Validator($Medium,1)){
      $errorMessages['Mediumsize']="Medium Size field Required";
   }
    
  if(!Validator($Medium,2,0)){
    $errorMessages['MediumsizeLength'] = "Medium Size length must be > 0 ";

  }
//validate Large Size
   if(!Validator($Large,1)){
      $errorMessages['LargeSize']="Large Size field Required";
   }
    
  if(!Validator($Large,2,0)){
    $errorMessages['LargeSizeLength'] = "Large Size length must be > 0";

  }
//validate XLarge Size
   if(!Validator($XLarge,1)){
      $errorMessages['XLargeSize']="XLarge Size field Required";
   }
    
  if(!Validator($XLarge,2,0)){
    $errorMessages['XLargeSizeLength'] = "XLarge Size length must be > 0";

  }

 if(count($errorMessages) > 0){
    $_SESSION['errors']=$errorMessages;

 }else{
       $sql =  "INSERT INTO `productsizes`( `S`, `M`, `L`, `XL`) VALUES ('$Small','$Medium','$Large','$XLarge')";


      $op = mysqli_query($conn,$sql);
     
     
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
                       <li class="breadcrumb-item active"> Add  sizes</li>
                                    <?php  }?>
                    </ol>
                <div class="container">
           
                      <form method="post" action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']);?>"
                 enctype="multipart/form-data">

                 

                  <div class="form-group">
                     <label for="exampleInputEmail1">Enter First Size</label>
                     <input type="text" name="S" class="form-control" id="exampleInputName" aria-describedby=""
                         placeholder="Enter First Size ">
                 </div>

                 <div class="form-group">
                     <label for="exampleInputEmail1">Enter Second Size</label>
                     <input type="text" name="M" class="form-control" id="exampleInputName" aria-describedby=""
                         placeholder="Enter Second Size">
                  </div>

                  <div class="form-group">
                     <label for="exampleInputEmail1">Enter Third Size</label>
                     <input type="text" name="L" class="form-control" id="exampleInputName" aria-describedby=""
                         placeholder="Enter Third Size">
                  </div>
                    <div class="form-group">
                     <label for="exampleInputEmail1">Enter Fourth Size</label>
                     <input type="text" name="XL" class="form-control" id="exampleInputName" aria-describedby=""
                         placeholder="Enter Fourth Size">
                  </div>
                

                 <button type="submit" class="btn btn-primary">Add Sizes</button>
               </form>
                </div>

                </div>
            </main>
 <?php
include '../footer.php';
 ?>