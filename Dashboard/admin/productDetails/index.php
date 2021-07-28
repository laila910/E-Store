<?php
 include '../helpers/functions.php';
 include '../helpers/checkLogin.php';
include '../helpers/checkPrem.php';
  include '../helpers/dbconnection.php';


  $sql="SELECT `product`.`productname`,`productdetails`.* ,`productreview`.`reviewerName`  FROM `productdetails` join `product` on `productdetails`.`product_Id` = `product`.`id` join `productreview` on `productdetails`.`Review_id`=`productreview`.`id_review` ";
 
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
                            <li class="breadcrumb-item active">Product Details Data</li>
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
                                                <th>Product Name </th>
                                                <th>Product Price</th>
                                                <th>Product Quantity</th>
                                                <th>Product Description</th>
                                                <th>product Specificaton </th>
                                                
                                                <th>Reviewer Name</th>
                                                <th>unitsInStock</th>
                                                <th>Discount</th>
                                             
                                                <th>Product Availablity</th>
                                                <th>discount Availablity</th>
                                                <th>product Made Date</th>
                                              
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
                                                <td><?php echo $result['productPrice'];?></td>
                                                <td><?php echo $result['productQuntity'];?></td>
                                                <td><?php echo $result['product_Description'];?></td>
                                                <td><?php echo $result['product_Specificaton'];?></td>
                                                <td><?php echo $result['reviewerName'];?></td>
                                                <td><?php echo $result['unitsInStock'];?></td>
                                                <td><?php echo $result['Discount'];?></td>
                                                <td><?php echo $result['productAvailablity'];?></td>
                                                <td><?php echo $result['discountAvailablity'];?></td>
                                                <td><?php echo $result['productMadeDate'];?></td>
                                              
                                                <td>

                                                <a href='delete.php?id=<?php echo $result['id'];?>' class='btn btn-danger m-r-1em'>Delete</a>
                                                <a href='edit.php?id=<?php echo $result['id'];?>' class='btn btn-primary m-r-1em'>Edit</a>  
                                             
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