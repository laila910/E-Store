<?php
 include '../helpers/functions.php';
include '../helpers/checkLogin.php';
include '../helpers/checkPrem.php';
include '../helpers/dbconnection.php';




  $sql="SELECT `whishlist`.*,`product`.`productname`,`users`.`firstName`, `users`.`lastName`  FROM `whishlist` join `productdetails` on `whishlist`.`productid` = `productdetails`.`id` join `product` on `product`.`id`=`productdetails`.`product_Id` join `customers` on `whishlist`.`customerid` =`customers`.`id` join `users` on `customers`.`usersid` =`users`.`id` ";
 
  $op  = mysqli_query($conn,$sql); 
//  echo mysqli_error($conn);
//  exit();


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
                            <li class="breadcrumb-item active">Whishlist Data</li>
                    <?php } ?>
               
                        
                        
                        </ol>
    
                        <div class="card mb-4">
                            <div class="card-header">
                                <i class="fas fa-table mr-1"></i>
                                Whishlist Table
                            </div>
                            <div class="card-body">
                                <div class="table-responsive">
                                    <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                                        <thead>
                                            <tr>
                                                <th>#</th>
                                                <th>Product Name </th>
                                                <th>Quantity </th>
                                                <th>Customer Name</th>
                                                <th>Add To Card</th>
                                              
                                              
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
                                                <td><?php echo $result['quantity'];?></td>
                                                <td><?php echo $result['firstName'].' '.$result['lastName'];?></td>
                                                <td><?php echo $result['addtocard'];?></td>
                                               
                                              
                                                <td>

                                                <a href='delete.php?id=<?php echo $result['id'];?>' class='btn btn-danger m-r-1em'>Delete</a>
                                                
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