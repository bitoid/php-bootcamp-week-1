<?php
if (isset($_POST['btn']) && $_POST["user"] != "") {

    $user = $_POST["user"];
    $opt = $_POST["opt"];

    $service_url_repo = "https://api.github.com/users/" . $user . "/repos";
    $service_url_followers = "https://api.github.com/users/" . $user . "/followers";

    $curl_repo = curl_init($service_url_repo);
    $curl_followers = curl_init($service_url_followers);

    curl_setopt($curl_repo, CURLOPT_RETURNTRANSFER, true);
    curl_setopt($curl_repo, CURLOPT_POST, false);
    curl_setopt($curl_repo, CURLOPT_SSL_VERIFYPEER, false);
    curl_setopt($curl_repo, CURLOPT_USERAGENT, "Github Api in Curl");

    curl_setopt($curl_followers, CURLOPT_RETURNTRANSFER, true);
    curl_setopt($curl_followers, CURLOPT_POST, false);
    curl_setopt($curl_followers, CURLOPT_SSL_VERIFYPEER, false);
    curl_setopt($curl_followers, CURLOPT_USERAGENT, "Github Api in Curl");

    $curl_response_repo = curl_exec($curl_repo);
    curl_close($curl_repo);

    $curl_response_followers = curl_exec($curl_followers);
    curl_close($curl_followers);

    $jsons_repo = json_decode($curl_response_repo);

    $jsons_followers = json_decode($curl_response_followers);
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Challange 2</title>

    <link rel="stylesheet" href="style.css">
</head>


<body>
    <div class="wrapper">
        <div class="formContainer">
            <form action="index.php" method="post">
                <div class="inputContainer">
                    <label for="user">Please Input Desired Info!</label>
                    <input type="text" placeholder="HenryDarts" id="user" name="user">
                </div>

                <select name="opt" class="opt">
                    <option value="both">Everything</option>
                    <option value="repo">Repository</option>
                    <option value="followers">Followers</option>
                </select>

                <button type="submit" name="btn">SEARCH</button>
            </form>
        </div>
    </div>

    <div class="infoContainer">
        <?php if (isset($_POST['btn']) && $opt == "both" && !empty($jsons_repo)) : ?>
            <?php foreach ($jsons_repo as $data) : ?>
                <h2>name: <?php echo $data->name; ?></h2>
                <p>id: <?php echo $data->id; ?></p>
                <p>full_name: <?php echo $data->full_name; ?></p>
                <p>login: <?php echo $data->owner->login; ?></p>
                <p>followers_url: <?php echo $data->owner->followers_url; ?></p>
                <p>deployments_url: <?php echo $data->deployments_url; ?></p>
                <p>created_at: <?php echo $data->created_at; ?></p>
                <p>updated_at: <?php echo $data->updated_at; ?></p>
                <p>pushed_at: <?php echo $data->pushed_at; ?></p>
                <p>git_url: <?php echo $data->git_url; ?></p>
                <p>clone_url: <?php echo $data->clone_url; ?></p>
                <p>ssh_url: <?php echo $data->ssh_url; ?></p>
                <p>svn_url: <?php echo $data->svn_url; ?></p>
                <p>visibility: <?php echo $data->visibility; ?></p>
                <p>default_branch: <?php echo $data->default_branch; ?></p>
                <hr style="background-color:white; width: 90%;">
            <?php endforeach ?>

            <?php foreach ($jsons_followers as $data) : ?>
                <h2><?php echo $data->login; ?></h2>
                <img src="<?php echo $data->avatar_url; ?>">
            <?php endforeach ?>

        <?php elseif (isset($_POST['btn']) && $opt == "repo" && !empty($jsons_repo)) : ?>
            <?php foreach ($jsons_repo as $data) : ?>
                <h2>name: <?php echo $data->name; ?></h2>
                <p>id: <?php echo $data->id; ?></p>
                <p>full_name: <?php echo $data->full_name; ?></p>
                <p>login: <?php echo $data->owner->login; ?></p>
                <p>followers_url: <?php echo $data->owner->followers_url; ?></p>
                <p>deployments_url: <?php echo $data->deployments_url; ?></p>
                <p>created_at: <?php echo $data->created_at; ?></p>
                <p>updated_at: <?php echo $data->updated_at; ?></p>
                <p>pushed_at: <?php echo $data->pushed_at; ?></p>
                <p>git_url: <?php echo $data->git_url; ?></p>
                <p>clone_url: <?php echo $data->clone_url; ?></p>
                <p>ssh_url: <?php echo $data->ssh_url; ?></p>
                <p>svn_url: <?php echo $data->svn_url; ?></p>
                <p>visibility: <?php echo $data->visibility; ?></p>
                <p>default_branch: <?php echo $data->default_branch; ?></p>
                <hr style="background-color:white; width: 90%;">
            <?php endforeach ?>

        <?php elseif (isset($_POST['btn']) && $opt == "followers" && !empty($jsons_followers)) : ?>

            <?php foreach ($jsons_followers as $data) : ?>
                <h2><?php echo $data->login; ?></h2>
                <img src="<?php echo $data->avatar_url; ?>">
            <?php endforeach ?>

        <?php endif ?>

    </div>
</body>

</html>
