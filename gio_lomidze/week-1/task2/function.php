<?php

$per_page = 30; // show items per page
$page_num = isset($_GET['submit_page']) ? $_GET['submit_page'] : 1; // if pages don't exist, equals to 1

if(isset($_GET['submit']) || isset($_GET['submit_page'])) {
    // ******************* fetch general information about an user ********* //

    $urlInfo = "https://api.github.com/users/$user";
    $curlInfo = curl_init($urlInfo);

    curl_setopt($curlInfo, CURLOPT_URL, $urlInfo);
    curl_setopt($curlInfo, CURLOPT_RETURNTRANSFER, true);

    $headers = array(
        "User-Agent: ReqBin Curl Client/1.0",
        );

    curl_setopt($curlInfo, CURLOPT_HTTPHEADER, $headers);
    $responseInfo = curl_exec($curlInfo);

    $dataInfo = json_decode($responseInfo, true);

    curl_close($curlInfo);
    
    //****************** end of user information fetch *****************//
    if(isset($dataInfo['public_repos']) && isset($dataInfo['followers'])) {
        $total_repo = $dataInfo['public_repos']; // total repositories of an user
        $total_repo > 1 ? $sr = 's' : $sr = ''; //for plural -> repo(s)
        $page_repo = ceil($total_repo / $per_page); // count pages

        $total_follow = $dataInfo['followers']; // total followers of an user
        $total_follow > 1 ? $sf = 's' : $sf = ''; //for plural -> follower(s)
        $page_follow = ceil($total_follow / $per_page); // count pages
    }
    
    // *************************** fetch repos and followers **************** //
    $url = "https://api.github.com/users/$user/$info?page=$page_num&per_page=$per_page";

    $curl = curl_init($url);

    curl_setopt($curl, CURLOPT_URL, $url);
    curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
    curl_setopt($curl, CURLOPT_HTTPHEADER, $headers);

    $response = curl_exec($curl);
    
    $status =  curl_getinfo($curl, CURLINFO_HTTP_CODE); // returns status code

    curl_close($curl);

    $data = json_decode($response, true);

    // *********** end of data fetch using curl **************** //
    //*************** loops through fetched data and generates desired html **************//
    if($status === 200) {
        if($info === 'repos' && $page_repo > 0) {
            echo "<h2>Repo$sr of <b>$user</b>:</h2><br>";
            foreach($data as $key => $val)
                echo 
                    "<div class='repo'><span>" . $key + 1 + ($page_num - 1) * 30 . ")</span><a href='" . $val['owner']['html_url'] . '/' . $val['name'] . "' target='_blank'>
                        <p>" . $val['name'] . "</p>
                    </a></div>"; //generates repos
            if($page_repo >= 1 || isset($_GET['submit_page'])) {
                echo "<div class='pagination'><form action='' method='GET'>"; //generates pagination for repos
                for($i=1; $i < $page_repo + 1; $i++){
                    $page_num == $i ? $active = 'active' : $active = ''; // class 'active' highlights current page
                    echo "<button class='$active' type = 'submit' name = 'submit_page' value='$i'>$i</button>";
                }
                echo "</form></div>";
            }
        } else if($info === 'followers' && $page_follow > 0) {
            echo "<h2>Follower$sf of <b>$user</b>:</h2><br>";
            foreach($data as $val)
                echo
                    "<p>" . $val['login'] . "</p>
                    <div class='img_wrap'>
                        <a href=" . $val['html_url'] ." target='_blank'>
                            <img src='" . $val['avatar_url'] . "'>
                        </a>
                    </div>"; //generates followers
            if($page_follow >= 1 && (isset($_GET['submit_page']) || isset($_GET['submit']))) {
                echo "<div class='pagination'><form action='' method='GET'>"; //generates pagination for followers
                for($i=1; $i < $page_follow + 1; $i++){
                    $page_num == $i ? $active = 'active' : $active = ''; // class 'active' highlights current page
                    echo "<button class='$active' type = 'submit' name = 'submit_page' value='$i'>$i</button>";
                }
                echo "</form></div>";
            }
        } else if(!$page_repo) {
            echo '<p class="error">User has no repositories</p>';
        } else {
            echo '<p class="error">User has no followers</p>';
        }
    } else if($status === 403){
        echo '<p class="error">Forbidden, API calls hourly limit exceeded, try again later</p>'; // error code 403 if API server forbids connection
    } else {
        echo '<p class="error">Error, invalid Github Username</p>'; // error message for other errors
    }
}