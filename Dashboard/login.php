<?php
require "header.php";
  
  include 'helpers/dbconnection.php';



?>
<main style="margin-bottom:10px">

<!-- Login Start -->
  <?php 
  if(!isset($_SESSION['useremail'])){
      echo'
       <div class="login">
            <div class="container-fluid">
                <div class="row">
                  <div class="col-lg-12">
                        <div class="login-form" method="post" action="includes/login.inc.php" enctype="multipart/form-data" >
                            <div class="row">
                                <div class="col-md-6">
                                    <label>E-mail </label>
                                    <input class="form-control" type="text" name="email" placeholder="E-Mail">
                                </div>
                                <div class="col-md-6">
                                    <label>Password</label>
                                    <input class="form-control" type="text" name="password" placeholder="Password">
                                </div>
                                <div class="col-md-12">
                                    <div class="custom-control custom-checkbox">
                                        <input type="checkbox" class="custom-control-input" id="newaccount">
                                        <label class="custom-control-label" for="newaccount">Keep me signed in</label>
                                    </div>
                                </div>
                                <div class="col-md-12">
                                   <input class="btn btn-primary"  name="login-submit" type="submit" value="login" >
                                    
                                </div>
                            </div>
                        </div>
                         <a style="border:1px solid #FF6F61;border-radius:3px;padding:8px" href="signup.php">Sign-Up</a>
                    </div>
                </div>
            </div>
        </div>
        ';}else{
            echo'
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
        </div>';
        }
        ?>
    <!-- Login End -->
       <?php
   if(isset($_SESSION['useremail'])){
       echo '<p">You are Logged in!</p>';
   }else{
       echo '<p style="text-align:center;font-weight:bolder">You are Logged out!</p>';
       
   }
 
?>
    
</main>

<?php

require "footer.php";
?>