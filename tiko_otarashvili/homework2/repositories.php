<?php
    $repo_amount = $result["public_repos"];
    $pages = intval(ceil ($repo_amount / 100));
    $count =1;
    for($i = 1; $i <= $pages; $i++){
    
        $curl = curl_init();
        curl_setopt_array($curl,[
          CURLOPT_RETURNTRANSFER => true,
          CURLOPT_URL => "https://api.github.com/users/{$username}/repos?per_page=100&page={$i}",
          CURLOPT_USERAGENT => 'Github'
        ]);
        $response = curl_exec($curl);
        $information = json_decode($response, true);?>
       <?php foreach($information as $info){  ?>
          <tr>
            <th scope="row"><?php echo  $count++; ?></th>
            <td><img class="avatar_img" src="<?php echo $info["owner"]["avatar_url"];?>" alt="avatar image" ></td>
            <td><?php echo $info["full_name"];?></td>
            <td>  <a target="_blank" href="<?php echo $info["html_url"];?>"><?php echo $info["html_url"];?></a></td> 
          <tr>
    <?php } }?>