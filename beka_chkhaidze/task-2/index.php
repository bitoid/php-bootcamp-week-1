<?php
    require_once "./helpers.php";

    $username = $_POST['username'];
    $sent = (bool)isset($_POST['fetch']);
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>დავალება #2</title>
    <link rel="stylesheet" href="./assets/style.css">
</head>
<body>
    <main class="container">
        <form action="." method="POST" class="form">
            <input type="text" name="username" placeholder="username" value="<?php echo $username; ?>" />
            <input type="submit" value="fetch" name="fetch" />
        </form>


        <div class="summary">
            <?php
                if (!empty($username)) {
                    get_basic_info($username);
                    $user_exist = check_user_existence();
                    
                    if (!$user_exist) {
                        echo "<div class='error'>user \"" . htmlspecialchars($username, ENT_QUOTES, 'UTF-8') . "\" doesn't exist</div>";
                    } else {
                        $repos = fetch_data($username,"repos");
                        $followers = fetch_data($username,"followers");
                        // print_r($followers);

                        echo '<p class="intro">Repositories:</p><ul class="repos items">';
                        foreach($repos as $repo) {
                            echo "<li class='items__item'><a href='" . $repo->html_url . "' target='blank'>" . $repo->full_name . "</a></li>";
                        }
                        echo '</ul>';

                        echo '<p class="intro">Followers:</p><ul class="items followers">';
                        foreach($followers as $follower) {
                            echo "<li class='items__item followers__item'>
                                <a href='" . $follower->html_url . "' target='blank'>
                                    <img src='" . $follower->avatar_url ." alt='" . $follower->html_url . "'/>
                                    <p>" . $follower->login . "</p>
                                </a>
                            </li>";
                        }
                        echo '</ul>';
                    }
                }
            ?>
        </div>
    </main>
</body>
</html>