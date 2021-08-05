<?php


include '../help/fun.php';

include '../help/logincheck.php';
include '../help/db.php';



if ($_SERVER['REQUEST_METHOD'] == "POST") {

  $FirstName = Clean(Sanitized($_POST["firstName"], 2));
  $LastName = Clean(Sanitized($_POST["lastName"], 2));
  $Email = Clean($_POST["email"]);
  $MobileNo = Clean($_POST["mobileNo"]);
  $Password = Clean(Sanitized($_POST["password"], 5));
  $passwordRepeat = Clean(Sanitized($_POST["Repeat-password"], 5));

  $errorMessages = [];

  //validate first Name
  if (!Validate($FirstName, 1)) {
    $errorMessages['firstName'] = "First Name field Required";
  }

  if (!Validate($FirstName, 2, 4)) {
    $errorMessages['firstNameLength'] = "First Name length must be > 4 ";
  }
  //validate last Name
  if (!Validate($LastName, 1)) {
    $errorMessages['lastName'] = "last Name field Required";
  }

  if (!Validate($LastName, 2, 4)) {
    $errorMessages['lastNameLength'] = "Last Name length must be > 4 ";
  }
  //validate email
  if (!Validate($Email, 1)) {
    $errorMessages['email'] = 'error Email Required!';
  } else {

    if (!Validate($Email, 4)) {
      $s_email = Sanitize($Email, 1);
      if (!Validator($s_email, 4)) {
        $errorMessages['email'] = 'error your Email is not valid! ';
      }
    }
  }

  //MobileNo
  if (!Validate($MobileNo, 1)) {
    $errorMessages['mobileNo'] = "MobileNo field Required";
  }

  if (!Validate($MobileNo, 2, 11)) {
    $errorMessages['mobileNo'] = "MobileNo length must be > 11 ";
  }
  //validate password
  if (!Validate($Password, 1)) {
    $errorMessages['Password'] = "password field Required";
  }

  if (!Validate($Password, 2, 5)) {
    $errorMessages['Password'] = "password length must be > 5";
  }
  //validate password repeat
  if (!Validate($passwordRepeat, 1)) {
    $errorMessages['PasswordRepeat'] = "PasswordRepeat field Required";
  }

  if (!Validate($passwordRepeat, 2, 5)) {
    $errorMessages['PasswordRepeat'] = "passwordRepeat length must be > 5";
  }


  if (count($errorMessages) == 0) {

    $sql = "SELECT * FROM `users` WHERE `email`='$Email'";
    $op = mysqli_query($conn, $sql);

    if (mysqli_num_rows($op) > 0) {

      header("Location: ../login.php?UserAlreadyToken");
      exit();
    } else {
      $sql = "INSERT INTO `users` (`firstName`,`lastName`,`email`,`mobileNo`,`password`) VALUES ('$FirstName','$LastName','$Email','$MobileNo','$Password'); ";

      $op = mysqli_query($conn, $sql);

      header("Location: ../login.php?SignUpSuccessYouNeedToLoginNow");
    }
  } else {
    $_SESSION['errors'] = $errorMessages;
    header('Location: login.php');
  }
}


if (isset($_SESSION['errors'])) {

  foreach ($_SESSION['errors'] as $data) {

    echo '* ' . $data . '<br>';
  }
  unset($_SESSION['errors']);
}
