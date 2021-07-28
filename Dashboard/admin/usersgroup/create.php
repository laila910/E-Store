<?php

include '../helpers/functions.php';
include '../helpers/checkLogin.php';
include '../helpers/checkPrem.php';
include '../helpers/dbconnection.php';
include '../header.php';


if($_SERVER['REQUEST_METHOD']=='POST'){

  $Group =CleanInputs($_POST['Group']);
  $errorMessages=array();
   if(!Validator($Group,1)){
      $errorMessages['Group']="Group field Required";
   }
    
  if(!Validator($Group,2,4)){
    $errorMessages['GroupLength'] = "Group length must be > 4 ";

  }
  
 if(count($errorMessages) == 0){
       $sql = "INSERT INTO `usersgroup`( `Group`) VALUES ('$Group')";

    $op  = mysqli_query($conn,$sql);
echo mysqli_error($conn);
    if($op){

        $errorMessages['Result'] = "Data inserted.";
        $_SESSION['errors'] = $errorMessages;
    }else{
        $errorMessages['Result']  = "Error Try Again.";
     
        $_SESSION['errors'] = $errorMessages;


     }
   
      
     }else{
      

   $_SESSION['errors']=$errorMessages;

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
                       <li class="breadcrumb-item active"> Add New Group</li>
                                    <?php  }?>
                    </ol>
                <div class="container">
           
                    <form method="post" action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']);?>"
                          enctype="multipart/form-data">

                      <div class="form-group">
                        <label for="exampleInputEmail1">Enter Group </label>
                        <input type="text" name="Group" class="form-control" id="exampleInputName" aria-describedby=""
                         placeholder="Group ">
                      </div>
                      <button type="submit"name="submit" class="btn btn-primary">Add</button>
                    </form>
                </div>

                </div>
            </main>
 <?php
include '../footer.php';
 ?>