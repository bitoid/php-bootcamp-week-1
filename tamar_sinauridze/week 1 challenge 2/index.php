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

        <?php // validates username
        if(isset($_POST["submit"])) {
            if(empty($_POST["username"])) {
                $error = "username required";
            } else if (!preg_match("/^[a-zA-Z0-9-]{0,39}$/",$_POST["username"])) {
                $error = "Letters, numbers and dashes only, up to 39 characters";
            } else {
                $username = test_input($_POST["username"]);
            }
        }
        function test_input($data) {
            $data = trim($data);
            $data = stripslashes($data);
            $data = htmlspecialchars($data);
            return $data;
        }
        if(isset($error)) { ?>
            <p class="errmsg"><?php echo $error ?></p>
        <?php } ?>

        <?php 
        $num_rep=0;
        $num_fol=0;
        
        if(isset($username)) {
            $opts = [
                'http'=>[
                    'method'=>'GET',
                    'header'=>[
                        'User-Agent: PHP'
                    ],
                    'ignore_errors' => true
                ]
            ];
            $context= stream_context_create($opts);

            // gets information about the number of repositories and followers
            $user_info_json = file_get_contents("https://api.github.com/users/$username", false, $context);
            $user_info = json_decode($user_info_json, true) ?? false;
            $num_rep = $user_info["public_repos"] ?? 0;
            $num_fol = $user_info["followers"] ?? 0;
            ?>

            <?php // displays what information it retrieved from github
            if($user_info==false){ ?>
                <p class="errmsg">Couldn't retrieve data from github.</p>
            <?php } else if (isset($user_info["message"]) && $user_info["message"]==="Not Found") {
                $zen = file_get_contents("https://api.github.com/zen", false, $context); ?>
                <p>Couldn't find information about <i><?php echo $username ?></i>. You can read this random zen phrase from github instead:</p>
                <p class="zen"><?php echo $zen ?></p>
            <?php } else { ?>
                <h2><?php echo $username ?> has <?php echo $num_rep ?> repositories and <?php echo $num_fol ?> followers.</h2>
            <?php } ?>

            <?php // handles the radio buttons
            if($_POST["which_info"]=="followers") {
                $num_rep=0;
            }
            if($_POST["which_info"]=="repositories") {
                $num_fol=0;
            } 

            if($num_rep!=0 && $num_fol!=0){ ?>
                <p><a class="jump" href="#jump-to-followers">Jump to followers</a></p>
            <?php }
        } ?>

        <div class="container">

        <?php //gets information about repositories
        if($num_rep>0){
            $repos = [];
            $i=0;
            while($num_rep>100*$i) {
                $i++;
                $repos = array_merge($repos, json_decode(file_get_contents("https://api.github.com/users/$username/repos?per_page=100&page=$i", false, $context), true));
            } ?>

            <div class="repos">
            <h3>Repositories:</h3>
            <ol>
            <?php //displays information about repositories
            for($i=0; $i<$num_rep; $i++){ ?>
                <li><a href="<?php echo $repos[$i]["html_url"] ?>"><?php echo $repos[$i]["name"] ?></a></li>
            <?php } ?>
            </ol>
            </div>
        <?php } ?>

        <?php // gets information about followers
        if($num_fol>0){
            $fols = [];
            $i=0;
            while($num_fol>100*$i) {
                $i++;
                $fols = array_merge($fols, json_decode(file_get_contents("https://api.github.com/users/$username/followers?per_page=100&page=$i", false, $context), true));
            } ?>

            <div class="fols">
            <h3 id="jump-to-followers">Followers:</h3>
            <ol>
            <?php // displays information about followers
            for($i=0; $i<$num_fol; $i++){ ?>
                <li><a href="<?php echo $fols[$i]["html_url"] ?>"><img src="<?php echo $fols[$i]["avatar_url"] ?>" alt=""><span class="login"><?php echo $fols[$i]["login"] ?></span></a></li>
            <?php }?>
            </ol>
            </div>
        <?php } ?>
        </div>
    </body>
</html>
