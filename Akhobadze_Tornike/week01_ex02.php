<!doctype HTML>
<html>
    <head>
        <meta charset="UTF-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Document</title>
    </head>

    <form action="/week01_ex02.php" method="POST">
        <input type="text" name="username" placeholder="User Name">
        <input type="submit" name="submit">
    </form>

    <?php
    
    $username = $_POST['username'];
    $url1 = 'https://api.github.com/users/'. $username .'/followers';
    $url2 = 'https://api.github.com/users/'. $username .'/repos';
    
    // Create a stream
    
    $opts = array(
        'http'=>array(
        'method'=>"GET",
        'header'=>'user-agent: Mozilla/5.0 (X11; Linux x86_64) AppleWebKit/537.36 
        (KHTML, like Gecko) Chrome/101.0.4951.54 Safari/537.36'
        )
    );
    
    $context = stream_context_create($opts);

    
    $file_one = file_get_contents($url1, false, $context);
    $file_two = file_get_contents($url2, false, $context);

    file_put_contents('followers.json', $file_one);
    file_put_contents('repos.json', $file_two);


    $json1 = file_get_contents('followers.json');
    $json_data1 = json_decode($json1,true);

    $json2 = file_get_contents('repos.json');
    $json_data2 = json_decode($json2,true);

    for ($i = 0; $i < 30; $i++) {
        // print "<br>";
        // print_r($json_data1[$i]['login']);
        print "follower ". $i . ": " . $json_data1[$i]['login'] . "<br>";
        print "repo " . $i . ": " . $json_data2[$i]['name'] . "  id: " . $json_data2[$i]['id'] .  "<br>";
    }
    ?>
</html>