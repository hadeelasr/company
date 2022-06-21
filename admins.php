
<?php
require('inc/header.php');
session_start();
?>
<?php
require('handle/connection.php');
$query="SELECT * FROM admins ";
$result=mysqli_query($con,$query);
if(mysqli_num_rows($result)>0){
$admins=mysqli_fetch_all($result ,MYSQLI_ASSOC);
}else{
  $msg="no data found";
}

?>
    <div class="container-fluid py-5">
        <div class="row">

            <div class="col-md-10 offset-md-1">

                <div class="d-flex justify-content-between align-items-center mb-3">
                    <h3>All Admins</h3>
                    <a href="add-admin.php" class="btn btn-success">Add Admin</a>
                </div>
                <?php
if(isset($_SESSION['success'])){?>
<div class="alert alert-success"><?=$_SESSION['success']?></div>


  <?php 
}
unset($_SESSION['success']);
?>
                <table class="table table-hover">
                    <thead>
                      <tr>
                        <th scope="col">#</th>
                        <th scope="col">Name</th>
                        <th scope="col">Email</th>
                        <th scope="col">Status</th>
                        <th scope="col">Actions</th>
                      </tr>
                    </thead>
                    <tbody>
                      <?php
                      if(!empty($admins)){
                      foreach($admins as $index=>$admin){?>
   <tr>
                        <th scope="row"><?= $index +1;?></th>
                        <td><?=$admin['name']?></td>
                        <td><?=$admin['email']?></td>
                        <td><?php 
                         if($admin['status']==1){?>
                          <span class="badge badge-success">

                        <i class="fas fa-check"></i>
                         </span>
                           <?php
                       }else{?>
                       <span class="badge badge-danger">
                       <i class="fas fa-times "></i>
                       </span>
                       <?php }
                        ?></td>

                        <td>
                            <a class="btn btn-sm btn-info" href="#">
                                <i class="fas fa-edit"></i>
                            </a>
                            <a class="btn btn-sm btn-danger" href="handle/delete-admin.php?id=<?=$admin['id']?>">
                                <i class="fas fa-trash"></i>
                            </a>
                        </td>
                      </tr>
                     <?php }}
                    else{
                      echo $msg;
                    }
                    mysqli_close($con);
                    ?>
                   
                    </tbody>
                </table>
            </div>

        </div>
    </div>
    <?php 
require('inc/footer.php');
?>