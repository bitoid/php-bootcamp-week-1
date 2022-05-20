<?php
    $follower_amount = $result["followers"];
    $pages = intval(ceil ($follower_amount / 100));
    $count = 1;
    for($i = 1; $i <= $pages; $i++){
        $curl = curl_init();
        curl_setopt_array($curl,[
          CURLOPT_RETURNTRANSFER => true,
          CURLOPT_URL => "https://api.github.com/users/{$username}/followers?per_page=100&page={$i}",
          CURLOPT_USERAGENT => 'Github'
        ]);
        
        $response = curl_exec($curl);
        $followers = json_decode($response, true);?>
       <?php foreach($followers as $follower){  ?>
        <tr>
    <th scope="row"><?php echo $count++; ?></th>
    <td><img class="avatar_img" src="<?php echo $follower["avatar_url"];?>" alt="user_img"></td>
    <td><?php echo $follower["login"];?></td>
    <td> <a target="_blank" href="<?php echo $follower["html_url"];?>"><?php echo $follower["html_url"];?></a></td>
  <tr>
    <?php } }?>