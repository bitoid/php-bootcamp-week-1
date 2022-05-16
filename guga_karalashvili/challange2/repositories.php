<!--
    Take info from github api with curl about repositories of user
-->
<?php
require_once './userInfo.php';
$perPage=30;
$page=1;
$allPageRepos = ceil($reposNum/$perPage);
$allRepos =[];
if($allPageRepos > 0 && $reposNum > 0){
    for($i=0 ; $i<$allPageRepos; $i++){
        $url = "https://api.github.com/users/$usrName/repos" . "?per_page=$perPage&page=$page";
        $resource = curl_init($url);
        curl_setopt_array($resource, [
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_USERAGENT => 'PHP'
        ]);
        $result = curl_exec($resource);
        $reposArray= json_decode($result, false);
        array_push($allRepos, ...$reposArray);
        $page++;
    }
}else {
    echo '<p class="userError">there is no repositories &#128533</p>';
}

?>
<!-- 
    Display all repositories with name and description
-->
<?php foreach($allRepos as $obj): ?>
    
<div class="style">
    <a href="<?php echo $obj->html_url;?>" target="_blank"><?php echo $obj->name;?></a><!--
--> <p><?php echo $obj->description;?></p>
</div>
<?php endforeach ?>

