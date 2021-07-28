<?php
 include '../helpers/functions.php';
 include '../helpers/checkLogin.php';
include '../helpers/checkPrem.php';
  include '../helpers/dbconnection.php';


  $sql="SELECT `id_size`, `S`, `M`, `L`, `XL` FROM `productsizes` ";
 
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
                            <li class="breadcrumb-item active">Product Sizes Data</li>
                    <?php } ?>
               
                        
                        
                        </ol>
    
                        <div class="card mb-4">
                            <div class="card-header">
                                <i class="fas fa-table mr-1"></i>
                                Sizes Table
                            </div>
                            <div class="card-body">
                                <div class="table-responsive">
                                    <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                                        <thead>
                                            <tr>
                                                <th>#</th>
                                                <th>First Size </th>
                                                <th>Second Size</th>
                                                <th>Third Size</th>
                                                <th>Fourth Size</th>
                                                <th>Action</th>
                                          
                                            </tr>
                                        </thead>
                                  
                                    
                                        <tbody>
                                       
                             <?php 
                           
                                while($result = mysqli_fetch_assoc($op)){
                                   
                             
                             ?>           
                                        <tr>
                                                 <td><?php echo $result['id_size'];?></td>
                                                <td><?php echo $result['S'];?></td>
                                                <td><?php echo $result['M'];?></td>
                                                <td><?php echo $result['L'];?></td>
                                                <td><?php echo $result['XL'];?></td>
                                               
                                                <td>

                                                <a href='delete.php?id=<?php echo $result['id_size'];?>' class='btn btn-danger m-r-1em'>Delete</a>
                                                <a href='edit.php?id=<?php echo $result['id_size'];?>' class='btn btn-primary m-r-1em'>Edit</a>  
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