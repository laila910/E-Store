<?php
include '../header.php';
include '../helpers/functions.php';
include '../helpers/dbconnection.php';


if($_SERVER['REQUEST_METHOD']=='POST'){

    $FirstName =CleanInputs($_POST["firstName"]);  
     $LastName =CleanInputs($_POST["lastName"]);  
     $Email =CleanInputs($_POST["email"]); 
      $MobileNo =CleanInputs($_POST["mobileNo"]);   
     $Password =CleanInputs($_POST["password"]);  
      $GroupId =CleanInputs($_POST["group_id"]);  

  $errorMessages=array();
  //validate first Name
   if(!Validator($FirstName,1)){
      $errorMessages['firstName']="First Name field Required";
   }
    
  if(!Validator($FirstName,2,4)){
    $errorMessages['firstNameLength'] = "First Name length must be > 4 ";

  }
  //validate last Name
    if(!Validator($LastName,1)){
      $errorMessages['lastName']="last Name field Required";
   }
    
  if(!Validator($LastName,2,4)){
    $errorMessages['lastNameLength'] = "Last Name length must be > 4 ";

  }
  //validate email
   if(! Validator($Email,1)){
         $errorMessages['email'] = 'error Email Required!';
           
        }else{
                 
            if(!Validator($Email,4)){
                 $s_email = Sanitize($Email,1);
                   if(!Validator($s_email,4)){
                        $errorMessages['email'] = 'error your Email is not valid! ';
            
                    }
             }
            }
          
//MobileNo
 if(!Validator($MobileNo,1)){
      $errorMessages['mobileNo']="MobileNo field Required";
   }
    
  if(!Validator($MobileNo,2,11)){
    $errorMessages['mobileNo'] = "MobileNo length must be > 11 ";

  }
  //Validate password
 if(!Validator($Password,1)){
      $errorMessages['password']="password field Required";
   }
    
  if(!Validator($Password,2,6)){
    $errorMessages['mobileNo'] = "password length must be > 6 ";

  }

  //Validate Group Id
   if(!Validator($GroupId,1)){
      $errorMessages['GroupId']="Group Id  field Required";
   }
   if(!Validator($GroupId,3)){
      $errorMessages['GroupId']="Group Id  must be Integer Number";
   }




 if(count($errorMessages) == 0){
       $sql =  "INSERT INTO users(firstName,lastName,email,mobileNo,password,group_id) VALUES ('$FirstName','$LastName','$Email','$MobileNo','$Password','$GroupId')";

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
                                          echo mysqli_error($conn);
                            ?>
                       <li class="breadcrumb-item active"> Add New Group</li>
                                    <?php  }?>
                    </ol>
                <div class="container">
           
                      <form method="post" action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']);?>"
                 enctype="multipart/form-data">

                  <div class="form-group">
                     <label for="exampleInputEmail1">Enter Your First Name</label>
                     <input type="text" name="firstName" class="form-control" id="exampleInputName" aria-describedby=""
                         placeholder="Enter your first name ">
                 </div>

                 <div class="form-group">
                     <label for="exampleInputEmail1">Enter Your Last Name</label>
                     <input type="text" name="lastName" class="form-control" id="exampleInputName" aria-describedby=""
                         placeholder="Enter your last name ">
                  </div>

                  <div class="form-group">
                     <label for="exampleInputEmail1">Enter your Email</label>
                     <input type="email" name="email" class="form-control" id="exampleInputEmail1"
                         aria-describedby="emailHelp" placeholder="Enter email">
                 </div>
                  
                  <div class="form-group">
                     <label>Enter your Mobile No</label>
                     <input type="number" name="mobileNo" class="form-control" 
                         placeholder="mobile No">
                 </div>

                  <div class="form-group">
                     <label >Enter your Password</label>
                     <input type="password" name="password"  class="form-control"
                         placeholder="Password">
                 </div>
                 
                     <div class="form-group">
                     <label for="exampleInputEmail1">Enter Your Group ID </label>
                     <input type="number" name="group_id" class="form-control" id="exampleInputName" aria-describedby=""
                         placeholder="Enter your group id ">
                  </div>


                 <button type="submit" class="btn btn-primary">Create User</button>
               </form>
                </div>

                </div>
            </main>
 <?php
include '../footer.php';
 ?>