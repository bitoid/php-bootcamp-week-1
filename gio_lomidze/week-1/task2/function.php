<?php

$per_page = 30; // show items per page
$page_num = isset($_GET['submit_page']) ? $_GET['submit_page'] : 1; // if pages don't exist, equals to 1

?>

<?php if(isset($_GET['submit']) || isset($_GET['submit_page'])) : ?>

    <?php 
    // ******************* fetch general information about an user ********* //

    $url_info = "https://api.github.com/users/$user";
    $curl_info = curl_init($url_info);

    curl_setopt($curl_info, CURLOPT_URL, $url_info);
    curl_setopt($curl_info, CURLOPT_RETURNTRANSFER, true);

    $headers = array(
        "User-Agent: ReqBin Curl Client/1.0",
        );

    curl_setopt($curl_info, CURLOPT_HTTPHEADER, $headers);
    $response_info = curl_exec($curl_info);

    $data_info = json_decode($response_info, true);

    curl_close($curl_info);
    
    //****************** end of user information fetch *****************//

    if(isset($data_info['public_repos']) && isset($data_info['followers'])) {
        $total_repo = $data_info['public_repos']; // total repositories of an user
        $total_repo > 1 ? $s_plural_repo = 's' : $s_plural_repo = ''; //for plural -> repo(s)
        $page_repo = ceil($total_repo / $per_page); // count pages

        $total_follow = $data_info['followers']; // total followers of an user
        $total_follow > 1 ? $s_plural_follow = 's' : $s_plural_follow = ''; //for plural -> follower(s)
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
    ?>

    <?php if($status === 200) : ?>

       <?php if($info === 'repos' && $page_repo > 0) : ?>
            <h2>Repo<?= $s_plural_repo ?> of <b><?= $user ?></b>:</h2><br>
            <?php foreach($data as $key => $val) : ?>
 
                    <div class='repo'>
                        <span><?= $key + 1 + ($page_num - 1) * 30 ?>)</span>
                        <a href='<?= $val['owner']['html_url'] . '/' . $val['name'] ?>' target='_blank'>
                        <p><?= $val['name'] ?></p>
                    </a></div>
            <?php endforeach ?>

            <?php if($page_repo >= 1 || isset($_GET['submit_page'])) : ?>
                
                <div class='pagination'>
                    <form action='' method='GET'>
                        <?php for($i=1; $i < $page_repo + 1; $i++) : ?>
                            <?php $page_num == $i ? $active = 'active' : $active = ''; // class 'active' highlights current page ?>
                            
                            <button class='<?= $active ?>' type = 'submit' name = 'submit_page' value='<?= $i ?>'><?= $i ?></button>
                        <?php endfor ?>
                    </form>
                </div>

            <?php endif ?>
        <?php elseif($info === 'followers' && $page_follow > 0) : ?>
            <h2>Follower<?= $s_plural_follow ?>of <b><?= $user ?></b>:</h2><br>
            <?php foreach($data as $val) : ?>

                    <p><?= $val['login'] ?></p>
                    <div class='img_wrap'>
                        <a href='<?= $val['html_url'] ?>' target='_blank'>
                            <img src='<?= $val['avatar_url'] ?>'>
                        </a>
                    </div>

            <?php endforeach ?>

            <?php if($page_follow >= 1 && (isset($_GET['submit_page']) || isset($_GET['submit']))) : ?>
                <div class='pagination'><form action='' method='GET'>
                    <?php for($i=1; $i < $page_follow + 1; $i++) : ?>
                        <?php $page_num == $i ? $active = 'active' : $active = ''; // class 'active' highlights current page ?>

                        <button class='<?= $active ?>' type = 'submit' name = 'submit_page' value='<?= $i ?>'><?= $i ?></button>
                    <?php endfor ?>
                </form>
                </div>
            <?php endif ?>
        <?php elseif(!$page_repo) : ?>
            <p class="error">User has no repositories</p>
        <?php else : ?>
            <p class="error">User has no followers</p>
        <?php endif ?>

    <?php elseif($status === 403) : ?>

        <p class="error">Forbidden, API calls hourly limit exceeded, try again later</p>

    <?php else : ?>

        <p class="error">Error, invalid Github Username</p>

    <?php endif ?>
<?php endif ?>