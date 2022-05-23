

<?php
$error = false;

// pagination
$reposPage = $_GET['reposPage'] ?? 1;
$followersPage = $_GET['followersPage'] ?? 1;
$perPage = 10;
// /.

function getApiClient ($api_url, $headers) {
    $ch = curl_init($api_url);
    curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);

    $resp = curl_exec($ch);
    curl_close($ch);

    return $resp;
};

function getHeaders($username){
    return [
        'User-Agent: ' . $username
    ];
};

function fetchRepos ($username){
    global $reposPage, $perPage;
    $api_url = 'https://api.github.com/users/'.$username.'/repos?page=' . $reposPage . '&per_page=' . $perPage;
    $resp = getApiClient($api_url, getHeaders($username));
    return $resp;
}

function fetchFollowers ($username){
    global $followersPage, $perPage;
    $api_url = 'https://api.github.com/users/'.$username.'/followers?page=' . $followersPage . '&per_page=' . $perPage;
    $resp = getApiClient($api_url, getHeaders($username));
    return $resp;
}

function getRepoNamesArr($repos){
    global $error;

    if($error){
        return [];
    }

    $resp = [];
    $data = json_decode($repos, true);

    if(!isset($data['message'])){
        foreach ($data as &$dataItem) {
            array_push($resp, [
                'name' => $dataItem['name'],
                'url' => $dataItem['html_url']
            ]);
        }
        unset($repo);
    } else {
        $error = true;
        // echo '<b>Repos Error:</b> '.$data['message'] . '<br><br>';
    }
    

    return $resp;
}

function getFollowersArr($followers){
    global $error;

    if($error){
        return [];
    }

    $resp = [];
    $data = json_decode($followers, true);

    if(!isset($data['message'])){
        foreach ($data as &$dataItem) {
            array_push($resp, [
                'name' => $dataItem['login'],
                'image_url' => $dataItem['avatar_url'],
                'url' => $dataItem['html_url']
            ]);
        }
        unset($dataItem);
    } else {
        $error = true;
        // echo '<b>Followers Error:</b> '.$data['message'] . '<br><br>';
    }

    return $resp;
}

$username = null;
$errorFetching = false;
$reposArr = [];
$followersArr = [];
if( isset($_GET['username']) and $_GET['username'] ){
    $username = $_GET['username'];
    $reposArr = getRepoNamesArr(fetchRepos($username));
    $followersArr = getFollowersArr(fetchFollowers($username));
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="/index.css">
    <title>Document</title>
</head>
<body>
    <div class="wrp">
        <div class="formWrp">
            <form action="/" method="GET" >
                <?php if($error): ?>
                <span class="input_error">Unable to handle your request</span>
                <?php endif; ?>
                <div class="form-group">
                    <input class="form_input" type="text" name="username" placeholder="Github Username" value="<?php echo $_GET['username'] ?? ''; ?>">
                    <button type="submit">Submit</button>
                </div>
            </form>
        </div>

        <hr>

        <div class="main">
            <div class="repos">
                <h1>Repositories</h1>
                <?php if(count($reposArr) > 0): ?>
                    <ul>
                        <?php foreach ($reposArr as &$repo): ?>
                        <li class="repo_item"><a href="<?=$repo['url']?>"><?=$repo['name']?></a></li>
                        <?php endforeach; ?>
                    </ul>
                <?php elseif ($reposPage === 1 && count($reposArr) === 0): ?>
                    <p>No Repos Found</p>
                <?php endif; ?>

                <?php if($reposPage >= 1 && count($reposArr) > 0): ?>
                    <div class="pagin_wrp">

                        <?php if($reposPage > 1): ?>
                            <a href="<?php echo '?' . http_build_query(array_merge($_GET, ['reposPage' => $reposPage > 1 ? $reposPage - 1 : 1])); ?>" class="pagin_item" >Prev</a>
                        <?php else: ?>
                            <a class="pagin_item disabled" disabled >Prev</a>
                        <?php endif; ?>

                        <div><?php echo $reposPage; ?></div>

                        <?php if(!($reposPage > 1 && count($reposArr) === 0)): ?>
                        <a href="<?php echo '?' . http_build_query(array_merge($_GET, ['reposPage' => $reposPage + 1])); ?>" class="pagin_item" >Next</a>
                        <?php else: ?>
                        <a class="pagin_item disabled" disabled >Next</a>
                        <?php endif; ?>

                    </div>
                <?php endif; ?>

                
            </div>
            
            <div class="followers">
                <h1>Followers</h1>

                <?php if(count($followersArr) > 0): ?>
                <ul>
                    <?php foreach ($followersArr as &$follower): ?>
                        <li class="follower_item">
                            <img src="<?=$follower['image_url']?>" >
                            <div class="text_content">
                                <h3><?=$follower['name']?></h3>
                                <a href="<?=$follower['url']?>" >View Profile</a>
                            </div>
                        </li>
                    <?php endforeach; ?>
                </ul>
                <?php elseif ($followersPage === 1 && count($followersArr) === 0): ?>
                    <p>No Followers Found</p>
                <?php endif; ?>
                
                <?php if($followersPage >= 1 && count($followersArr) > 0): ?>
                
                    <div class="pagin_wrp">
                        <?php if($followersPage > 1): ?>
                        <a href="<?php echo '?' . http_build_query(array_merge($_GET, ['followersPage' => $followersPage > 1 ? $followersPage - 1 : 1])); ?>" class="pagin_item" >Prev</a>
                        <?php else: ?>
                        <a class="pagin_item disabled" disabled >Prev</a>
                        <?php endif; ?>
                        
                        <div><?php echo $followersPage; ?></div>

                        <?php if(!($followersPage > 1 && count($followersArr) === 0)): ?>
                        <a href="<?php echo '?' . http_build_query(array_merge($_GET, ['followersPage' => $followersPage + 1])); ?>" class="pagin_item" >Next</a>
                        <?php else: ?>
                        <a class="pagin_item disabled" disabled >Next</a>
                        <?php endif; ?>
                    </div>

                <?php endif; ?>

            </div>
        </div>
    </div>
</body>
</html>

