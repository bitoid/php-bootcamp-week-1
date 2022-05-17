<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
<?php
 function form($a, $b, $c, $d)
 {
     echo '<form action="results.php" method="POST"><div class="col d-flex justify-content-center">
<div class="card mb-3 w-50 border-0" style="max-width: 600px;">
 <div class="row g-0">
     <div class="col-md-4">
         <img src="' . $a . '" class="img-fluid img-thumbnail rounded-circle" alt="user" style="width: 200px">
     </div>
     <div class="col-md-8">
         <div class="card-body">
             <div class="mb-1">
                 <input type="text" class="form-control" id="user" name="user"
                        placeholder="Fill user name" value="' . $b . '">
             </div>
             <div class="mb-1">
                 <div class="input-group">
                     <input type="text" class="form-control" id="repos" name="repos" value="Repositories"
                            readonly>
                     <span class="input-group-text">' . $c . '</span>
                 </div>
             </div>
             <div class="mb-1">
                 <div class="input-group">
                     <input type="text" class="form-control" id="followers" name="followers"
                            value="Followers" readonly>
                     <span class="input-group-text">' . $d . '</span>
                 </div>
             </div>
             <button type="submit" name="preview" value="" class="btn btn-primary w-100">GET INFO
             </button>
         </div>
     </div>
 </div>
</div>
</div></form>';
 }

        if ($_POST != null) {

           
            $post = $_POST;

            if ($post['user'] != '') {
                $url = 'https://api.github.com/users/';
                $searchUserURL = 'https://api.github.com/search/users?q=';
                
                $perpage = 'per_page=';
                $page = 'page=1';
                $repo = '/repos';
                $fol = '/followers';
                $user = $post['user'];
                $param = [
                    'http' => [
                        'method' => 'GET',
                        'header' => [
                            'User-Agent: PHP'
                        ]
                    ]
                ];

               

                $json = file_get_contents($searchUserURL . $user, false, stream_context_create($param));
                $data = json_decode($json, true);
                if ($data['total_count'] != 0) {
                    //არსებული user -ის მონაცემების წამოღება
                    $json = file_get_contents($url . $user, false, stream_context_create($param));
                    $data = json_decode($json, true);
                    $nRepos = $data['public_repos']; 
                    $nFol = $data['followers']; 
                    $avatarURL = $data['avatar_url'];

                    
                    $n = 10;
                    $json = file_get_contents($url . $user . $repo . '?' . $perpage . $nRepos . '&' . $page, false, stream_context_create($param));
                    $dataREPO = json_decode($json, true);
                    $json = file_get_contents($url . $user . $fol . '?' . $perpage . $nFol . '&' . $page, false, stream_context_create($param));
                    $dataFOL = json_decode($json, true);

                    form($avatarURL, $user, $nRepos, $nFol);
                } else {
                    form('img/nonepawn.jpg', $user, 0, 0);
                }

            } else {
                form('img/nonepawn.jpg', '', 0, 0);
            }
        } else {
            form('img/pawn.jpg', '', 0, 0);
        }

?>
</body>
</html>