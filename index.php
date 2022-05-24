<?php
session_start();
    if(isset($_SESSION[$firstname])){
        $_SESSION['msg']='you must log in  first to view this  page';
        header('location:login.php');
    }
    if(isset($_GET['logout'])){
        session_destroy();
        unset($_session['username']);
        header("location:login.php");
    };

    <!DOCTYPE html>
<header>
<title> Home Page </title>
</header>
<body>
<h1> This is  homepage </h1>
<?php
if(isset($_SESSION['success'])):?>
<div>
<h3>
<?php
echo $_SESSION['success'];
unset($_SESSION['success']);
?>
</h3>
</div>
 <?php endif ?>


 <?php if(isset($_SESSION['firstname'])) :?>
 <h3> Wellcome <strong> <?php  echo $_SESSION['firstname']; ?> </strong></h3>
<button> < a href="index.php?logout='1'" </button>
<?php endif ?>
</body>

</html>
