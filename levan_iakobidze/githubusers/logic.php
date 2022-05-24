<?php



if(!empty($_GET['search'])){


    $headers = [
        'User-Agent: php challange'
];
$ch = curl_init();

$url = 'https://api.github.com/users/'.urldecode($_GET['search']).'/'.urldecode($_GET['choose']);

curl_setopt($ch,CURLOPT_HTTPHEADER,$headers); 
curl_setopt($ch, CURLOPT_URL,$url);
 curl_setopt($ch,CURLOPT_RETURNTRANSFER,true);

 $resp = curl_exec($ch);
 
 $decoded =  json_decode($resp,true);   
 
 curl_close($ch);

 if(http_response_code(404) == true){
    
    $error = "This Username doesn't exists !"; 
}
   
}



?>