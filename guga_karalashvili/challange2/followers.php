<!--
    Take info from github api with file_get_contents about followers of user
-->
<?php
require_once './userInfo.php';
$perPage=100;
$page=1;
$allPageFollowers = ceil($followersNum/$perPage);
$allFollowers =[];
if($allPageFollowers > 0 && $followersNum > 0){
    for($i=0 ; $i<$allPageFollowers; $i++){
        $url = "https://api.github.com/users/$usrName/followers" . "?per_page=$perPage&page=$page";
        $param=[
                'http'=>[
                'method'=>'GET',
                'header'=>[
                    'User-Agent:PHP'
                ]
            ]
        ];

        $json = file_get_contents($url, false, stream_context_create($param));
        $result = json_decode($json, false);
        array_push($allFollowers, ...$result);
        $page++;
    }
}else {
    echo '<p class="userError">there is no followers &#128532</p>';
}

?>
<!-- 
    Display all followrs with image and login name
-->
<?php foreach($allFollowers as $obj) : ?>
    <div class="style">
        <a href=<?php echo $obj->html_url?> target="_blank"><img src=<?php echo $obj->avatar_url?>></a><!--
        --><h3><?php echo $obj->login ?></h3>
    </div>
<?php endforeach ?>
