<?php
if(isset($_POST['submit'])){
    $allowed_ext = ['png','jpg','jpeg','gif','svg'];
    $fname = $_POST['fname'];
    $lname = $_POST['lname'];

    if(!isset($fname) || !isset($lname) || empty($_FILES['upload']['name'])){
        header('location: ../index.php?error=emtyinput');
        exit();
    }

    if(!preg_match("/^[a-zA-Z]*$/",$fname)||!preg_match("/^[a-zA-Z]*$/",$lname)){
        header('location: ../index.php?error=invalidinput');
        exit();
    }

    $file_name = $_FILES['upload']['name'];
    $file_size = $_FILES['upload']['size'];
    $file_tmp = $_FILES['upload']['tmp_name'];

    $target_dir = "../uploads/$file_name";

    $file_ext = explode('.',$file_name);
    $file_ext = strtolower(end($file_ext));

    if(!in_array($file_ext,$allowed_ext)){
        header('location: ../index.php?error=invalidfile');
        exit();
    }
    if($file_size >= 1300000){
        header('location: ../index.php?error=largefile');
        exit();
    }
    move_uploaded_file($file_tmp,$target_dir);
    session_start();
    $_SESSION['fname'] = $fname;
    $_SESSION['lname'] = $lname;
    $_SESSION['file_name'] = $file_name;
    header('location: ../profile.php');
    exit();

}else{
    header('location: ../index.php');
    exit();
}