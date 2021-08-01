<?php

    include './help/fun.php';
    include './help/db.php';
    include 'header.php';



    if($_SERVER['REQUEST_METHOD'] == "POST"){

     
      $email    = Clean($_POST['email']);
      $password = $_POST['password'];

      $errorMessages = [];
      # Validate Inputs .... 


      if(!Validate($email,1)){
   
         $errorMessages['emailRequired'] = "Email field Required";
      }

     if(!Validate($email,4)){

        $errorMessages['email'] = "Invalid Email";
     }      

     
     if(!Validate($password,1)){
   
        $errorMessages['passwordRequired'] = "Password field Required";
     }


     if(!Validate($password,2)){
   
        $errorMessages['passwordLength'] = "Password length must be >= 6";
     }



      if(count($errorMessages) == 0 ){

      // Login Lodgic 
        // $password = sha1($password);  
        $sql = "SELECT * FROM `users` where `email` ='$email' and `password` = '$password'";
        
        $op  =  mysqli_query($conn,$sql);


        if(mysqli_num_rows($op) == 1){
        
         $data = mysqli_fetch_assoc($op);

         $_SESSION['users'] = $data;

         header("Location: index.php");
        }else{
            $errorMessages['messages'] = "Error in Login Try Again!!!";
        }

        

      }

        if(count($errorMessages) > 0){

        $_SESSION['errors'] = $errorMessages;

        }
      

    }


 include 'navbar.php'; ?>
        <!-- Login Start -->
        <div class="login">
            <div class="container-fluid">
                <?php 
                                    # Display Error Messages ... 

                                  


                                    if(isset($_SESSION['errors'])){
                                   
                                      foreach($_SESSION['errors'] as $data){

                                        echo '* '.$data.'<br>';
                                      }
                                     unset($_SESSION['errors']);
                                          
                                    }
                                
                                
                                ?>
                
                <div class="row">
                      <div class="col-lg-6">
                     <form action="./includes/signup.inc.php" method="get">
                            <div class="row">
                                <div class="col-md-6">
                                    <label>First Name</label>
                                    <input class="form-control" type="text" placeholder="First Name" name="firstName">
                                </div>
                                <div class="col-md-6">
                                    <label>Last Name"</label>
                                    <input class="form-control" type="text" placeholder="Last Name" name="lastName">
                                </div>
                                <div class="col-md-6">
                                    <label>E-mail</label>
                                    <input class="form-control" type="text" placeholder="E-mail" name="email">
                                </div>
                                <div class="col-md-6">
                                    <label>Mobile No</label>
                                    <input class="form-control" type="text" placeholder="Mobile No" name="mobileNo">
                                </div>
                                <div class="col-md-6">
                                    <label>Password</label>
                                    <input class="form-control" type="text" placeholder="Password" name="password">
                                </div>
                                <div class="col-md-6">
                                    <label>Retype Password</label>
                                    <input class="form-control" type="text" placeholder="Password" name="Repeat-password">
                                </div>
                                <div class="col-md-12">
                                    <button class="btn">Sign-Up</button>
                                </div>
                            </div>
                        </form>
                                </div>
                    <div class="col-lg-6">
                        <form action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']);?>" method="post">
                            <div class="row">
                                <div class="col-md-6">
                                    <label>E-mail </label>
                                    <input class="form-control" type="text" placeholder="E-mail / Username" name="email">
                                </div>
                                <div class="col-md-6">
                                    <label>Password</label>
                                    <input class="form-control" type="text" placeholder="Password" name="password">
                                </div>
                                <div class="col-md-12">
                                    <div class="custom-control custom-checkbox">
                                        <input type="checkbox" class="custom-control-input" id="newaccount">
                                        <label class="custom-control-label" for="newaccount">Keep me signed in</label>
                                    </div>
                                </div>
                                <div class="col-md-12">
                                    <button class="btn">Login</button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>


            </div>
        </div>
        <!-- Login End -->
   <?php include 'footer.php';      

 ?>
