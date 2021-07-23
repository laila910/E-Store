 <?php 

  require "../dbconnection.php";
  $errorMessages=array(); //associative array to carry the errors during check the validation 

  $id =$_GET['id'];

  
  
function CleanInputs($input)
{ 
    $input=trim($input);
    $input=stripcslashes($input);
    $input=htmlspecialchars($input);
    return $input; 
}

 if($_SERVER['REQUEST_METHOD']=="POST"){
     
     $FirstName =CleanInputs($_POST["firstName"]);  
     $LastName =CleanInputs($_POST["lastName"]);  
     $Email =CleanInputs($_POST["email"]);  
     $MobileNo =CleanInputs($_POST["mobileNo"]);  
     $Password =CleanInputs($_POST["password"]);  
     
     $GroupId =CleanInputs($_POST["group_id"]);  
   
     $Group =CleanInputs($_POST["Group"]);  
   
    
     // Name Validation ...
        if(!empty($FirstName)){
           if(strlen($FirstName) < 3){
              $errorMessages['firstName'] = "Name Length must be > 2 "; 
             }
        }else{
          $errorMessages['firstName'] = " your Name is Required!";
        }

       if(!empty($LastName)){
           if(strlen($LastName) < 3){
              $errorMessages['lastName'] = "Name Length must be > 2 "; 
             }
        }else{
          $errorMessages['lastName'] = " your Name is Required!";
        }
     //check the email
       if(!empty($Email)){
        
            if(!filter_var($Email,FILTER_VALIDATE_EMAIL)){
                 $s_email = filter_var($Email,FILTER_SANITIZE_EMAIL);
                   if(!filter_var($s_email,FILTER_VALIDATE_EMAIL)){
                        $errorMessages['email'] = 'error your Email is not valid! ';
              
                    }
        
             }
        }else{
                  $errorMessages['email'] = 'error Email Required!';
            }
    //check the MobileNo
       if(!empty($MobileNo)){
         if(!filter_var($MobileNo, FILTER_VALIDATE_INT)){
                $errorMessages['mobileNo'] = 'error your MobileNo is not valid! ';
               }
       }
        else{
                  $errorMessages['mobileNo'] = 'error MobileNo Required!';
            }
    // Password Validation ... 
        if(!empty($Password)){
            if(strlen($Password) < 6){

               $errorMessages['password'] = "Password Length must be > 5 "; 
            }

        }else{

          $errorMessages['password'] = " your Password Required";

        }
      //check the GroupId
       if(!empty($GroupId)){
        
            if(!filter_var($GroupId, FILTER_VALIDATE_INT)){
               
                        $errorMessages['group_id'] = 'error your group ID is not valid! ';
              
                   } }else{
                  $errorMessages['group_id'] = 'error group ID Required!';
            }
 
 
    
     //print the result 
     
     if(count($errorMessages) == 0){
      
        $sql1= "UPDATE users SET firstName='$FirstName',lastName='$LastName',email='$Email',mobileNo= $MobileNo,password='$Password',group_id='$GroupId' where userid=".$id;
        $op1 = mysqli_query($conn,$sql1);
        if($op1){
              echo"the row is updated ";
               header("Location: index.php");
        }else{
            echo"Error in Update please Try again";
        }
         $sql2 = "UPDATE usersgroup SET Group='$Group' where id=".$id;
        $op2 = mysqli_query($conn,$sql2);
        if($op2){
              echo"the row is updated ";
               header("Location: index.php");
        }else{
            echo"Error in Update please Try again";
        }
        
     }else{

     // print error messages 
     foreach($errorMessages as $key => $value){

        echo '* '.$key.' : '.$value.'<br>';
     }


    }

}
 //select the row to edit 
  $sql1 = "SELECT * FROM users where userid= $id";
  $op1 = mysqli_query($conn,$sql1);
  $data1 = mysqli_fetch_assoc($op1);   

  $sql2 = "SELECT * FROM usersgroup where id= $id";
  $op2= mysqli_query($conn,$sql2);
  $data2 = mysqli_fetch_assoc($op2);   
   

                    
  ?>
 <!DOCTYPE html>
 <html lang="en">

     <head>
         <title>register </title>
         <meta charset="utf-8">
         <meta name="viewport" content="width=device-width, initial-scale=1">
         <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">
         <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
         <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>
     </head>

     <body>

         <div class="container">
            
             <form method="post" action="edit.php?id=<?php echo $data1['userid'];?>"
                 enctype="multipart/form-data">

                 <div class="form-group">
                     <label for="exampleInputEmail1">Enter Your First Name</label>
                     <input type="text" name="firstName"  value="<?php echo $data1['firstName']; ?>"class="form-control" id="exampleInputName" aria-describedby=""
                         placeholder="Enter your first name ">
                 </div>

                 <div class="form-group">
                     <label for="exampleInputEmail1">Enter Your Last Name</label>
                     <input type="text" name="lastName"  value="<?php echo $data1['lastName']; ?>"class="form-control" id="exampleInputName" aria-describedby=""
                         placeholder="Enter your last name ">
                  </div>

                  <div class="form-group">
                     <label for="exampleInputEmail1">Enter your Email</label>
                     <input type="email" name="email"  value="<?php echo $data1['email']; ?>"class="form-control" id="exampleInputEmail1"
                         aria-describedby="emailHelp" placeholder="Enter email">
                 </div>

                  <div class="form-group">
                     <label >Enter your Mobile No</label>
                     <input type="number" name="mobileNo" value="<?php echo $data1['mobileNo']; ?>" class="form-control" 
                         placeholder="mobile No">
                 </div>

                  <div class="form-group">
                     <label for="exampleInputPassword1">Enter your Password</label>
                     <input type="password" name="password" value="<?php echo $data1['password']; ?>" class="form-control" id="exampleInputPassword1"
                         placeholder="Password">
                 </div>

                     <div class="form-group">
                     <label for="exampleInputEmail1">Enter Your Group ID </label>
                     <input type="number" name="group_id"  value="<?php echo $data1['group_id']; ?>"class="form-control" id="exampleInputName" aria-describedby=""
                         placeholder="Enter your group id ">
                  </div>
                     <div class="form-group">
                     <label for="exampleInputEmail1">Enter Your Group </label>
                     <input type="text" name="Group"  value="<?php echo $data2['Group']; ?>"class="form-control" id="exampleInputName" aria-describedby=""
                         placeholder="Enter your group ">
                  </div>

                
                 

                 <button type="submit" class="btn btn-primary">Update</button>
             </form>
         </div>

     </body>

 </html>