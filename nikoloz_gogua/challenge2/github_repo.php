<?php

function repos($username, $param)
{
    //get repo amount info
    $page = 1;
    $context = stream_context_create($param);

    $data_repos = "https://api.github.com/users/"
        . $username;

    $user_info_json = file_get_contents($data_repos, false, $context);
    $user_info = json_decode($user_info_json, true) ?? false;
    $num_rep = $user_info["public_repos"] ?? 0;

    //repo get info
    $api_url_repos = "https://api.github.com/users/"
        . $username . "/repos?per_page=100&&page=" . $page;

    $result_repos = file_get_contents($api_url_repos, false, $context);
    $statuscode_repos = $http_response_header[0];
    $decoded_repos = json_decode($result_repos, true);

    //invalid username
    ?>
<?php if ($statuscode_repos === "HTTP/1.1 404 Not Found") {?>
  <div class=error1><?="Invalid Username!"?></div>;
    <?php // 0 repository?>
  <?php } else if (empty($decoded_repos)) {?>
    <div class=success><?="$username has 0 repository"?></div>


<?php // if everything is ok prints repositories table ?>
<?php } else {?>



<div class=success><?=$username . "'s repositories"?></div>




<table class="table table-hover">
<thead>
<tr class="bg-success">
<th scope="col">#</th>
<th scope="col"> Repository Name</th>
<th scope="col"> Decription</th>
</tr>
</thead>
<tbody>
<?php foreach ($decoded_repos as $index => $repo) {?>
<tr>
<th scope="row"><?=$index + 1?></th>
<th> <a href=<?=$repo["html_url"]?>><?=$repo["name"]?></a> </th>
<th><?=$repo["description"]?></th>
</tr>
<?php }?>
</tbody>

</table>




<?php
$numofpages_rep = floor(($num_rep / 100) + 1);

        ?>

<nav aria-label="Page navigation example">
  <ul class="pagination">

<?php for ($page = 1; $page <= $numofpages_rep; $page++) {?>
    <li class="page-item"><a name="page"<?=$page?> class="page-link" href="input.php?page=<?=$page?>"><?=$page?></a></li>

    <?php }?>

  </ul>
</nav>

<?php }?>


<?php }?>








