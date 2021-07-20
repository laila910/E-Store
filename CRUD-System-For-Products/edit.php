 <?php 

  require "../dbconnection.php";
  $errorMessages=array(); //associative array to carry the errors during check the validation 

  $id =$_GET['id'];

  
  
function CleanInputs($input)
{ 
    $input=trim($input);
    $input=stripcslashes($input);
    $input=htmlspecialchars($input);
    return $input; 
}

 if($_SERVER['REQUEST_METHOD']=="POST"){
     
     $ProductName=CleanInputs($_POST["productname"]);  
     $CategoryId=CleanInputs($_POST["product_cat_id"]);  
     $BrandId =CleanInputs($_POST["product_brand_id"]);  
    

    
     // Name Validation ...
        if(!empty($ProductName)){
           if(strlen($ProductName) < 3){
              $errorMessages['productName'] = "Product Name Length must be > 2 "; 
             }
        }else{
          $errorMessages['productName'] = " Product Name is Required!";
        }
     
 
    
     //print the result 
     
     if(count($errorMessages) == 0){
       
        $sql = "UPDATE product SET productname='$ProductName',product_cat_id='$CategoryId',product_brand_id='$BrandId' where id=".$id;
        $op = mysqli_query($conn,$sql);
        if($op){
              echo"the row is updated ";
               header("Location: index.php");
        }else{
            echo"Error in Update please Try again";
        }
     }else{

     // print error messages 
     foreach($errorMessages as $key => $value){

        echo '* '.$key.' : '.$value.'<br>';
     }


    }
}
        
 //select the row to edit 
  $sql = "SELECT * FROM product where id= $id";
  $op = mysqli_query($conn,$sql);
  $data = mysqli_fetch_assoc($op);   
                    
  ?>
 <!DOCTYPE html>
 <html lang="en">

     <head>
         <title>register </title>
         <meta charset="utf-8">
         <meta name="viewport" content="width=device-width, initial-scale=1">
         <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">
         <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
         <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>
     </head>

     <body>

         <div class="container">
           
             <form method="post" action="edit.php?id=<?php echo $data['id'];?>"
                 enctype="multipart/form-data">

                 <div class="form-group">
                     <label for="exampleInputEmail1">Enter The Product Name</label>
                     <input type="text" name="productname"  value="<?php echo $data['productname']; ?>"class="form-control" id="exampleInputName" aria-describedby=""
                         placeholder="Enter The product name ">
                 </div>


                 <div class="form-group">
                     <label for="exampleInputEmail1">Enter your Category Id </label>
                     <input type="text" name="product_cat_id"  value="<?php echo $data['product_cat_id']; ?>" class="form-control" id="exampleInputEmail1"
                         placeholder="Enter your category Id">
                 </div>

                 
                 
                 <div class="form-group">
                     <label for="exampleInputEmail1">Enter Your Brand Id </label>
                     <input type="text" name="product_brand_id"   value="<?php echo $data['product_brand_id'];?> " id=" exampleInputName" aria-describedby="">
                 </div>

                 <button type="submit" class="btn btn-primary">Update</button>
             </form>
         </div>

     </body>

 </html>