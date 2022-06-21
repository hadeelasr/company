<?php
require('connection.php');
session_start();
if(isset($_POST['submit'])){
    $name=htmlspecialchars(trim($_POST['name']));
$email=htmlspecialchars(trim($_POST['email']));
$password=htmlspecialchars(trim($_POST['password']));
$status=htmlspecialchars(trim($_POST['status']));
$errors=[];
//name
if(empty($name))
{
    $errors[]="name is required";
}
elseif(is_numeric($name)){
    $errors[]="name must be string";
}
elseif(strlen($name)>100){
    $errors[]="name size must be less than 100";
}

//email
if(empty($email)){
    $errors[]="email is required";
}elseif(!filter_var($email,FILTER_VALIDATE_EMAIL)){
    
    $errors[]="it is not a valid email adress";
}
elseif (strlen($email)>100){
    $errors[]="email too long";
}

//password
if(empty($password)){
    $errors[]="password is required";
}
elseif(!preg_match("#[0-9]+#",$password)) {
    $errors[] = "Your Password Must Contain At Least 1 Number!";
}
elseif(!preg_match("#[A-Z]+#",$password)) {
    $errors[] = "Your Password Must Contain At Least 1 Capital Letter!";
}
elseif(!preg_match("#[a-z]+#",$password)) {
    $errors[] = "Your Password Must Contain At Least 1 Lowercase Letter!";
}

//status
if($status!=0 && $status!=1){
    $errors[]="status must be 0 or 1";
}

if($_FILES==true && $_FILES['img']['name']){
    $img=$_FILES['img'];
    $imgName=$img['name'];
    $imgTempName=$img['tmp_name'];
    $size=$img['size'];
    $sizeMB=$size/(1024 * 1024);
    $ext=pathinfo($imgName,PATHINFO_EXTENSION);
    $newName=uniqid().".".$ext;
    echo  "name is $imgName";
    if($sizeMB >1){
        $errors[]="image size more than 1 MB";
    }elseif(!in_array(strtolower($ext),['png','jpg','jpeg','gif'])){
        $errors[]="image extension not allowed";

    }
}
else{
    $newName="default.png";
}
if(empty($errors)){
$query="INSERT INTO admins(`name`,`email`,`password`,`status`,`img`) VALUES('$name','$email','$password',
'$status','$newName')";
$result=mysqli_query($con,$query);
// echo  $result;
if($result){
    if($_FILES['img']['name']){
        move_uploaded_file($imgTempName,"uploads/$newName ");
        // move_uploaded_file($imgTempName,"../uploads")
    }
    // echo "added successfully";
    $_SESSION['success']="admin added successfully";
    header("location:../admins.php");
}
else{
    echo "there is error in database";
}
}
else{
    $_SESSION['errors']=$errors;
    $_SESSION['name']=$name;
    $_SESSION['email']=$email;
     header("location: ../add-admin.php");
    }
    
}
else{
    header("location:../add-admin.php");
    echo "ERRRO";
}

?>