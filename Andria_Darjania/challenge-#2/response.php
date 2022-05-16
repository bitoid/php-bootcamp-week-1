<?php
    
    $headers = [
        "User-Agent: Bitoid Challenge",
    ];


    // get number of pages
    $ch = curl_init("https://api.github.com/users/" . $_GET['user']);

    curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);

    $response = curl_exec($ch);

    curl_exec($ch);

    curl_close($ch);
    
    $data = json_decode($response, true);

    

    // calculate number of pages
    $repos_pages = ceil($data['public_repos'] / 100);

    $followers_pages = ceil($data['followers'] / 100); 

    if ($_GET['require'] == "repositories") {
        // get repositories
        $full_api = array();
        for ($x = 1; $x <= $repos_pages; $x++) {
            $ch = curl_init("https://api.github.com/users/" . $_GET['user'] . "/repos?per_page=100&page=$x");

            curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
            curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);

            $response = curl_exec($ch);

            curl_exec($ch);

            curl_close($ch);

            $data = json_decode($response, true);

            $full_api = array_merge($full_api, $data);
            
        } 
    } else {
        // get followers
            $full_api = array();
        for ($x = 1; $x <= $followers_pages; $x++) {
            $ch = curl_init("https://api.github.com/users/" . $_GET['user'] . "/followers?per_page=100&page=$x");

            curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
            curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);

            $response = curl_exec($ch);

            curl_exec($ch);

            curl_close($ch);

            $data = json_decode($response, true);

            $full_api = array_merge($full_api, $data);
        }

        
    }
?>


<!DOCTYPE html>
    <html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
        <link href="/style/main.css" rel="stylesheet">
        <title><?php if ($_GET['require'] == "repositories") {print "Repositories"; } else { print "Followers";} ?></title>
    </head>
    <body>
    <h1 class="logo"><?php if ($_GET['require'] == "repositories") {print $_GET['user'] . "'s Repositories: "; } else { print $_GET['user'] . "'s followers: ";} ?></h1>
        <table class="table">
        <thead>
            <tr>
                <th scope="col">#</th>
                <th scope="col">Name</th>
                <th scope="col"><?php if ($_GET['require'] == "repositories") {print "Description"; } else { print "Profile Picture";}?></th>
                <th scope="col">URL</th>
            </tr>
        </thead>
        <tbody>
        <?php 
        if ($_GET['require'] == "repositories") {
            $counter = 0;
            foreach ($full_api as $repos) {
            $counter += 1;
                print  '<tr>
                            <td>'.  $counter .'</td>
                            <td><a href="' . $repos["html_url"] . '" target="_blank">' . $repos["name"] . '</a></td>
                            <td>' . $repos["description"] . '</td>
                            <td> <a href="' . $repos["html_url"] . '" target="_blank">Open repository</a></td> 
                        </tr>'; 
            }
        } else {
            $counter = 0;
            foreach ($full_api as $repos) {
            $counter += 1;
                print  '<tr>
                            <td>'.  $counter .'</td>
                            <td><a href="' . $repos["html_url"] . '" target="_blank">' . $repos["login"] . '</a></td>
                            <td> <a href="' . $repos["html_url"] . '" target="_blank"><img class="profile-picture"src="' . $repos["avatar_url"] .' alt="Avatar"></a></td>
                            <td > <a href="' . $repos["html_url"] . '" target="_blank">View</a></td> 
                        </tr>'; 
            }
        }
         ?>  
        </tbody>
        </table>
    </body>
</html>


