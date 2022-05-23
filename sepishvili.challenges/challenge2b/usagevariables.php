<?php   
    
    $username=$_POST['input_username'];
    $operation=$_POST['operation'];

    $url="https://api.github.com/search/users?q=". $_POST['input_username'];               
    $user_validation= dataFromUrl($url) ;               
    nameValidaton($user_validation);                    
    
    $url="https://api.github.com/users/". $username;
    $user_info= dataFromUrl($url);               
    $data_count=getoperationvalue($operation,$user_info); 
    $i=0;
    $c=1;
    $pagenumber=0;