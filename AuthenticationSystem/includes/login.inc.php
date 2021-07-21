<?php


if(isset($_POST['login-submit'])){
require "dbh.inc.php";
  $Email= $_POST['email'];
  $password=$_POST['password'];
  if(empty($Email)||empty($password)){
      header("Location: ../index.php?error=emptyfields");
       exit();

  }else{
   
      $sql="SELECT * FROM users where  email=? or password=?;";
      $stmt= mysqli_stmt_init($conn);
     
      if(!mysqli_stmt_prepare($stmt,$sql)){
       header("Location: ../index.php?error=sqlerror");
       exit();
       
      }else{
          mysqli_stmt_bind_param($stmt,"ss",$mailuid,$password);
          mysqli_stmt_execute($stmt);
          $result=mysqli_stmt_get_result($stmt);

          if($row = mysqli_fetch_assoc($result)){
         
             
            //   $pwdcheck = password_verify($password,$row['pwdUsers']);
              if($password !== $row['password']){
    
                  header("Location: ../index.php?error=wrongpwd");

                  exit();
              }elseif($password === $row['password']){
                 session_start();
                 $_SESSION['userId']= $row['id'];
                 $_SESSION['useremail'] = $row['email'];
  

                 header("Location: ../index.php?login=success");
                  exit();
              }else{
                    header("Location: ../index.php?error=wrongpwd");
                    exit();
              }

          }else{
               header("Location: ../index.php?error=nouser");
                  exit();
          }

      }
  }

}else{
      header("Location: ../index.php");
     exit();
}
// echo mysqli_connect_error($conn);
//       exit();

    ?>