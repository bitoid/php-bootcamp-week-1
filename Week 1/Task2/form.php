<?php 
    
    if($_SERVER['REQUEST_METHOD'] == 'POST'){
        if(isset($_POST['user_name'])){
            if(!empty($_POST['user_name'])){
                $name = htmlspecialchars($_POST['user_name']);

                $url_user = "https://api.github.com/users/$name";
                $curl_user = curl_init();

                curl_setopt_array($curl_user,[
                    CURLOPT_RETURNTRANSFER => true,
                    CURLOPT_URL => $url_user,
                    CURLOPT_USERAGENT => $name
                ]);
        
                $response_user = curl_exec($curl_user);
                $decode_user = json_decode($response_user,true);

                
                if(isset($decode_user['message'])){
                    header('Location: index.php?error=Sorry, API rate limit.');
                    exit();
                }else{
                    session_start();
                    $_SESSION['user_name'] = $name;
                    header('Location: home.php');
                    exit();
                }
                
            }
            else{
            
                header('Location: index.php?error=User Name is required');
                exit();
            }
        }else{
            
            header('Location: index.php?error=User Name is required');
            exit();
        }
         
    }else {
        header("Location: index.php?error=Somthing Wrong");
        exit();
    }