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
        $userUrl = "https://api.github.com/users/".$username;
        

        // Curl to find out User repo number

        $curlHandleTwo = curl_init();

        curl_setopt_array($curlHandleTwo, [
            CURLOPT_RETURNTRANSFER => 1,
            CURLOPT_URL => $userUrl,
            CURLOPT_HTTPHEADER => ["Authorization: token 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"],
            CURLOPT_USERAGENT => 'Api in curl two'
        ]);

        $dataUser = curl_exec($curlHandleTwo);
        $dataUserArray = json_decode($dataUser,TRUE);

        $repoNumber = $dataUserArray["public_repos"];
        $followerNumber = $dataUserArray["followers"];

        $pageNumber = ceil($repoNumber/100);
        $pageFollowerNumber = ceil($followerNumber/100);
        
        curl_close($curlHandleTwo);

        //Curl for followers 
        for($i=0;$i<$pageFollowerNumber;$i++){
            $apiFollowerUrl = "https://api.github.com/users/".$username."/followers?per_page=100&page=$i";

            $ch = curl_init();

            curl_setopt_array($ch, [
                CURLOPT_RETURNTRANSFER => 1,
                CURLOPT_URL => $apiFollowerUrl,
                CURLOPT_HTTPHEADER => ["Authorization: token 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"],
                CURLOPT_USERAGENT => 'Api in curl one'
            ]);

            $followers = curl_exec($ch);
            $followersArray = json_decode($followers,TRUE);

            foreach($followersArray as $follower){
                $followerNames[] = $follower['login'];
                $photos[] = $follower['avatar_url'];
                $profileLink[] = $follower['html_url'];
            }
            
            for ($x = 0; $x < sizeof($followerNames); $x++) {
                print "Follower Name: " . $followerNames[$x] . " Profile Picture: <a target=_blank href=".$profileLink[$x].">
                <img  src=".$photos[$x]." width=100></a>; <br>";
            }
        }


        // CURL For Repos
        for($i=0;$i<$pageNumber;$i++){
            
            $apiUrl  = "https://api.github.com/users/" .$username. "/repos?per_page=100&page=$i";
        
            $curlHandle = curl_init( );

            curl_setopt_array($curlHandle, [
                CURLOPT_RETURNTRANSFER => 1,
                CURLOPT_URL => $apiUrl,
                CURLOPT_HTTPHEADER => ["Authorization: token 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"],
                CURLOPT_USERAGENT => 'Api in curl'
            ]);

            $data = curl_exec($curlHandle);
            $dataArray = json_decode($data,TRUE);


            foreach($dataArray as $repo){
                $names[] = $repo['name'];
                $links[] = $repo['html_url'];
            }

            for ($x = 0; $x < sizeof($names); $x++) {
                echo "Repo Name: $names[$x] Repo Link: $links[$x] <br>";
            }

            curl_close($curlHandle);
        }
    
    ?>
    
</body>
</html>