<?php
include '../header.php';
include '../helpers/functions.php';
include '../helpers/dbconnection.php';


  

if($_SERVER['REQUEST_METHOD']=='POST'){

    
      $usersid =CleanInputs(Sanitize($_POST["usersid"],1));  
    
    

  $errorMessages=array();
 
 //Validate Admin Id 
   if(!Validator($usersid,1)){
      $errorMessages['usersId']="users Id  field Required";
   }
   if(!Validator($usersid,3)){
      $errorMessages['usersId']="users Id  must be Integer Number";
   }

 if(count($errorMessages) > 0){
    $_SESSION['errors']=$errorMessages;

 }else{
       $sql4=  "INSERT INTO `admin`(`usersid`) VALUES ('$usersid')";


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

//fetch users
  $sql2 = "SELECT * FROM users";
  $op2  = mysqli_query($conn,$sql2);






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
                       <li class="breadcrumb-item active"> Add Admin</li>
                                    <?php  }?>
                    </ol>
                <div class="container">
           
                      <form method="post" action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']);?>"
                 enctype="multipart/form-data">

                 
              

                     <div class="form-group">
                         <label for="exampleInput"> Admin Name </label>
                          <select name="usersid" class="form-control"> 
                                 <?php 
                                    while($data = mysqli_fetch_assoc($op2)){
                                 ?>
                           <option value="<?php echo $data['usersid'];?>"><?php echo $data['firstName'];
                           
                           ?></option>
                              <?php 
                              
                               //fetch users
                               
                                 $sql5="SELECT id ,Group from usersgroup where Group LIKE '%Admin%' ";
                                 $op5 =mysqli_query($conn,$sql5);
                                 $data5=mysqli_fetch_assoc($op5);
                                 $num = $data5['id'];
                                 $sql="UPDATE `users`SET `group_id` ='$' where usersid=$usersid";
                                
                            
                            
                            }
                               
                               ?>
                        </select>  
                    </div>

                   
                
                 <button type="submit" class="btn btn-primary">Create Admin</button>
               </form>
                </div>

                </div>
            </main>
 <?php
include '../footer.php';
 ?>