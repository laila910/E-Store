<?php
session_start();
function CleanInputs($input)
{ 
    $input=trim($input);
    $input=stripcslashes($input);
    $input=htmlspecialchars($input);
    return $input; 
}
if(isset($_POST['signup-submit'])){
       require "dbh.inc.php";
       $firstName=mysqli_real_escape_string($conn, CleanInputs($_POST['firstName']));
       $lastName=mysqli_real_escape_string($conn, CleanInputs($_POST['lastName']));
       $email=mysqli_real_escape_string($conn,CleanInputs($_POST['email']));
       $mobileNo=mysqli_real_escape_string($conn,CleanInputs($_POST['mobileNo']));
       $password=mysqli_real_escape_string($conn,CleanInputs($_POST['password']));
       $passwordRepeat=mysqli_real_escape_string($conn,CleanInputs($_POST['Repeat-password']));

    if(empty($firstName)||empty($lastName)||empty($email)||empty($mobileNo)||empty($password)||empty($password)){
        header("Location: ../signup.php?error=emptyfields&firstName=".$firstName."&lastName=".$lastName."&email=".$email."&mobileNo=".$mobileNo);
        exit();
    }elseif(!filter_var($email,FILTER_VALIDATE_EMAIL)){
                 $s_email = filter_var($email,FILTER_SANITIZE_EMAIL);
                   if(!filter_var($s_email,FILTER_VALIDATE_EMAIL)){
                        header("Location: ../signup.php?error=InvalidEmail&firstName=".$firstName."&lastName=".$lastName);
                        exit();
                    } 
     }elseif(!filter_var($email,FILTER_VALIDATE_EMAIL)&&!preg_match("/^[a-zA-Z0-9]*$/",$firstName)&&!preg_match("/^[a-zA-Z0-9]*$/",$lasttName)&&!filter_var($mobileNo, FILTER_VALIDATE_INT)){
              header("Location: ../signup.php?error=invalidemailfirstNamelastNameMobileNo");
              exit();
     }elseif($password !== $passwordRepeat){

              header("Location: ../signup.php?error=passwordcheck&firstName=".$firstName."&lastName=".$lastName."&email=".$email);
              exit();
     }elseif(!preg_match("/^[a-zA-Z]*$/",$firstName)&&!preg_match("/^[a-zA-Z]*$/",$lastName)){
         
               header("Location: ../signup.php?error=InvalidfirstNamelastName&email=".$email ."&mobileNo=".$mobileNo);
               exit();
     }else{ //check if the user enter email is already exist in the database 
          $sql= "SELECT uidUsers FROM users WHERE email=?;"; 
          $stmt=mysqli_stmt_init($conn); //if the connection to the database is opened
          if(! mysqli_stmt_prepare($stmt,$sql)){ //check if the connection is  open between my query sql statment and the database
               header("Location: ../signup.php?error=sqlerror");
               exit();
          }else{
              mysqli_stmt_bind_param($stmt,'s',$email); //send the email that the user is already enter it to the database to check
              mysqli_stmt_execute($stmt);//open the connection 
              mysqli_stmt_store_result($stmt);//the result of the select statment from the database
              $resultcheck = mysqli_stmt_num_rows($stmt);//check the number of rows of the result 
              if($resultcheck > 0 ){
                   header("Location: ../signup.php?error=usertaken&firstName".$firstName."&lastName=".$lastName."&mobileNo=".$mobileNo);
                   exit();
              }else{
                  $sql = "INSERT INTO users (firstName,lastName,mobileNo,email,password) VALUES (?,?,?,?,?); ";
                    $stmt=mysqli_stmt_init($conn); //if the connection to the database is opened
                    if(! mysqli_stmt_prepare($stmt,$sql)){ //check if the connection is  open between my query sql statment and the database
                         header("Location: ../signup.php?error=sqlerror");
                         exit();
                    }else{
                        
                         mysqli_stmt_bind_param($stmt,'sssss',$firstName,$lastName,$email,$mobileNo,$password); 
                         mysqli_stmt_execute($stmt);
                         header("Location: ../signup.php?signup=success");
                         exit();
                   
                    }
              }  
          }
   }
   mysqli_stmt_close($stmt);
   mysqli_close($conn);
}
else{
     header("Location: ../signup.php");
     exit();
}
 


?>