<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Challange 2</title>

    <link rel="stylesheet" href="style.css">
</head>
v

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
        <?php
        if (isset($_POST['btn']) && $_POST["user"] != "") {

            $user = $_POST["user"];
            $opt = $_POST["opt"];

            if ($opt == "both") {
                $service_url = "https://api.github.com/users/" . $user . "/repos";
                $service_url2 = "https://api.github.com/users/" . $user . "/followers";

                $curl = curl_init($service_url);
                $curl2 = curl_init($service_url2);

                curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
                curl_setopt($curl, CURLOPT_POST, false);
                curl_setopt($curl, CURLOPT_SSL_VERIFYPEER, false);
                curl_setopt($curl, CURLOPT_USERAGENT, "Github Api in Curl");

                curl_setopt($curl2, CURLOPT_RETURNTRANSFER, true);
                curl_setopt($curl2, CURLOPT_POST, false);
                curl_setopt($curl2, CURLOPT_SSL_VERIFYPEER, false);
                curl_setopt($curl2, CURLOPT_USERAGENT, "Github Api in Curl");

                $curl_response = curl_exec($curl);
                curl_close($curl);

                $curl_response2 = curl_exec($curl2);
                curl_close($curl2);

                $jsons = json_decode($curl_response);

                $jsons2 = json_decode($curl_response2);


                if (!empty($jsons)) {
                    foreach ($jsons as $data) {
                        $_id = $data->id;
                        $name = $data->name;
                        $full_name = $data->full_name;
                        $login = $data->owner->login;
                        $followers_url = $data->owner->followers_url;
                        $deployments_url = $data->deployments_url;
                        $created_at = $data->created_at;
                        $updated_at = $data->updated_at;
                        $pushed_at = $data->pushed_at;
                        $git_url = $data->git_url;
                        $ssh_url = $data->ssh_url;
                        $clone_url = $data->clone_url;
                        $svn_url = $data->svn_url;
                        $visibility = $data->visibility;
                        $default_branch = $data->default_branch;

                        echo "<h2>name: " . $name . "</h2>";
                        echo "<p>id: " . $_id . "</p>";
                        echo "<p>full_name: " . $full_name . "</p>";
                        echo "<p>login: " . $login . "</p>";
                        echo "<p>followers_url: " . $followers_url . "</p>";
                        echo "<p>deployments_url: " . $deployments_url . "</p>";
                        echo "<p>created_at: " . $created_at . "</p>";
                        echo "<p>updated_at: " . $updated_at . "</p>";
                        echo "<p>pushed_at: " . $pushed_at . "</p>";
                        echo "<p>git_url: " . $git_url . "</p>";
                        echo "<p>clone_url: " . $clone_url . "</p>";
                        echo "<p>svn_url: " . $svn_url . "</p>";
                        echo "<p>visibility: " . $visibility . "</p>";
                        echo "<p>default_branch: " . $default_branch . "</p>";

                        echo '<hr style="background-color:white; width: 90%;">';
                    }
                } else {
                    echo "Repos Were Not Found!";
                    echo '<hr style="background-color:white; width: 90%;">';
                }

                if (!empty($jsons2)) {
                    foreach ($jsons2 as $data2) {
                        $img = $data2->avatar_url;
                        $foloerName = $data2->login;
                        echo "<h2>" . $foloerName . "</h2>";
                        echo '<img src="' . $img . '">';
                    }
                } else {
                    echo "Followers Were Not Found!";
                    echo '<hr style="background-color:white; width: 90%;">';
                }
            }
            else if ($opt == "repo") {
                $service_url = "https://api.github.com/users/" . $user . "/repos";

                $curl = curl_init($service_url);

                curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
                curl_setopt($curl, CURLOPT_POST, false);
                curl_setopt($curl, CURLOPT_SSL_VERIFYPEER, false);
                curl_setopt($curl, CURLOPT_USERAGENT, "Github Api in Curl");

                $curl_response = curl_exec($curl);
                curl_close($curl);

                $jsons = json_decode($curl_response);

                if (!empty($jsons)) {
                    foreach ($jsons as $data) {
                        $_id = $data->id;
                        $name = $data->name;
                        $full_name = $data->full_name;
                        $login = $data->owner->login;
                        $followers_url = $data->owner->followers_url;
                        $deployments_url = $data->deployments_url;
                        $created_at = $data->created_at;
                        $updated_at = $data->updated_at;
                        $pushed_at = $data->pushed_at;
                        $git_url = $data->git_url;
                        $ssh_url = $data->ssh_url;
                        $clone_url = $data->clone_url;
                        $svn_url = $data->svn_url;
                        $visibility = $data->visibility;
                        $default_branch = $data->default_branch;

                        echo "<h2>name: " . $name . "</h2>";
                        echo "<p>id: " . $_id . "</p>";
                        echo "<p>full_name: " . $full_name . "</p>";
                        echo "<p>login: " . $login . "</p>";
                        echo "<p>followers_url: " . $followers_url . "</p>";
                        echo "<p>deployments_url: " . $deployments_url . "</p>";
                        echo "<p>created_at: " . $created_at . "</p>";
                        echo "<p>updated_at: " . $updated_at . "</p>";
                        echo "<p>pushed_at: " . $pushed_at . "</p>";
                        echo "<p>git_url: " . $git_url . "</p>";
                        echo "<p>clone_url: " . $clone_url . "</p>";
                        echo "<p>svn_url: " . $svn_url . "</p>";
                        echo "<p>visibility: " . $visibility . "</p>";
                        echo "<p>default_branch: " . $default_branch . "</p>";

                        echo '<hr style="background-color:white; width: 90%;">';
                    }
                } else {
                    echo "No Repos Was Found!";
                    echo '<hr style="background-color:white; width: 90%;">';
                }
            } else {
                $service_url = "https://api.github.com/users/" . $user . "/followers";

                $curl = curl_init($service_url);

                curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
                curl_setopt($curl, CURLOPT_POST, false);
                curl_setopt($curl, CURLOPT_SSL_VERIFYPEER, false);
                curl_setopt($curl, CURLOPT_USERAGENT, "Github Api in Curl");

                $curl_response = curl_exec($curl);
                curl_close($curl);

                $jsons = json_decode($curl_response);

                if (!empty($jsons)) {
                    foreach ($jsons as $data) {
                        $img = $data->avatar_url;
                        $foloerName = $data->login;
                        echo "<h2>" . $foloerName . "</h2>";
                        echo '<img src="' . $img . '">';
                    }
                } else {
                    echo "Nothing Was Found!";
                    echo '<hr style="background-color:white; width: 90%;">';
                }
            }
        } else {
            echo "Please Input Github User Name!";
            echo '<hr style="background-color:white; width: 90%;">';
        }
        ?>

    </div>
</body>

</html>