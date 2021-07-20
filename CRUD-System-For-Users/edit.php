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
     $Password =CleanInputs($_POST["password"]);  
     $GroupId =CleanInputs($_POST["group_id"]);  
   
    
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
    // Password Validation ... 
        if(!empty($Password)){
            if(strlen($Password) < 6){

               $errorMessages['Password'] = "Password Length must be > 5 "; 
            }

        }else{

          $errorMessages['Password'] = " your Password Required";

        }
     
 
    
     //print the result 
     
     if(count($errorMessages) == 0){
      
        $sql = "UPDATE users SET firstName='$FirstName',lastName='$LastName',email='$Email',password='$password',group_id='$GroupId' where id=".$id;
        $op = mysqli_query($conn,$sql);
        if($op){
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
  $sql = "SELECT * FROM users where id= $id";
  $op = mysqli_query($conn,$sql);
  $data = mysqli_fetch_assoc($op);   
                    
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
            
             <form method="post" action="edit.php?id=<?php echo $data['id'];?>"
                 enctype="multipart/form-data">

                 <div class="form-group">
                     <label for="exampleInputEmail1">Enter Your First Name</label>
                     <input type="text" name="firstName"  value="<?php echo $data['firstName']; ?>"class="form-control" id="exampleInputName" aria-describedby=""
                         placeholder="Enter your first name ">
                 </div>

                 <div class="form-group">
                     <label for="exampleInputEmail1">Enter Your Last Name</label>
                     <input type="text" name="lastName"  value="<?php echo $data['lastName']; ?>"class="form-control" id="exampleInputName" aria-describedby=""
                         placeholder="Enter your last name ">
                  </div>

                  <div class="form-group">
                     <label for="exampleInputEmail1">Enter your Email</label>
                     <input type="email" name="email"  value="<?php echo $data['email']; ?>"class="form-control" id="exampleInputEmail1"
                         aria-describedby="emailHelp" placeholder="Enter email">
                 </div>
                  
                  <div class="form-group">
                     <label for="exampleInputPassword1">Enter your Password</label>
                     <input type="password" name="password" value="<?php echo $data['password']; ?>" class="form-control" id="exampleInputPassword1"
                         placeholder="Password">
                 </div>

                     <div class="form-group">
                     <label for="exampleInputEmail1">Enter Your Group ID </label>
                     <input type="text" name="group-id"  value="<?php echo $data['group_id']; ?>"class="form-control" id="exampleInputName" aria-describedby=""
                         placeholder="Enter your group id ">
                  </div>

                
                 

                 <button type="submit" class="btn btn-primary">Update</button>
             </form>
         </div>

     </body>

 </html>