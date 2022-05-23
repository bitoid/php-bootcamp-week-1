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

<?php  require_once 'header.php'  ?>

<body>
    <div class="wrapper">
        <div class="formContainer">
            <form action="index.php" method="post">
                <div class="inputContainer">
                    <label for="user"><strong>Username</strong></label>
                    <input type="text" placeholder=" " id="user" name="user">
                </div>

                <select name="opt" class="opt">
                    <option value="both">All</option>
                    <option value="repo">Repository</option>
                    <option value="followers">Followers</option>
                </select>

                <button class="but" type="submit" name="btn">SEARCH</button>
            </form>
        </div>
    </div>

   <?php require_once 'info.php'  ?>

