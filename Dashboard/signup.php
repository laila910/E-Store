<?php

  


include 'helpers/functions.php';

include 'helpers/checkLogin.php';
include 'helpers/dbconnection.php';

include 'header.php';

include 'navbar.php';

?>
 
<main>

    <?php 
    if(isset($_GET['error'])){
        if($_GET['error']=="emptyfields"){
            echo'<p> Fill in all fields!</p>';
        }elseif($_GET['error']=="invalidemailfirstNamelastNameMobileNo"){
            echo'<p>Invalid Entered Data </p>';

        }elseif($_GET['error']=="InvalidfirstNamelastName"){
            echo'<p>Invalid Names</p>';

        }elseif($_GET['error']=="InvalidEmail"){
            echo'<p>Invalid E-mail </p>';

        }elseif($_GET['error']=="passwordcheck"){
            echo'<p>Your Passwords are not match!</p>';

        }elseif($_GET['error']=="usertaken"){
            echo'<p>Username is already taken! </p>';

        }
    } elseif(isset($_GET['signup'])){
          if($_GET['signup']=="success"){
           echo'<p>You are sign-up! </p>';
    }}

    ?>

  <!-- Login Start -->
     <div class="login">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-lg-6">    
                        <div class="register-form"  action="includes/signup.inc.php" method="post">
                            <div class="row">
                                <div class="col-md-6">
                                    <label>First Name</label>
                                    <input class="form-control" type="text" name="firstName" placeholder="First Name">
                                </div>
                                <div class="col-md-6">
                                    <label>Last Name"</label>
                                    <input class="form-control" type="text" name="lastName" placeholder="Last Name">
                                </div>
                                <div class="col-md-6">
                                    <label>E-mail</label>
                                    <input class="form-control" type="text" name="email"placeholder="E-mail">
                                </div>
                                <div class="col-md-6">
                                    <label>Mobile No</label>
                                    <input class="form-control" type="text" name="mobileNo" placeholder="Mobile No">
                                </div>
                                <div class="col-md-6">
                                    <label>Password</label>
                                    <input class="form-control" type="text" name="password" placeholder="Password">
                                </div>
                                <div class="col-md-6">
                                    <label>Retype Password</label>
                                    <input class="form-control" type="text"name="Repeat-password" placeholder="Password">
                                </div>
                                <div class="col-md-12">
                                    <button class="btn" name="signup-submit">SignUp</button>
                                </div>
                            </div>
                        </div>
                    </div>

    </main>
    
    <?php
 include 'footer.php';
    ?>