<?php 
    
   include '../helpers/functions.php';
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
       
       $FirstName =CleanInputs($_POST["firstName"]);  
      $LastName =CleanInputs($_POST["lastName"]);  
      $Email =CleanInputs($_POST["email"]); 
      $MobileNo =CleanInputs($_POST["mobileNo"]);   
      $Password =$_POST["password"];  
      $GroupId =Sanitize($_POST["group_id"],1);  
       $id  = Sanitize($_POST['id'],1);

       $errorMessages=array();
    //validate id 
    if(!Validator($id,1)){
      $errorMessages['id']="id  field Required";
   }
      if(!Validator($id,3)){
          $errorMessages['id'] = "Invalid id";
      }
   


  //validate first Name
   if(!Validator($FirstName,1)){
      $errorMessages['firstName']="First Name field Required";
   }
    
  if(!Validator($FirstName,2,2)){
    $errorMessages['firstNameLength'] = "First Name length must be > 4 ";

  }
  //validate last Name
    if(!Validator($LastName,1)){
      $errorMessages['lastName']="last Name field Required";
   }
    
  if(!Validator($LastName,2,2)){
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
       
      
         $sql="UPDATE `users` SET `firstName`='$FirstName',`lastName`='$LastName',`email`='$Email',`mobileNo`='$MobileNo',`password`='$Password',`group_id`='$GroupId' WHERE id= $id";

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

   # Fetch users
   $sql  ="SELECT * FROM users WHERE id= $id";
   $op   = mysqli_query($conn,$sql);
   $FData = mysqli_fetch_assoc($op);

   //fetch usersgroup
   $sql = "SELECT * FROM usersgroup";
   $op  = mysqli_query($conn,$sql);

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
                        
                        <li class="breadcrumb-item active">Add user </li>
                        <?php } ?>
                        
                        
                        
                        </ol>

                      

<div class="container">

 <form  method="post"  action="edit.php?id=<?php echo $FData['id'];?>"  enctype ="multipart/form-data">
  
 
               <div class="form-group">
                     <label for="exampleInputEmail1">Enter Your First Name</label>
                     <input type="text" name="firstName"  value="<?php echo $FData['firstName']; ?>"class="form-control" id="exampleInputName" aria-describedby=""
                         placeholder="Enter your first name ">
                 </div>

                 <div class="form-group">
                     <label for="exampleInputEmail1">Enter Your Last Name</label>
                     <input type="text" name="lastName"  value="<?php echo $FData['lastName']; ?>"class="form-control" id="exampleInputName" aria-describedby=""
                         placeholder="Enter your last name ">
                  </div>

                  <div class="form-group">
                     <label for="exampleInputEmail1">Enter your Email</label>
                     <input type="email" name="email"  value="<?php echo $FData['email']; ?>"class="form-control" id="exampleInputEmail1"
                         aria-describedby="emailHelp" placeholder="Enter email">
                 </div>

                  <div class="form-group">
                     <label >Enter your Mobile No</label>
                     <input type="number" name="mobileNo" value="<?php echo $FData['mobileNo']; ?>" class="form-control" 
                         placeholder="mobile No">
                 </div>

                  <div class="form-group">
                     <label for="exampleInputPassword1">Enter your Password</label>
                     <input type="password" name="password" value="<?php echo $FData['password']; ?>" class="form-control" id="exampleInputPassword1"
                         placeholder="Password">
                 </div>

                     <div class="form-group">
                            <label for="exampleInput"> Group  </label>
                            <select name="group_id" class="form-control"> 
                                 <?php 
                                     while($data = mysqli_fetch_assoc($op)){
                                  ?>
                              <option value="<?php echo $data['id'];?>"    <?php if($data['id'] == $FData['group_id'] ){ echo 'selected';}?>    >
                              <?php echo $data['Group'];?></option>
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