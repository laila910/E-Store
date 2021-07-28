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
       
      $ranking_review=CleanInputs(Sanitize($_POST["ranking_review"],1));  
      $reviewerName=CleanInputs(Sanitize($_POST["reviewerName"],2));  
      $reviewerEmail=CleanInputs(Sanitize($_POST["reviewerEmail"],2));  
     
      $reviewerComment=CleanInputs(Sanitize($_POST["reviewerComment"],2));
      $review_Made_Date=CleanInputs(Sanitize($_POST["review_Made_Date"],2));
    
        $id  = CleanInputs(Sanitize($_POST['id'],1));
  
    

  $errorMessages=array();
  //Validate ranking review 
   if(!Validator($ranking_review,1)){
      $errorMessages['rankingReview']="ranking review  field Required";
   }
   if(!Validator($ranking_review,3)){
      $errorMessages['rankingReview']="ranking review   must be Integer Number";
   }
  //validate Reviewer Name
   if(!Validator($reviewerName,1)){
      $errorMessages['reviewername']="reviewer Name field Required";
   }
    
  if(!Validator($reviewerName,2,2)){
    $errorMessages['reviewernameLength'] = "reviewer Name length must be > 2 ";

  }
//validate email
   if(! Validator($reviewerEmail,1)){
         $errorMessages['email'] = 'error Email Required!';
           
        }else{
                 
            if(!Validator($reviewerEmail,4)){
                 $s_email = Sanitize($reviewerEmail,1);
                   if(!Validator($s_email,4)){
                        $errorMessages['email'] = 'error your Email is not valid! ';
            
                    }
             }
            }
          
//validate comment
   if(!Validator($reviewerComment,1)){
      $errorMessages['comment']="comment field Required";
   }
    
  if(!Validator($reviewerComment,2,4)){
    $errorMessages['secondcolorLength'] = "comment length must be > 4 ";

  }
//validate Made Date
   if(!Validator($review_Made_Date,1)){
      $errorMessages['reviewMadeDate']="Review Made Date field Required";
   }
    
  if(!Validator($review_Made_Date,2,4)){
    $errorMessages['reviewMadeDateLength'] = "Review Made Date length must be > 4 ";

  }
  //Validate Review Id 
   if(!Validator($id,1)){
      $errorMessages['reviewId']=" review Id  field Required";
   }
   if(!Validator($id,3)){
      $errorMessages['reviewId']=" review Id  must be Integer Number";
   }

     

     if(count($errorMessages) == 0){
       
      
         $sql="UPDATE `productreview` SET`ranking_review`='$ranking_review',`reviewerName`='$reviewerName',`reviewerEmail`='$reviewerEmail',`reviewerComment`='$reviewerComment',`review_Made_Date`='$review_Made_Date' where `id_review`= $id";

         $op = mysqli_query($conn,$sql);
        //  echo mysqli_error($conn);
        //  exit();

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
   $sql  ="SELECT * FROM `productreview` WHERE `id_review`= $id";
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

                               foreach($_SESSION['errors'] as $key =>  $value){

                                echo '* '.$key.' : '.$value.'<br>';
                               }

                             unset($_SESSION['errors']);
                             }else{
                        ?>
                        
                        <li class="breadcrumb-item active">Edit Review </li>
                        <?php } ?>
                        
                        
                        
                        </ol>

                      

<div class="container">

 <form  method="post"  action="edit.php?id=<?php echo $FData['id_review'];?>"  enctype ="multipart/form-data">
  
                <div class="form-group">
                     <label for="exampleInputEmail1">Enter Ranking Number </label>
                     <input type="text" name="ranking_review"  value="<?php echo $FData['ranking_review']; ?>" class="form-control" id="exampleInputName" aria-describedby=""
                         placeholder="Enter ranking_review ">
                 </div>

                 <div class="form-group">
                     <label for="exampleInputEmail1">Enter Reviewer Name</label>
                     <input type="text" name="reviewerName" value="<?php echo $FData['reviewerName']; ?>" class="form-control" id="exampleInputName" aria-describedby=""
                         placeholder="Enter reviewerName">
                  </div>

                  <div class="form-group">
                     <label for="exampleInputEmail1">Enter Reviewer Email</label>
                     <input type="email" name="reviewerEmail"value="<?php echo $FData['reviewerEmail']; ?>" class="form-control" id="exampleInputName" aria-describedby=""
                         placeholder="Enter reviewerEmail">
                  </div>

                   <div class="form-group">
                     <label for="exampleInputEmail1">Enter Reviewer Comment</label>
                     <input type="text" name="reviewerComment" value="<?php echo $FData['reviewerComment']; ?>"class="form-control" id="exampleInputName" aria-describedby=""
                         placeholder="Enter reviewerComment">
                  </div>


                  <div class="form-group">
                     <label for="exampleInputEmail1">Enter Review Made Date</label>
                     <input type="text" name="review_Made_Date" value="<?php echo $FData['review_Made_Date']; ?>"  class="form-control" id="exampleInputName" aria-describedby=""
                         placeholder="Enter review_Made_Date">
                  </div>

                   
 
                      <input type="hidden" name="id" value="<?php echo $FData['id_review'];?>">

                
  
                     <button type="submit"  name="submit"class="btn btn-primary">Submit</button>
</form>
</div>

              </div>
              </main>   
 <?php
include '../footer.php';
 ?>