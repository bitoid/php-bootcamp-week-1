<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://getbootstrap.com/docs/5.3/assets/css/docs.css" rel="stylesheet">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.x.x/css/bootstrap.min.css">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>
    <script src="https://code.jquery.com/jquery-3.x.x.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.x.x/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.x.x/js/bootstrap.min.js"></script>

    <title>Github Information</title>
</head>
<body>

<form action="" method="post">
    <div class="form-group">
        <label for="username">Github Username</label>
        <input type="text" class="form-control" name="username" id="username">
    </div>
    <div class="form-group">
        <div class="form-check">
            <input class="form-check-input" type="radio" name="info_type" value="repositories" id="repositories">
            <label class="form-check-label" for="repositories">
                Repositories
            </label>
        </div>
        <div class="form-check">
            <input class="form-check-input" type="radio" name="info_type" value="followers" id="followers">
            <label class="form-check-label" for="followers">
                Followers
            </label>
        </div>
    </div>
    <button type="submit" class="btn btn-primary">Submit</button>
</form>


<?php
if (isset($_POST['username'])) {
    $username = $_POST['username'];
    $info_type = $_POST['info_type'];

    if ($info_type == "repositories") {
        $url = "https://api.github.com/users/" . $username . "/repos";
    } else {
        $url = "https://api.github.com/users/" . $username . "/followers";
    }

    $options = array(
        'http' => array(
            'method' => 'GET',
            'header' => 'User-Agent: Awesome-Octocat-App'
        )
    );
    $context = stream_context_create($options);
    $response = file_get_contents($url, false, $context);

    $data = json_decode($response);

    if ($info_type == "repositories") {
        echo "<h2 class='text-center mb-4'>Repositories for " . $username . "</h2>";
        echo "<ul class='list-group'>";
        foreach ($data as $repo) {
            echo "<li class='list-group-item'><a href='" . $repo->html_url . "'>" . $repo->name . "</a></li>";
        }
        echo "</ul>";
    } else {
        echo "<h2 class='text-center mb-4'>Followers for " . $username . "</h2>";
        echo "<ul class='list-group'>";
        foreach ($data as $follower) {
            echo "<li class='list-group-item'><a href='" . $follower->html_url
                . "'><img class='rounded-circle'  src='"
                . $follower->avatar_url . "' > " . $follower->login . "</a></li>";
        }
        echo "</ul>";
    }
}
?>


</body>
</html>
