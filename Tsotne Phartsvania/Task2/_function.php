<?php 
    
    function getAPIDate($url,$name){

        $curl = curl_init();

        curl_setopt_array($curl,[
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_URL => $url,
            CURLOPT_USERAGENT => $name
        ]);
        $response = curl_exec($curl);
        
        curl_close($curl);
        return json_decode($response,true);
    }

    function auth($name){
        
        $url = "https://api.github.com/users/$name";
        $response = getAPIDate($url,$name); 
        if(!isset($response['message'])):
            session_start();
            $_SESSION['name'] = $name;
            return header("Location: home.php");
        else:
            return header("Location: index.php?error=ესეთი მომხმარებელი ვერ მოიძებნა.");
        endif;
    }

