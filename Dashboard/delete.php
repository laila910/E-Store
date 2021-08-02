<?php


include './help/fun.php';

include './help/logincheck.php';
include './help/db.php';
include './header.php';

include './navbar.php';
 
  

 if($_SERVER['REQUEST_METHOD'] == "GET"){

  
     $id  = Sanitized($_GET['id'],1);
     $tablename=$_GET['table'];
     $page=$_GET['page'];

      if(!Validate($id,3)){

       echo "Invalid ID";

    
      }
       
        $sql = "DELETE * FROM `$tablename` where `id` =".$id;

        $op = mysqli_query($conn,$sql);

         
         header("Location: ". $page .".php");

      }

  

 


 

?>