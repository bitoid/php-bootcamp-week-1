<?php
declare(strict_types=1);


function displayProfile():array
{
    if (isset($_POST['submit'])) {
        $arr = [];
        if( ctype_alpha($_POST['firstname']) && ctype_alpha($_POST['lastname'])){
            $arr['firstname'] = $_POST['firstname'];
            $arr['lastname']  = $_POST['lastname'];
        }
        else{
            $arr['error'] = 'Firstname and Lastname should only contain letters';
        }

        if (is_uploaded_file($_FILES['image']['tmp_name'])) {

            $file_path = "images/" . $_FILES["image"]["name"];
            if (move_uploaded_file($_FILES["image"]["tmp_name"], $file_path)) {
                $arr['image'] = $file_path;
            }
        }
        return  $arr;
    }
    return [];
}

function getAPIData(string $url):array
{
    $ch = curl_init();
    $agent = 'Mozilla/4.0 (compatible; MSIE 6.0; Windows NT 5.1; SV1)';

    curl_setopt($ch, CURLOPT_URL, $url);
    curl_setopt($ch, CURLOPT_USERAGENT, $agent);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);

    $json_data = curl_exec($ch);

    curl_close($ch);

    return json_decode($json_data, true);
}

function getGithubRepos(string $name):array
{
    $url = "https://api.github.com/users/$name/repos?per_page=100";

    $data = getAPIData($url);

    $repos = [];
    foreach ($data as $repo) {
        $repos[] = ['name' => $repo['name'], 'url' => $repo['html_url'], 'description' => $repo['description']];
    }

    return $repos;
}

function getGithubFollowers(string $name):array
{
    $url = "https://api.github.com/users/$name/followers?per_page=100";

    $data = getAPIData($url);

    $followers = [];
    foreach ($data as $repo) {
        $followers[] = ['name' => $repo['login'], 'img_url' => $repo['avatar_url'], 'profile_url' => "https://github.com/".$repo['login']];
    }

    return $followers;
}