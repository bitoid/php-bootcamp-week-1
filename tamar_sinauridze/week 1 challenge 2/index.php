<!DOCTYPE html>
<html>
    <head>
        <link rel="stylesheet" href="styles.css">
    </head>
    <body>
        <h1>Enter a github user's username to display their repositories and followers</h1>
        <form action="index.php" method="post">
            <input type="text" name="username" placeholder="Enter username" pattern="[a-zA-Z0-9-]{1,39}" title="Letters, numbers and dashes only, up to 39 characters.">
            <input type="radio" name="which_info" value="repositories" id="repositories">
            <label for="repositories">Repositories</label>
            <input type="radio" name="which_info" value="followers" id="followers">
            <label for="followers">Followers</label>
            <input type="radio" name="which_info" value="both" id="both" checked>
            <label for="both">Both</label>
            <input type="submit" name="submit">
        </form>

        <?php
        $submitted = false;

        if(isset($_POST["submit"])) {
            // validates username
            if(empty($_POST["username"])) {
                echo '<p class="errmsg">username required</p>';
            } else {
                if (!preg_match("/^[a-zA-Z0-9-]{0,39}$/",$_POST["username"])) {
                    echo '<p class="errmsg">Letters, numbers and dashes only, up to 39 characters</p>';
                } else {
                    $username = test_input($_POST["username"]);
                    $submitted = true;
                }
            }
        }
        function test_input($data) {
            $data = trim($data);
            $data = stripslashes($data);
            $data = htmlspecialchars($data);
            return $data;
        }
        
        $numRep=0;
        $numFol=0;
        
        if($submitted) {
            // user agent header
            $opts = [
                'http'=>[
                    'method'=>'GET',
                    'header'=>[
                        'User-Agent: PHP'
                    ]
                ]
            ];
            $context= stream_context_create($opts);

            // gets information about the number of repositories and followers
            $userInfo = json_decode(file_get_contents("https://api.github.com/users/$username", false, $context), true) ?? false;
            $numRep = $userInfo["public_repos"] ?? 0;
            $numFol = $userInfo["followers"] ?? 0;

            // displays what information it retrieved from github
            if ($userInfo==false) {
                $zen = file_get_contents("https://api.github.com/zen", false, $context) ?? false;
                if($zen==false) {
                    echo '<p class="errmsg">Couldn\'t retrieve data from github.</p>';
                } else {
                    echo "<p>Couldn't find information about <i>$username</i>. You can read this random zen phrase from github instead:</p>";
                    echo "<p class=\"zen\">$zen</p>";
                }
            } else {
                echo "<h2>$username has $numRep repositories and $numFol followers.</h2>";
            }

            // handles the radio buttons
            if($_POST["which_info"]=="followers") {
                $numRep=0;
            }
            if($_POST["which_info"]=="repositories") {
                $numFol=0;
            }

            if($numRep!=0 && $numFol!=0){
                echo '<p><a class="jump" href="#jump-to-followers">Jump to followers</a></p>';
            }
        }

        echo '<div class="container">';
        //gets information about repositories
        if($numRep>0) {
            echo '<div class="repos">';
            $repos = [];
            $i=0;
            while($numRep>100*$i) {
                $i++;
                $repos = array_merge($repos, json_decode(file_get_contents("https://api.github.com/users/$username/repos?per_page=100&page=$i", false, $context), true));
            }
            //displays information about repositories
            echo "<h3>Repositories:</h3>";
            echo '<ol>';
            for($i=0; $i<$numRep; $i++){
                echo '<li><a href="' .  $repos[$i]["html_url"] . '">' . $repos[$i]["name"] . '</a></li>';
            }
            echo '</ol>';
            echo '</div>';
        }
        
        //gets information about followers
        if($numFol>0) {
            echo '<div class="fols">';
            $fols = [];
            $i=0;
            while($numFol>100*$i) {
                $i++;
                $fols = array_merge($fols, json_decode(file_get_contents("https://api.github.com/users/$username/followers?per_page=100&page=$i", false, $context), true));
            }
            //displays information about followers
            echo '<h3 id="jump-to-followers">Followers:</h3>';
            echo '<ol>';
            for($i=0; $i<$numFol; $i++) {
                echo '<li><a href="' . $fols[$i]["html_url"] . '"><img src="' . $fols[$i]["avatar_url"] . '" alt=""><span class="login">' . $fols[$i]["login"] . '</span></a></li>';
            }
            echo '</ol>';
            echo '</div>';
        }
        echo '</div>';
        ?>
    </body>
</html>
