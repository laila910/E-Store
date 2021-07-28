<?php
 include '../helpers/functions.php';
 include '../helpers/checkLogin.php';
include '../helpers/checkPrem.php';
  include '../helpers/dbconnection.php';

  $sql = "SELECT users.* , usersgroup.Group from users join usersgroup on users.group_id = usersgroup.id";
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

                           foreach($_SESSION['errors'] as $key =>  $data){

                            echo '* '.$key.' : '.$data.'<br>';
                           }

                             unset($_SESSION['errors']);
                         }else{
                    ?>
                    
                            <li class="breadcrumb-item"><a href="index.html">Dashboard</a></li>
                            <li class="breadcrumb-item active">Users Data</li>
                    <?php } ?>
               
                        
                        
                        </ol>
    
                        <div class="card mb-4">
                            <div class="card-header">
                                <i class="fas fa-table mr-1"></i>
                                DataTable Example
                            </div>
                            <div class="card-body">
                                <div class="table-responsive">
                                    <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                                        <thead>
                                            <tr>
                                                <th>#</th>
                                                <th>First Name</th>
                                                <th>Last Name</th>
                                                <th>Email</th>
                                                <th>Mobile No.</th>
                                                <th>Password</th>
                                                <th>Group  </th>
                                                <th>Action</th>
                                          
                                            </tr>
                                        </thead>
                                  
                                    
                                        <tbody>
                                       
                             <?php 
                          
                                while($data = mysqli_fetch_assoc($op)){
                             
                             ?>           
                                        <tr>
                                                <td><?php echo $data['id'];?></td>
                                                <td><?php echo $data['firstName'];?></td>
                                                <td><?php echo $data['lastName'];?></td>
                                                <td><?php echo $data['email'];?></td>
                                                <td><?php echo $data['mobileNo'];?></td>
                                                <td><?php echo $data['password'];?></td>
                                                <td><?php echo $data['Group'];?></td>
                                                <td>

                                                <a href='delete.php?id=<?php echo $data['id'];?>' class='btn btn-danger m-r-1em'>Delete</a>
                                                <a href='edit.php?id=<?php echo $data['id'];?>' class='btn btn-primary m-r-1em'>Edit</a>  
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