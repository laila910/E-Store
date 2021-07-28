<?php
 include '../helpers/functions.php';
  include '../helpers/dbconnection.php';


  $sql="SELECT `productimges`.`id`, `productimges`.`product_id`,`productimges`.`firstimage`, `productimges`.`secondimage`, `productimges`.`thirdimage`,`product`.`productname`  FROM `productimges` join `productdetails` on `productimges`.`product_id` =`productdetails`.`id` join `product` on `productdetails`.`product_Id` =`product`.`id`  ";
 
  $op  = mysqli_query($conn,$sql); 
      
//      echo mysqli_error($conn);
// exit();


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
                            <li class="breadcrumb-item active">Product Images Data</li>
                    <?php } ?>
               
                        
                        
                        </ol>
    
                        <div class="card mb-4">
                            <div class="card-header">
                                <i class="fas fa-table mr-1"></i>
                                Images Table
                            </div>
                            <div class="card-body">
                                <div class="table-responsive">
                                    <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                                        <thead>
                                            <tr>
                                                <th>#</th>
                                                <th>product name </th>
                                                <th>First Image</th>
                                                <th>Second  Image</th>
                                                <th>Third Image</th>
                                                <th>Action</th>
                                          
                                            </tr>
                                        </thead>
                                  
                                    
                                        <tbody>
                                       
                             <?php 
                           
                                while($result = mysqli_fetch_assoc($op)){
                                   
                             
                             ?>           
                                      <tr>
                                                 <td><?php echo $result['id'];?></td>
                                                 <td><?php echo $result['productname'];?></td>
                                                <td><img src='uploads/<?php echo $result['firstimage'];?>' width="50px" height="50px"></td>
                                                <td><img src='uploads/<?php echo $result['secondimage'];?>' width="50px" height="50px"></td>
                                                <td><img src='uploads/<?php echo $result['thirdimage'];?>' width="50px" height="50px"></td>
                                             
                                                <td>

                                                <a href='delete.php?id=<?php echo $result['id'];?>' class='btn btn-danger m-r-1em'>Delete</a>
                                                <a href='edit.php?id=<?php echo $result['id'];?>' class='btn btn-primary m-r-1em'>Edit</a>  
                                                </td>
                                  
                                        </tr>
                            <?php }        echo mysqli_error($conn);
                                                exit(); ?>             
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