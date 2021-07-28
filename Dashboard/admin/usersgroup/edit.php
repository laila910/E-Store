<?php 
    
   include '../helpers/functions.php';
    include '../helpers/checkLogin.php';
   include '../helpers/checkPrem.php';
   include '../helpers/dbconnection.php';

   $id = '';
   if($_SERVER['REQUEST_METHOD'] == "GET"){

    // LOGIC .... 
      $errorMessages = [];
      $id  = Sanitize($_GET['id'],1);
     
       if(!Validator($id,3)){
 
        $errorMessages['id'] = "Invalid ID";
        
        $_SESSION['errors'] = $errorMessages;
       header("Location: index.php");
       }

    }







   if($_SERVER['REQUEST_METHOD'] == "POST"){
       
    // LOGIC ... 

      $Group= CleanInputs($_POST['Group']);
      $id    = Sanitize($_POST['id'],1);


      $errorMessages = [];
      # Check Validation ... 
      if(!Validator($Group,1)){
      
        $errorMessages['Group'] = "Group Field Required";

      }
  
    

      if(!Validator($Group,2,4)){
      
        $errorMessages['GroupLength'] = "Group length must be > 4 ";

      }



      if(!Validator($id,3)){
          $errorMessages['id'] = "Invalid id";
      }


     if(count($errorMessages) == 0){
       
         $sql ="UPDATE `usersgroup` SET `Group`='$Group' WHERE id=".$id;

         $op  = mysqli_query($conn,$sql);

        if($op){

           $errorMessages['Result'] = "Data updated.";
       
    }else{
         $errorMessages['Result']  = "Error Try Again.";
     
     }
        $_SESSION['errors'] = $errorMessages;
       
        header('Location: index.php');

     }

             
    }else{

   $_SESSION['errors'] = $errorMessages;
   }





   # Fetch Data to id . 
   $sql  = "select * from usersgroup where id = ".$id;
   $op   = mysqli_query($conn,$sql);
   $FData = mysqli_fetch_assoc($op);










    include '../header.php';
?>
  
  <body class="sb-nav-fixed">
        
    
<?php 
    include '../nav.php';
?>  


        <div id="layoutSidenav">
                  
         
<?php 
    include '../sidNave.php';
?>  





            <div id="layoutSidenav_content">
                <main>
                    <div class="container-fluid">
                        <h1 class="mt-4">Dashboard</h1>
                        <ol class="breadcrumb mb-4">

                        <?php 
                        
    

                            if(isset($_SESSION['errors'])){

                               foreach($_SESSION['errors'] as $key =>  $data){

                                echo '* '.$key.' : '.$data.'<br>';
                               }

                             unset($_SESSION['errors']);
                             }else{
                        ?>
                        
                        <li class="breadcrumb-item active">Group Type</li>
                        <?php } ?>
                        
                        
                        
                        </ol>

                      

 <div class="container">

 <form  method="post"  action="edit.php?id=<?php echo $FData['id'];?>"  enctype ="multipart/form-data">
 
  <div class="form-group">
    <label for="exampleInputEmail1">Group</label>
    <input type="text"  name="Group" value="<?php echo $FData['Group'];?>" class="form-control" id="exampleInputName" aria-describedby="" placeholder="Enter Title">
  </div>

   <input type="hidden" name="id" value="<?php echo $FData['id'];?>">
  
  <button type="submit" class="btn btn-primary">Submit</button>
</form>
</div>


                       
                </div>
                </main>
               
    
                
<?php 
    include '../footer.php';
?>  