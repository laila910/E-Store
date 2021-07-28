<?php
include '../header.php';
include '../helpers/functions.php';
include '../helpers/checkLogin.php';
include '../helpers/checkPrem.php';
include '../helpers/dbconnection.php';



if($_SERVER['REQUEST_METHOD']=='POST'){

     
       $ranking_review=CleanInputs(Sanitize($_POST["ranking_review"],1));  
      $reviewerName=CleanInputs(Sanitize($_POST["reviewerName"],2));  
      $reviewerEmail=CleanInputs(Sanitize($_POST["reviewerEmail"],2));  
     
      $reviewerComment=CleanInputs(Sanitize($_POST["reviewerComment"],2));
     
    

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


 if(count($errorMessages) > 0){
    $_SESSION['errors']=$errorMessages;

 }else{
       $sql =  "INSERT INTO `productreview`( `ranking_review`, `reviewerName`, `reviewerEmail`, `reviewerComment`) VALUES ('$ranking_review','$reviewerName','$reviewerEmail','$reviewerComment')";


      $op = mysqli_query($conn,$sql);
     
     
    if($op){

        $errorMessages['Result'] = "Data inserted.";
    }else{
        $errorMessages['Result']  = "Error Try Again.";
     
       

     }
   
      
    

     $_SESSION['errors']=$errorMessages;
     header('Location: index.php');

     }


    


}








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
                                    foreach($_SESSION['errors'] as $key => $value){
                                             echo '* '.$key.' : '.$value.'<br>';
                                            
                                       }  unset($_SESSION['errors']);
                                     }else{
                                     
                            ?>
                       <li class="breadcrumb-item active"> Add  Review </li>
                                    <?php  }?>
                    </ol>
                <div class="container">
           
                      <form method="post" action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']);?>"
                 enctype="multipart/form-data">

                 

                  <div class="form-group">
                     <label for="exampleInputEmail1">Enter Ranking Number </label>
                     <input type="text" name="ranking_review" class="form-control" id="exampleInputName" aria-describedby=""
                         placeholder="Enter ranking_review ">
                 </div>

                 <div class="form-group">
                     <label for="exampleInputEmail1">Enter Reviewer Name</label>
                     <input type="text" name="reviewerName" class="form-control" id="exampleInputName" aria-describedby=""
                         placeholder="Enter reviewerName">
                  </div>

                  <div class="form-group">
                     <label for="exampleInputEmail1">Enter Reviewer Email</label>
                     <input type="email" name="reviewerEmail" class="form-control" id="exampleInputName" aria-describedby=""
                         placeholder="Enter reviewerEmail">
                  </div>

                   <div class="form-group">
                     <label for="exampleInputEmail1">Enter Reviewer Comment</label>
                     <input type="text" name="reviewerComment" class="form-control" id="exampleInputName" aria-describedby=""
                         placeholder="Enter reviewerComment">
                  </div>

                

                 <button type="submit" class="btn btn-primary">Add Review</button>
               </form>
                </div>

                </div>
            </main>
 <?php
include '../footer.php';
 ?>