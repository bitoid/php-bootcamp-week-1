<?php
    $user = '';


    if(isset($_POST['ok'])){    
    $user = $_POST['subject'];

    $token = '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';

    
    $curl_token_auth = 'Authorization: token ' . $token;
    $curl_url = 'https://api.github.com/users/' . $user . '/followers?per_page=100';
    $ch = curl_init($curl_url);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
    curl_setopt($ch, CURLOPT_HTTPHEADER, array('User-Agent: Awesome-Octocat-App', $curl_token_auth));
    $output = curl_exec($ch);  
    $output = json_decode($output);
    curl_close($ch);
    
    
    $headers = [
        'User-Agent: Example REST API Client',
        'Authentication: token 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'
    ];
    
    $chuser = curl_init('https://api.github.com/users/'. $user .'/repos');
    
    curl_setopt($chuser, CURLOPT_HTTPHEADER, $headers);
    curl_setopt($chuser, CURLOPT_RETURNTRANSFER, true);
    
    $response = curl_exec($chuser);
    
    curl_close($chuser); 
    
    $data = json_decode($response, true);
    
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <link rel="stylesheet" href="style.css">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <form action="" method="post" class="form">
        <input type="text" name="subject" id="subject">
        <button type="submit" name="ok" class="btn btn-outline-dark">Submit</button>
    </form>
    <div class="result">
    <table class="table">
        <thead class="table-dark">
            <tr>
                <th>Name</th>
                <th>Description</th>
            </tr>
        </thead>
        <tbody>
            
            <?php foreach ($data as $repository): ?>
                
                <tr>
                    <td>
                        <a href="show.php?full_name=<?= $repository["full_name"] ?>">
                            <?= $repository["name"] ?>
                        </a>
                    </td>
                    <td><?= htmlspecialchars($repository["description"]) ?></td>
                </tr>
                
            <?php endforeach; ?>
            
        </tbody>
    </table>

        <table class="table">
            <thead class="table-dark">
                <tr>
                    <th>Followers</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($output as $repo) :?> 
                    <tr>
                        <td><?= '<a href="' . $repo->html_url . '">' . $repo->login . '</a><br />'; ?></td>
                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table>

       
    </div>
</body>
</html>