<?php
include '../header.php';
include '../helpers/functions.php';
include '../helpers/checkLogin.php';
include '../helpers/checkPrem.php';
include '../helpers/dbconnection.php';



if($_SERVER['REQUEST_METHOD']=='POST'){

     
       
      $firstcolor=CleanInputs(Sanitize($_POST["firstcolor"],2));  
      $secondcolor=CleanInputs(Sanitize($_POST["secondcolor"],2));  
     
      $thirdcolor=CleanInputs(Sanitize($_POST["thirdcolor"],2));
     
    

  $errorMessages=array();
  //validate First Color
   if(!Validator($firstcolor,1)){
      $errorMessages['firstColor']="First Color field Required";
   }
    
  if(!Validator($firstcolor,2,2)){
    $errorMessages['firstcolorLength'] = "product Name length must be > 2 ";

  }
//validate Second Color
   if(!Validator($secondcolor,1)){
      $errorMessages['secondColor']="Second Color field Required";
   }
    
  if(!Validator($secondcolor,2,2)){
    $errorMessages['secondcolorLength'] = "Second Color length must be > 2 ";

  }
//validate Third Color
   if(!Validator($thirdcolor,1)){
      $errorMessages['thirdColor']="Third Color field Required";
   }
    
  if(!Validator($thirdcolor,2,2)){
    $errorMessages['thirdcolorLength'] = "Third Color length must be > 2 ";

  }

 if(count($errorMessages) > 0){
    $_SESSION['errors']=$errorMessages;

 }else{
       $sql =  "INSERT INTO `productcolor`( `firstcolor`, `secondcolor`, `thirdcolor`) VALUES ('$firstcolor',' $secondcolor','$thirdcolor')";


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
                       <li class="breadcrumb-item active"> Add  Colors</li>
                                    <?php  }?>
                    </ol>
                <div class="container">
           
                      <form method="post" action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']);?>"
                 enctype="multipart/form-data">

                 

                  <div class="form-group">
                     <label for="exampleInputEmail1">Enter First Color</label>
                     <input type="text" name="firstcolor" class="form-control" id="exampleInputName" aria-describedby=""
                         placeholder="Enter First Color ">
                 </div>

                 <div class="form-group">
                     <label for="exampleInputEmail1">Enter Second Color</label>
                     <input type="text" name="secondcolor" class="form-control" id="exampleInputName" aria-describedby=""
                         placeholder="Enter Second Color">
                  </div>

                  <div class="form-group">
                     <label for="exampleInputEmail1">Enter Third Color</label>
                     <input type="text" name="thirdcolor" class="form-control" id="exampleInputName" aria-describedby=""
                         placeholder="Enter Third Color">
                  </div>

                

                 <button type="submit" class="btn btn-primary">Add Colors</button>
               </form>
                </div>

                </div>
            </main>
 <?php
include '../footer.php';
 ?>