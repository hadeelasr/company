<?php
session_start();
require('inc/header.php');
?>
    <div class="container py-5">
        <div class="row">

            <div class="col-md-6 offset-md-3">
                <h3 class="mb-3">Add Admin</h3>
             
                <div class="card">
                    <div class="card-body p-5">
                        <ul class="list-unstyled">
                        <?php
                        if(isset($_SESSION['errors'])){
                            foreach($_SESSION['errors'] as $error){?>
                            <li>
                            <div class="alert alert-danger"><?php   echo $error;?></div>  
                            </li>
                                <?php
                            }
                        }
                        unset($_SESSION['errors']);
                        ?>
                        </ul>
                          <form method="post" action="handle/test.php"  enctype="multipart/form-data" >
                            
                            <div class="form-group">
                              <label>Name</label>
                              
                              <input  name="name" value="<?php
                if(isset($_SESSION['name'])){
                    echo $_SESSION['name'];
                    unset($_SESSION['name']);
                }
                ?>"
                               type="text" class="form-control">
                            </div>
                            <div class="form-group">
                              <label>Password</label>
                              <input name="password"  type="password" class="form-control">
                            </div>
                            <div class="form-group">
                              <label>Email</label>
                              <input  name="email" value=" <?php
                              if(isset($_SESSION['email'])){
                                echo $_SESSION['email'];
                                unset($_SESSION['email']);
                              }
                              ?>" type="email" class="form-control">
                            </div>


                            
                            <div class="input-group mb-3">
                            <input type="file" name="img" class="form-control" id="inputGroupFile02">
                            <label class="input-group-text" for="inputGroupFile02">Upload</label>
                            </div>

                            <div class="form-group">
                                <label>Status</label>
                                <select name="status"  class="form-control">
                                  <option value="1">active</option>
                                  <option value="0">not active</option>
                                </select>
                            </div>
                            
                              
                            <div class="text-center mt-5">
                                <button name="submit" value="submit" type="submit" class="btn btn-primary">Submit</button>
                                <a class="btn btn-dark" href="#">Back</a>
                            </div>
                        </form>
                    </ul>
                </div>
            </div>

        </div>
    </div>
    <?php 
require('inc/footer.php');
?>