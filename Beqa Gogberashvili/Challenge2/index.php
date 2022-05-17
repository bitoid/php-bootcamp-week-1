<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Poppins&display=swap" rel="stylesheet">
    <title>Github Info</title>
</head>

<body>

    <style>
        <?php include "style.css" ?>
    </style>



    <?php

    $default = '<div class="default">
    <form method="post">
        <input type="text" name="user" placeholder="Github User" class="gt">
        <select name="choice" class="gt ch">
            <option value="repos">Repos</option>
            <option value="followers">Followers</option>
            <option value="both">Both</option>
        </select>
        <input type="submit" value="Search" name="submit" class="gitSubmit">
    </form>
</div>';


    if (isset($_POST['submit']) || isset($_GET['pg'])) {
        if (isset($_GET['pg'])) {
            $which_page = $_GET['pg'];
        } else {
            $which_page = 1;
        }
        if (isset($_POST['user'])) {
            $git_user = $_POST['user'];
        } else {
            $git_user = $_GET['us'];
        }

        $url = 'https://github.com/' . $git_user;
        $handle = curl_init($url);
        curl_setopt($handle,  CURLOPT_RETURNTRANSFER, TRUE);
        $response = curl_exec($handle);
        $httpCode = curl_getinfo($handle, CURLINFO_HTTP_CODE);

        // If github user isn't found, error out alert, else do the rest

        if ($httpCode == 404 || $git_user == "") {
            echo $default;
            echo '<script>alert("There is no such user!")</script>';
        } else {

            curl_close($handle);
            $opts = [
                'http' => [
                    'ignore_errors' => true,
                    'method' => 'GET',
                    'header' => [
                        'User-Agent: PHP'
                    ]
                ]
            ];

            // Getting repos and followers quantity number:

            $ch = curl_init();
            curl_setopt_array($ch, [
                CURLOPT_URL => "https://api.github.com/users/" . $git_user,
                CURLOPT_HTTPHEADER => [
                    "Accept: application/vnd.github.v3+json",
                    'User-Agent: PHP'
                ],
                CURLOPT_RETURNTRANSFER => true
            ]);
            $response = curl_exec($ch);
            curl_close($ch);
            $arr = json_decode($response);
            $followers = $arr->followers;
            $public_repos = $arr->public_repos;

            $how_many_followers = ceil($followers / 21);
            $how_many_repos = ceil($public_repos / 100);

            // Generating user data

            $context = stream_context_create($opts);

            echo '<form method="post">
            <a href="./index.php"><input type="submit" name="back" class="back" value=" Go back"></a>
        </form>';
            if (isset($_POST['choice']) && $_POST['choice'] == 'repos') {
                $choice = 'repos';
            }
            if (isset($_POST['choice']) && $_POST['choice'] == 'followers') {
                $choice = 'followers';
            }
            if (isset($_POST['choice']) && $_POST['choice'] == 'both') {
                $choice = 'both';
            }
            if (isset($_GET['choice']) && $_GET['choice'] == 'repos') {
                $choice = 'repos';
            }
            if (isset($_GET['choice']) && $_GET['choice'] == 'followers') {
                $choice = 'followers';
            }
            if (isset($_GET['choice']) && $_GET['choice'] == 'both') {
                $choice = 'both';
            }


            if ((isset($_POST['choice']) && $_POST['choice'] == 'repos') || (isset($_POST['choice']) && $_POST['choice'] == 'both') || (isset($_GET['choice']) && $_GET['choice'] == 'repos') || (isset($_GET['choice']) && $_GET['choice'] == 'both')) {
                echo '<div class="repos">            
            <h1>Repos of <a href="https://github.com/' . $git_user . '"><span style="border-bottom: 1px solid #dedede; color: white !important">' . $git_user . '</a></span> :</h1>
            <ul>';

                // Repos generator

                $prefix_number_counter = 1;
                for ($e = 0; $e < $how_many_repos; $e++) {
                    ${'reposContent' . $e} = file_get_contents("https://api.github.com/users/" . $git_user . "/repos?per_page=100&page=" . $e + 1, false, $context);
                    ${'reposArr' . $e} = json_decode(${'reposContent' . $e});
                    foreach (${'reposArr' . $e} as ${'val' . $e}) {
                        $repoName = ${'val' . $e}->name;
                        echo '<a href="https://github.com/' . $git_user . '/' . $repoName . '"><li>' . $prefix_number_counter . '. ' . $repoName . '</li></a>';
                        $prefix_number_counter++;
                    }
                }

                echo '</ul>
            </div>';
            }

            if ((isset($_POST['choice']) && $_POST['choice'] == 'followers') || (isset($_POST['choice']) && $_POST['choice'] == 'both') || (isset($_GET['choice'])) && ($_GET['choice'] == 'followers') || (isset($_GET['choice'])) && $_GET['choice'] == 'both') {
                echo '<div class="followers">
                <h1>Followers of <a href="https://github.com/' . $git_user . '"><span style="border-bottom: 1px solid #dedede; color: white !important">' . $git_user . '</a></span> :</h1>
                <ul>';

                // Followers generator

                $followerContent = file_get_contents("https://api.github.com/users/" . $git_user . "/followers?per_page=21&page=" . $which_page, false, $context);
                $followerArr = json_decode($followerContent);
                foreach ($followerArr as $val) {
                    $login = $val->login;
                    $avatar = $val->avatar_url;
                    $profile = $val->html_url;
                    echo '<li><a href="' . $profile . '"><img width="217px" height="217px" style="object-fit: cover" src="' . $avatar . '"><br>' . $login . '</a></li>';
                }


                echo '</ul>';
                echo '<div class="pagi">';
                for ($i = 0; $i < $how_many_followers; $i++) {
                    echo '<a href="?us=' . $git_user . '&pg=' . $i + 1 . '&choice=' . $choice . '"><button>' . $i + 1 . '</button></a>';
                }
                echo '</div>';
                echo '</div>';
            }
        }
    } else {
        echo $default;
    }



    ?>
</body>

</html>