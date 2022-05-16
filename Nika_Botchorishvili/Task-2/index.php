<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Task 2</title>
    <link rel="stylesheet" href="./assets/style.css">
</head>
<body>
    <?php 
    $requestFor = isset($_POST['opt']) && !empty($_POST['opt'])? $_POST['opt']: "";
    $username = isset($_POST['username']) && !empty($_POST['username'])? $_POST['username']: null;

    $url = "https://api.github.com/users/{$username}/{$requestFor}";
    $ch = curl_init();

    curl_setopt($ch, CURLOPT_URL, $url);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    curl_setopt($ch, CURLOPT_HEADER, false);
    curl_setopt($ch, CURLOPT_USERAGENT, "test");

    $data = json_decode(curl_exec($ch));

    curl_close($ch);

    ?>

    <div class="container">
        <h1>Task 2</h1>
        <form action="" method="post">

            <div>
                <select name="opt">
                    <optgroup label="Choose">
                        <option value="repos">Repositories</option>
                        <option value="followers">Followers</option>
                    </optgroup>
                </select>
            </div>
            <div>
                <input type="text" name="username" placeholder="Enter UserName">
            </div>
            <div>
                <button>SUBMIT</button> 
            </div>
        </form>
    
        <?php $error = $username == null && isset($_POST)? "Please enter a username": ""; ?>
        <p id="error"><?= $error ?> </p>

        <?php if(empty($error)): ?>
            <div id="list">
                <table>
                    <tr>
                        <?= $requestFor == "repos"? "<th>Repositories</th>": "<th>Followers</th>\n<th>Profile Picture</th>"?>
                    </tr>
                        <?php foreach($data as $key => $value): ?>
                            <?php if($requestFor == "repos"): ?>
                                <tr>
                                    <td><?= $value->name ?></td>
                                </tr>
                            <?php endif; ?>
                            <?php if($requestFor == "followers"): ?>
                                <tr>
                                    <td><?= $value->login?></td>
                                    <td><img src="<?= $value->avatar_url ?>" alt="avatar url"></td>
                                </tr>
                            <?php endif; ?>
                        <?php endforeach; ?>
                </table>
            </div>
        <?php endif; ?>
    </div>

</body>
</html>