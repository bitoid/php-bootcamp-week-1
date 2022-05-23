<!DOCTYPE html>
<html lang="en">
<head>
    <link rel="stylesheet" href="style.css">
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Challenge2</title>
</head>
<body>
    
    
    <div class="gitForm"> 
        <form  action="/index.php" method="POST" enctype="multipart/form-data">

            <label for="firstname">Please Enter Your  Username: </label>
            <input type="text" name="username" id="username" placeholder="Username">
            
            <input type="submit"  id="submit" name="submit">    

        </form>
    </div>

    

    <?php

        $username = $_POST["username"];
        $user_url = "https://api.github.com/users/".$username;
        

        // Curl to find out User repo number

        $curl_handle_two = curl_init();

        curl_setopt_array($curl_handle_two, [
            CURLOPT_RETURNTRANSFER => 1,
            CURLOPT_URL => $user_url,
            CURLOPT_HTTPHEADER => ["Authorization: token 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"],
            CURLOPT_USERAGENT => 'Api in curl two'
        ]);

        $data_user = curl_exec($curl_handle_two);
        $data_user_array = json_decode($data_user,TRUE);

        $repo_number = $data_user_array["public_repos"];
        $follower_number = $data_user_array["followers"];

        $page_number = ceil($repo_number/100);
        $page_follower_number = ceil($follower_number/100);
        
        curl_close($curl_handle_two);
    
    ?>

    
    <?php
        //Curl for followers 
        for($i=0;$i<$page_follower_number;$i++){
            $api_follower_url = "https://api.github.com/users/".$username."/followers?per_page=100&page=$i";

            $ch = curl_init();

            curl_setopt_array($ch, [
                CURLOPT_RETURNTRANSFER => 1,
                CURLOPT_URL => $api_follower_url,
                CURLOPT_HTTPHEADER => ["Authorization: token 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"],
                CURLOPT_USERAGENT => 'Api in curl one'
            ]);

            $followers = curl_exec($ch);
            $followers_array = json_decode($followers,TRUE);

            foreach($followers_array as $follower){
                $follower_names[] = $follower['login'];
                $photos[] = $follower['avatar_url'];
                $profile_link[] = $follower['html_url'];
            }
    ?>
            
    <?php   for ($x = 0; $x < sizeof($follower_names); $x++) { ?>

                <div class = "followerResult">
                    <p id="followerName">Follower Name: <?= $follower_names[$x]?> </p>
                    <p id="followerProfilePic">
                        Profile Picture: <a target=_blank href="<?=$profile_link[$x]?>"> <img  src="<?=$photos[$x]?>" width=100> </a> 
                    </p>
                    <br>
                </div> 
    
    <?php
            }
        }
    ?>

    
    <?php
        // CURL For Repos
        for($i=0;$i<$page_number;$i++){
            
            $api_url  = "https://api.github.com/users/" .$username. "/repos?per_page=100&page=$i";
        
            $curl_handle = curl_init( );

            curl_setopt_array($curl_handle, [
                CURLOPT_RETURNTRANSFER => 1,
                CURLOPT_URL => $api_url,
                CURLOPT_HTTPHEADER => ["Authorization: token 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"],
                CURLOPT_USERAGENT => 'Api in curl'
            ]);

            $data = curl_exec($curl_handle);
            $data_array = json_decode($data,TRUE);


            foreach($data_array as $repo){
                $names[] = $repo['name'];
                $links[] = $repo['html_url'];
            }
    ?>

    <?php   for ($x = 0; $x < sizeof($names); $x++) { ?>

                <div class = "followerResult">
                    <p id="repoName">Repo Name: <?= $names[$x]?> </p>
                    <p id="repoLink">Repo Link: <?= $links[$x]?> </p>
                    <br>
                </div> 

    <?php
            }

            curl_close($curl_handle);
        }
    
    ?>
    
</body>
</html>