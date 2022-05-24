<?php
session_start();
$firstname="";
$lastname="";
$errors=array();

$db=mysqli_connect("localhost","root",'week1and2') or die("could not connect to database");
$firstname=mysqli_real_escape_string($db,$_POST["firstname"]);
$lastname=mysqli_real_escape_string($db,$_POST["lastname"]);
$password=mysqli_real_escape_string($db,$_POST["password"]);


if(empty($firstname)) { array_push($errors,"firstname is required");}
if(empty($lastname)) { array_push($errors,"lastname is required");};
if(empty($password)) { array_push($errors,"password is required");};


// check db for existing user with same username

$user_check_query="SELECT*FROM  user WHERE firstname='$firstname' or lastname='$lastname'  LIMIT 1 ";
$results=mysqli_query($db,$user_check_query);
$user=mysqli_fetch_assoc($results);
if ($user) {
    if($user['firstname']===$firstname){array_push($errors,'firstname already exists');}
    if($user['lastname']===$lastname){array_push($errors,'lastname already exists');}
}

if(count($errors)==0){
    $password = md5($password);
    $query='INSERT INTO week1and2( firstname,lastname, password) values ($firstname,$lastname,$password)';
    mysqli_query($db,$query);
    $_SESSION['firstname']=$firstname;
        $_SESSION['lastname']=$lastname;
        $_SESSION['success']='you are  now logged in';
        header('location:index.php');
}

if(isset($_POST['login_user'])){
    $username=mysqli_real_escape_string($db,$_POST['firstname']);
    $lastname=mysqli_real_escape_string($db,$_POST['lastname']);
    $password=mysqli_real_escape_string($db,$_POST['password']);
    if(empty($firstname)){
        array_push($errors,'username is required');
    }
    if(empty($lastname)){
        array_push($errors,'lastname is required');
    }
    if(empty($password)){
        array_push($errors,'password is required');
    }
if(count($errors)==0){
    $password = md5($password);
    $query="SELECT * FROM week1and2  WHERE firstname=$firstname AND password=$password ";
    $results=mysqli_query($db,$query);
    if(mysqli-num-results($results)){
     $_SESSION['firstname']=$firstname;
         $_SESSION['success']='logged in successfuly ';
         header('location:index.php');
    }
    else{
        array_push($errors,"wrong firstname/password");
    }
}

}