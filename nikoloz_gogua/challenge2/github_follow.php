
<?php
function followers($username, $param)
{
//get follow amount
    $data_follow = "https://api.github.com/users/"
        . $username;
    $context = stream_context_create($param);

    $user_info_json = file_get_contents($data_follow, false, $context);
    $user_info = json_decode($user_info_json, true) ?? false;
    $num_follow = $user_info["followers"] ?? 0;
//get info about followers
    $api_url_followers = "https://api.github.com/users/"
        . $username . "/followers?per_page=100";

    $result_followers = file_get_contents($api_url_followers, false, stream_context_create($param));
    $statuscode_followers = $http_response_header[0];
    $decoded_followers = json_decode($result_followers, true);

//invalid username
    ?>
<?php if ($statuscode_followers === "HTTP/1.1 404 Not Found") {?>
    <div class=error1><?="Invalid Username!"?></div>
    <?php // Api limit exceeded?>
  <?php } else if ($statuscode_followers === "HTTP/1.1 403 rate limit exceeded") {?>
    <div class=success><?="Api limit exceeded"?></div>
    <?php // 0 repositoy ?>
<?php } else if (empty($decoded_followers)) {?>
  <div class=success><?="$username has 0 follower"?></div>
  <?php //if everthing is ok ?>
<?php } else {?>

<div class=success><?=$username . "'s followers"?></div>



<table class="table table-hover">
<thead>
<tr class="bg-success" >
<th scope="col">#</th>
<th scope="col">Image</th>
<th scope="col"> Name</th>
</tr>
</thead>
<tbody>
<?php foreach ($decoded_followers as $index => $follow) {?>
<tr>
<th scope="row"><?=$index + 1?></th>
<th><img  src=<?=$follow["avatar_url"]?>/></th>
<th><a href=<?=$follow["html_url"]?>> <?=$follow["login"]?> </a></th>
</tr>
<?php }?>
</tbody>
</table>
<?php }?>



<?php
//pagination
    $numofpages_follow = floor(($num_follow / 100) + 1);

    ?>

<nav aria-label="Page navigation example">
  <ul class="pagination">

<?php for ($page = 1; $page <= $numofpages_follow; $page++) {?>
    <li class="page-item"><a name=<?="page" . $page?> class="page-link" href="input.php?page=<?=$page?>"><?=$page?></a></li>

    <?php }?>

  </ul>
</nav>

<?php
}
?>
