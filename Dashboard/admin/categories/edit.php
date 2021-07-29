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
       
      $categoryname =CleanInputs(Sanitize($_POST["categoryname"],2));  
      $description=CleanInputs(Sanitize($_POST["description"],2));  
      $ordering =CleanInputs(Sanitize($_POST["ordering"],1));  
      $Active =CleanInputs(Sanitize($_POST["Active"],1)); 
       $id  = CleanInputs(Sanitize($_POST['id'],1));
      

       $errorMessages=array();
     //validate category Name
   if(!Validator($categoryname,1)){
      $errorMessages['categoryname']="Category Name field Required";
   }
    
  if(!Validator($categoryname,2,4)){
    $errorMessages['categorynameLength'] = "category name length must be > 4 ";

  }
  //validate description
    if(!Validator($description,1)){
      $errorMessages['description']="description field Required";
   }
    
  if(!Validator($description,2,4)){
    $errorMessages['descriptionLength'] = "description length must be > 4";

  }

  //Validate ordering
   if(!Validator($ordering,1)){
      $errorMessages['ordering']="ordering  field Required";
   }
   if(!Validator($ordering,3)){
      $errorMessages['ordering']=" ordering must be Integer Number";
   }
 //Validate Active
   if(!Validator($Active,1)){
      $errorMessages['Active']="Active  field Required";
   }
   if(!Validator($Active,3)){
      $errorMessages['Active']="Active  must be Integer Number";
   }
 //Validate category  Id 
  if(!Validator($id,1)){
      $errorMessages['categoryid']=" catgory id  field Required";
   }
      if(!Validator($id,3)){
          $errorMessages['categoryid'] = " category must be integer number ";
      }
   

     if(count($errorMessages) == 0){
       
      
         $sql="UPDATE `categoreis` SET `categoryname`='$categoryname',`description`='$description',`ordering`='$ordering',`Active`='$Active', WHERE `id`='$id'";

         $op = mysqli_query($conn,$sql);
         


       if($op){

            $errorMessages['Result'] = "Data updated.";
       
       }else{
            $errorMessages['Result']  = "Error Try Again.";
     
         }
        $_SESSION['errors'] = $errorMessages;
       
        header('Location: index.php');

     }else{

       $_SESSION['errors'] = $errorMessages;
   }

  }

   # Fetch product
   $sql1  =" SELECT `id`, `categoryname`, `description`, `ordering`, `Active`, `category_made_date` FROM `categoreis` WHERE `id`= ".$id;
   $op1  = mysqli_query($conn,$sql1);
   $FData = mysqli_fetch_assoc($op1);

 

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

                               foreach($_SESSION['errors'] as $key =>  $value){

                                echo '* '.$key.' : '.$value.'<br>';
                               }

                             unset($_SESSION['errors']);
                             }else{
                        ?>
                        
                        <li class="breadcrumb-item active">Edit category </li>
                        <?php } ?>
                        
                        
                        
                        </ol>

                      

<div class="container">

 <form  method="post"  action="edit.php?id=<?php echo $FData['id'];?>"  enctype ="multipart/form-data">
  
 
                 <div class="form-group">
                     <label for="exampleInputEmail1">Enter Category Name</label>
                     <input type="text" name="categoryname"  value="<?php echo $FData['categoryname']; ?>" class="form-control" id="exampleInputName" aria-describedby=""
                         placeholder="Enter Category Name ">
                 </div>

                 <div class="form-group">
                     <label for="exampleInputEmail1">Enter Category Description </label>
                     <input type="text" name="description"  value="<?php echo $FData['description']; ?>" class="form-control" id="exampleInputName" aria-describedby=""
                         placeholder="Enter description ">
                  </div>

                  
                 <div class="form-group">
                     <label for="exampleInputEmail1">Enter category Ordering </label>
                     <input type="text" name="ordering"  value="<?php echo $FData['ordering']; ?>" class="form-control" id="exampleInputName" aria-describedby=""
                         placeholder="Enter ordering ">
                  </div>
                 <div class="form-group">
                     <label for="exampleInputEmail1">Enter category Visible  </label>
                     <input type="text" name="Active"   value="<?php echo $FData['Active']; ?>"class="form-control" id="exampleInputName" aria-describedby=""
                         placeholder="Enter Active 1 for visible 2 for not ">
                  </div>


                      <input type="hidden" name="id" value="<?php echo $FData['id'];?>">

                
  
                     <button type="submit"  name="submit"class="btn btn-primary">Submit</button>
</form>
</div>

              </div>
              </main>   
 <?php
include '../footer.php';
 ?>