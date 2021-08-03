<?php


include './help/fun.php';

include './help/logincheck.php';
include './help/db.php';
include './header.php';

 
if($_SERVER['REQUEST_METHOD'] == "GET"){


 // LOGIC .... 
     $errorMessages = [];
     $id  = Sanitized($_GET['id'],1);
    
      if(!Validate($id,3)){

       $errorMessages['id'] = "Invalid ID";

    
      }else{

        // DB Opretaion ... 
        $sql = "DELETE * FROM `whishlist` where `id` =".$id;

        $op = mysqli_query($conn,$sql);
   

        if($op){
            $errorMessages['Result'] = "deleted done";
        }else{
            
        $errorMessages['Result'] = "error in delete operation";
        }
     
      }

     $_SESSION['errors'] =  $errorMessages;
    
     header("Location: index.php");

 }



  

 


 

?>