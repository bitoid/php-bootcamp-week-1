<?php

 function curl_function($url){
    $resource = curl_init($url); // Create CURL resource 
    curl_setopt($resource, CURLOPT_RETURNTRANSFER, true);
    curl_setopt($resource, CURLOPT_USERAGENT, "Mozilla/4.0 (compatible; MSIE 5.01; Windows NT 5.0)");
    curl_setopt($resource,CURLOPT_HEADER, false);
    $html = curl_exec($resource); //Run CURL (execut http request)
    curl_close($resource); // Close CURL resource 
    file_put_contents('user.json', $html);
    global $data;
    $data = json_decode($html, true);
    // echo '<pre>';
    // var_dump($data);
    // echo '</pre>';
    
 }

    function foreach_function_followers($data){
        echo '<div class = "table">' ;
        foreach($data as $key => $value){
            echo  $value['login'] . '</br>';
            $avatar = $value['avatar_url'];
            echo "<img  class = 'img' src=$avatar  >" ;
        }
         echo '</div>' ;
    }

    function foreach_function_repositories($data, $username){
        foreach($data as $key => $value){
            //  print $key+1;
             $repository =  $value ['name'];
             print "<a class='a_class' href=https://github.com/$username/$repository target='_blank'>$repository</a>";
             echo $value['description'] . '<br>';
            
        }
    }

?>
