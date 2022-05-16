<?php 
    $type = '';
    $tf = null;
    
    if(isset($_POST['btn'])){
        $name = $_POST['name'];
        $type = $_POST['select'];
        $headers = [
            "User-Agent: Aleksandre",
            "Authorization:"
        ];
        $ch = curl_init("https://api.github.com/users/$name/$type");
        curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);

        $response = curl_exec($ch);
        curl_close($ch);

        $data = json_decode($response, true);
        $tf = true;
        if($type === 'option' || $type=== '' || empty($name)){
            echo "<div class='alert alert-danger'>Enter Name Or Select Option</div>";
            $tf = false;
        }

        
    }
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="app.css" rel="stylesheet" >
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.3.1/dist/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
    <title>Document</title>
</head>
<body>
    <form action="index.php" method="post">
        <div class="container">
            <input class="input" type="text" name="name" placeholder="Enter User Name">
            <br>
            <select class="select" name="select" style="margin-top: 10px">
            <option name="option" value="option">Select Option</option>
            <option name="repo" value="repos">Repository</option>
            <option name="followers" value="followers">Followers</option>
            </select>
            <button type="submit" class="btn btn-primary"   name="btn">Submit</button>
        </div>
    </form>

<?php if($tf === true): ?>
    <div class="show">
    <?php if($type === "repos"): ?>
    <table class="table table-striped">
        <thead>
            <tr style="text-align: center">
                <th >Name</th>
                <th>Description</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($data as $repository): ?>
                <tr style="text-align: center">
                    <td><a href="<?=$repository['html_url']  ?>" target="_blank"><?=$repository['name']?></a></td>
                    <td><?=$repository['description'] ?></td>
                </tr>
            <?php endforeach; ?>
        </tbody>
        </table>
        <?php endif ?>


            <?php if($type === "followers"): ?>
            <table class="table table-striped">
                <thead>
                    <tr style="text-align: center">
                        <th>Name</th>
                        <th>Image</th>
                    </tr>
                </thead>
            <tbody>
            <?php foreach ($data as $repository): ?>
                <tr style="text-align: center">
                    <td><a href="<?=$repository['html_url']?>"  target="_blank"><?=$repository['login']  ?></a></td>
                    <td><img src="<?=$repository['avatar_url'] ?>" width=70px; heigth = 70px;></td>
                </tr>
            <?php endforeach; ?>
            <?php endif; ?>
        </tbody>
    </table>
    </div>
<?php endif; ?>
</body>
</html>