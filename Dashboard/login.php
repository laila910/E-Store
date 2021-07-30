<?php

  


include './helpers/functions.php';


include './helpers/dbconnection.php';

include 'header.php';

include 'navbar.php';

if($_SERVER['REQUEST_METHOD'] == "POST"){
 
  $Email= CleanInputs($_POST['email']);
  $password=$_POST['password'];

   $errorMessages = [];
  //validate Email
  if(!Validator($email,1)){
   
         $errorMessages['emailRequired'] = "Email field Required";
      }

     if(!Validator($email,4)){

        $errorMessages['email'] = "Invalid Email";
     }      

  //validate Password   
     if(!Validator($password,1)){
   
        $errorMessages['passwordRequired'] = "Password field Required";
     }


     if(!Validator($password,2)){
   
        $errorMessages['passwordLength'] = "Password length must be >= 6";
     }
if(count($errorMessages) == 0 ){

    
        // $password = sha1($password);  
        $sql = "SELECT * FROM `users` where `email` ='$email' and `password` = '$password'";
        
        $op  =  mysqli_query($conn,$sql);

      

        if(mysqli_num_rows($op) == 1){
        
         $data = mysqli_fetch_assoc($op);

         $_SESSION['User'] = $data;

         header("Location: index.php");
        }else{
            $errorMessages['messages'] = "Error in Login Try Again!!!";
        }

        

      }

if(count($errorMessages) > 0){

        $_SESSION['errors'] = $errorMessages;
           if(isset($_SESSION['errors'])){
                                   
            foreach($_SESSION['errors'] as $data){

                echo '* '.$data.'<br>';
            }
                   unset($_SESSION['errors']);
                                          
            }
      

    }

        }
          
// echo mysqli_connect_error($conn);
//       exit();


?>
 


        
       


<!-- Login Start -->
  <?php 
  if(!isset($_SESSION['User'])){ ?>
    
      
       <div class="login">
            <div class="container-fluid">
                <div class="row">
                
                  <div class="col-lg-6">
                        <div class="login-form" method="post" action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']);?>">
                            <div class="row">
                                <div class="col-md-6">
                                    <label>E-mail </label>
                                    <input class="form-control" type="email" name="email" placeholder="E-Mail">
                                </div>
                                <div class="col-md-6">
                                    <label>Password</label>
                                    <input class="form-control" type="password" name="password" placeholder="Password">
                                </div>
                                <div class="col-md-12">
                                    <div class="custom-control custom-checkbox">
                                        <input type="checkbox" class="custom-control-input" id="newaccount">
                                        <label class="custom-control-label" for="newaccount">Keep me signed in</label>
                                    </div>
                                </div>
                                <div class="col-md-12">
                                   <input class="btn btn-primary" type="submit" value="login" >
                                    
                                </div>
                            </div>
                        </div>
                       
                    </div>
                    <div class="col-lg-6">    
                        <div class="register-form" method="post" action="includes/signup.inc.php">
                            <div class="row">
                                <div class="col-md-6">
                                    <label>First Name</label>
                                    <input name="firstName" class="form-control" type="text" placeholder="First Name">
                                </div>
                                <div class="col-md-6">
                                    <label>Last Name"</label>
                                    <input class="form-control" name="lastName" type="text" placeholder="Last Name">
                                </div>
                                <div class="col-md-6">
                                    <label>E-mail</label>
                                    <input class="form-control" name="email"type="text" placeholder="E-mail">
                                </div>
                                <div class="col-md-6">
                                    <label>Mobile No</label>
                                    <input class="form-control" name="mobileNo" type="text" placeholder="Mobile No">
                                </div>
                                <div class="col-md-6">
                                    <label>Password</label>
                                    <input class="form-control" name="password"type="text" placeholder="Password">
                                </div>
                                <div class="col-md-6">
                                    <label>Retype Password</label>
                                    <input class="form-control" name="Repeat-password"type="text" placeholder="Password">
                                </div>
                                <div class="col-md-12">
                                    <button class="btn">Submit</button>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

            </div>
        </div>
        <?php }else{ ?>
            
           <div class="login">
            <div class="container-fluid">
                <div class="row">
                  <div class="col-lg-12">
                        <div class="login-form" method="post" action="includes/logout.php" enctype="multipart/form-data" >
                            <div class="row">
                              <div class="col-md-12">
                                    <button type="button" class="btn " name="logout-submit" >LogOut</button>
                                </div>
                            </div>
                        </div>
                        
                    </div>
                </div>
            </div>
        </div>
       <?php }
        ?>
    <!-- Login End -->


    

