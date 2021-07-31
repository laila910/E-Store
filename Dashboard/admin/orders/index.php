<?php
 include '../helpers/functions.php';
include '../helpers/checkLogin.php';
include '../helpers/checkPrem.php';
include '../helpers/dbconnection.php';




  $sql="SELECT `orders`.*,`users`.`firstName`, `paymentMethod`.`paymentType`,`ordershipper`.`companyname` FROM `orders` join `addtocard` on `orders`.`card_id` = `addtocard`.`id` join `customers` on `addtocard`.`customerId`=`customers`.`id` join `users` on `customers`.`usersid`=`users`.`id` join `paymentMethod` on `orders`.`paymentId` =`paymentMethod`.`id` join `ordershipper` on `ordershipper`.`id`=`orders`.`shipperId` ";
 
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
                            <li class="breadcrumb-item active">Details After Order Checked</li>
                    <?php } ?>
               
                        
                        
                        </ol>
    
                        <div class="card mb-4">
                            <div class="card-header">
                                <i class="fas fa-table mr-1"></i>
                                Product Table
                            </div>
                            <div class="card-body">
                                <div class="table-responsive">
                                    <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                                        <thead>
                                            <tr>
                                                <th>#</th>
                                                <th>Customer Name  </th>
                                                <th>PaymentType </th>
                                                <th>orderdate</th>
                                                <th>shipdate</th>
                                                <th> requireddate</th>
                                                <th> shipper company Name</th>
                                                <th>salestax</th>
                                                <th>paid Status</th>
                                                <th>paymentdate</th>
                                                <th>Delivered Status</th>
                                                <th>Order Canceled Status</th>
                                               
                                                <th>Action</th>
                                          
                                            </tr>
                                        </thead>
                                  
                                    
                                        <tbody>
                                       
                             <?php 
                           
                                while($result = mysqli_fetch_assoc($op)){
                                   
                             
                             ?>           
                                        <tr>
                                                <td><?php echo $result['id'];?></td>
                                                <td><?php echo $result['firstName'];?></td>
                                                <td><?php echo $result['paymentType'];?></td>
                                                <td><?php echo $result['orderdate'];?></td>
                                                <td><?php echo $result['shipdate'];?></td>
                                                <td><?php echo $result['requireddate'];?></td>
                                                <td><?php echo $result['companyname'];?></td>
                                                <td><?php echo $result['salestax'];?></td>
                                                <td><?php echo $result['paid'];?></td>
                                                <td><?php echo $result['paymentdate'];?></td>
                                                <td><?php echo $result['delivered'];?></td>
                                                <td><?php echo $result['ordercanceled'];?></td>
                                              
                                                <td>

                                                <a href='delete.php?id=<?php echo $result['id'];?>' class='btn btn-danger m-r-1em'>Delete</a>
                                                 <a href='../orderdetails/index.php' class='btn btn-danger m-r-1em'> orderdetails</a>
                                                
                                               
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