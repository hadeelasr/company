  <?php
require('connection.php');
session_start();
if(isset($_GET['id'])){
    $id=(int)$_GET['id'];
    $query="SELECT * FROM admins WHERE ID = $id";
    $result=mysqli_query($con,$query);
if(mysqli_num_rows($result)==1){
    $admin=mysqli_fetch_assoc($result);
    $img=$admin['img'];
        unlink("../uploads/&img");
    $query="DELETE FROM admins WHERE ID = $id";
$result=mysqli_query($con,$query);
if($result){
echo "deleted successfully";
$_SESSION['success']=" admin deleted successfully";
header("location:../admins.php");

}
else{
    echo "error in result";

}
}
else{
    $_SESSION["errors"]= "no data found";
header("location:../admins.php");

}
}
else{
    header("location:../admins.php");
} 

?> 
<?php
require('connection.php');
session_start();
if(isset($_GET['id'])){
    $query="SELECT * FROM admins WHERE ID = $id";
$result=mysqli_query($con,$query);
if(mysqli_num_rows($result)==1){
    $admin=mysqli_fetch_assoc($result);
    $img=$admin['img'];
    // unlink("../uploads/&img");
    $id=$_GET['id'];
    $query="DELETE FROM admins WHERE ID = $id";
$result=mysqli_query($con,$query);
if($result){
echo "deleted successfully";
$_SESSION['success']=" admin deleted successfully";
header("location:../admins.php");

}
else{
echo "error in database";
}
}
else{
    $_SESSION['errors']="no data find";
    header("location:../admins.php");
    echo "no data find";


}
}
else{
    header("location:../admins.php");
}

?>