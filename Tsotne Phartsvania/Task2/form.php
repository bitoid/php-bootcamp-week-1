<?php
    //include function
    include '_function.php';

    $name = $_POST['user_name'];

    auth($name);