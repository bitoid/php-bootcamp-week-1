<?php 
    $current_page = 1;
    $data = []; 
    $on_each_page = 100; 
?>

<?php 
    function getData($url){ // this function gets data from github
        $param = [
            'http' => [
                'method' => 'GET',
                'header' => [
                    'User-Agent: PHP'
                ]
            ],
            'ssl' => [
                'cafile' => '/path/to/bundle/cacert.pem',
                "verify_peer" => false,
                "verify_peer_name" => false
            ]
        ];

        $json = file_get_contents($url, true, stream_context_create($param));
        return json_decode($json, true);
    }
?>

<?php function renderData($data, $option, $i){ ?> <!-- this function renders data as a table rows -->
    <?php foreach($data as $val): ?>
        <?php 
            $name = $val['login'];
            if($option == "repos") {
                $name = $val['name'];
            }    
        ?>
            <tr>
                <td><?php echo $i ?></td>
                <?php if($option == "followers"): ?> 
                    <td><img src='<?php echo $val['avatar_url'] ?>' alt='fgh'></td> 
                <?php endif; ?>
                <td><?php echo $name ?></td>     
                <td><a href='<?php echo $val['html_url'] ?>'>go to <?php echo $option ?> </a></td>             
            </tr>
        <?php $i++; ?>
    <?php endforeach; ?>
<?php }; ?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0-beta1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-0evHe/X+R7YkIZDRvuzKMRqM+OrBnVFBL6DOitfPri4tjfHxaWutUpFmBp4vmVor" crossorigin="anonymous">
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <header>Week-1 <br> Task-2</header>
    <hr>

    <form action="/index.php" method="post"> <!-- main form -->
        <select name="dropdown">
            <option value="followers">followers</option>
            <option value="repos">repositories</option>
        </select>
        <input type="text"name="username" placeholder="User Name">
        <button type="submit" class="btn btn-outline-dark btn-sm">click</button>
    </form>
    
    <table class="table table-dark table-striped">
        <?php if(isset($_POST['username'])): ?>
            <tr>
                <th>N</th>
                <?php if($_POST["dropdown"] === 'followers'): ?>
                    <th>img</th>
                <?php endif ?>
                <th>name</th>
                <th>link</th>
            </tr>
            <?php
                $username = $_POST["username"];
                $option = $_POST["dropdown"];
                    
                $i = 1;
                do { // use do/while to send requests
                    $url = "https://api.github.com/users/$username/$option?page=$current_page&per_page=$on_each_page";
                    $data = getData($url);
                    if(empty($data) && $i === 1) { // if no user or at least one repos/followers was found 
                        echo "No more/eny repos or followers finded!";
                    }
                    renderData($data, $option, $i);

                    $i += $on_each_page; 
                    $current_page++; 
                }while (count($data) === 100);
            ?>
        <?php endif; ?>
    </table>
</body>
</html>