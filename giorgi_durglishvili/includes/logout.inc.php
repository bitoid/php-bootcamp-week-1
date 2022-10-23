<?php 
session_start();
$file_name = $_SESSION['file_name'];
unlink("../uploads/$file_name");
session_unset();
session_destroy();
header('location: ../index.php');
exit();