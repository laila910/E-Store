<?php
include '../helpers/functions.php';
include '../helpers/checkLogin.php';
include '../helpers/checkPrem.php';
include '../helpers/dbconnection.php';





  $sql="SELECT `id_review`, `ranking_review`, `reviewerName`, `reviewerEmail`, `reviewerComment`, `review_Made_Date` FROM `productreview`  ";
 
  $op  = mysqli_query($conn,$sql); 
 


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
                        <h1 class="mt-4">Tables</h1>
                        <ol class="breadcrumb mb-4">


                        <?php 
                        

                        if(isset($_SESSION['errors'])){

                           foreach($_SESSION['errors'] as $key =>  $value){

                            echo '* '.$key.' : '.$value.'<br>';
                           }

                             unset($_SESSION['errors']);
                         }else{
                    ?>
                    
                            <li class="breadcrumb-item"><a href="index.html">Dashboard</a></li>
                            <li class="breadcrumb-item active">Reviews Table</li>
                    <?php } ?>
               
                        
                        
                        </ol>
    
                        <div class="card mb-4">
                            <div class="card-header">
                                <i class="fas fa-table mr-1"></i>
                                Reviews Table
                            </div>
                            <div class="card-body">
                                <div class="table-responsive">
                                    <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                                        <thead>
                                            <tr>
                                                <th>#</th>
                                                <th>Ranking Review </th>
                                                <th>Reviewer Name</th>
                                                <th>Reviewer Email</th>
                                                <th>Reviewer Comment</th>
                                                <th>Review Made Date</th>
                                                <th>Action</th>
                                          
                                            </tr>
                                        </thead>
                                  
                                    
                                        <tbody>
                                       
                             <?php 
                           
                                while($result = mysqli_fetch_assoc($op)){
                                   
                             
                             ?>           
                                        <tr>
                                                 <td><?php echo $result['id_review'];?></td>
                                                <td><?php echo $result['ranking_review'];?></td>
                                                <td><?php echo $result['reviewerName'];?></td>
                                                <td><?php echo $result['reviewerEmail'];?></td>
                                                <td><?php echo $result['reviewerComment'];?></td>
                                                <td><?php echo $result['review_Made_Date'];?></td>
                                               
                                                <td>

                                                <a href='delete.php?id=<?php echo $result['id_review'];?>' class='btn btn-danger m-r-1em'>Delete</a>
                                                
                                                </td>
                                  
                                        </tr>
                            <?php } ?>             
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
            </main>
 <?php
include '../footer.php';
 ?>
 