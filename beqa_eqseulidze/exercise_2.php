<?php
$user = '';
$service = '';
$erorstatus;
$gitData;
if ($_SERVER["REQUEST_METHOD"] == "POST") {        
    if (isset($_POST['radio']) && $_POST['search']!='') {
        $user = $_POST['search'];
        $service = $_POST['radio'];
    } else {
        $erorstatus = 'Enter user name end check chechbox';
    }
}
?>

<?php
$header = [
    "User-Agent: Example REST API Client",
    "Authorization: token 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"
];
$repoORfollowers = $service;

$url = "https://api.github.com/users/" . $user . "/" . $repoORfollowers . "?page=1&per_page=100";

$ch = curl_init($url);
curl_setopt($ch, CURLOPT_HTTPHEADER, $header);
curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
$result = curl_exec($ch);
$httpcode = curl_getinfo($ch, CURLINFO_HTTP_CODE);
curl_close($ch);
if ($httpcode!=200){
    $none='none';
    $erorstatus = 'Enter user name end check chechbox';
}else{
$gitData = json_decode($result, true);
  }

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>gitHub api</title>
    <link rel="stylesheet" href="./style.css">
</head>

<body>
    <main>
        <fieldset>
            <legend>Search GitHub Users</legend>
            <form action="" method="post" enctype="multipart/form-data">
                <?php
                if (isset($erorstatus)) {
                    echo '<p class="error">' . $erorstatus . ' </p>';
                }
                ?>
                <div class='container'>
                    <label class='search' for="search">Enter User Name</label>
                    <input class='search' type="text" name="search" value="">
                </div>

                <div class="radio">
                    <label for="radio">User Repositories</label>
                    <input type="radio" name="radio" value="repos">
                </div>
                <div class="radio">
                    <label for="radio"> User Followers</label>
                    <input type="radio" name="radio" value="followers">
                </div>

                <div class='submit'>
                    <input type="submit" value="Search">
                </div>
            </form>
        </fieldset>


<div class="content" style="display:<?php echo $none ?>">
        <?php
        if ($repoORfollowers === "repos") {
            echo ' <p>Searched :' . sizeof($gitData) . ' Repositories </p> <br>';
           
            foreach ($gitData as $i) {
                echo  "<a  target='blank'; href='" . $i["html_url"] . "'>  " . $i["name"] . "  </a> <br>";
              
            };
        } else if ($repoORfollowers === "followers") {
            echo ' <p>Searched :' . sizeof($gitData) . ' Followers </p> <br>';
            foreach ($gitData as $i) {
                echo "<a href='" . $i["html_url"] . "'> <span>" . $i["login"] . "</span> <img style='width:200px' src='" . $i["avatar_url"] . "' alt='photo'> </a> <br>";
            };
        };
        ?>
</div>


    </main>



</body>

</html>





















































<?php
// $header=[
//     "User-Agent: Example REST API Client",
//     "Authorization: token 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"
// ];

// $user='otarza';
// $repoORfollowers='repo';
// $url="https://api.github.com/users/".$user."/".$repoORfollowers."?page=1&per_page=100";
// $ch = curl_init($url);

// curl_setopt($ch,CURLOPT_HTTPHEADER,$header);
// curl_setopt($ch, CURLOPT_RETURNTRANSFER,true);

// $result=curl_exec($ch);

// curl_close($ch);
// $repoData=json_decode($result, true);
// echo sizeof($repoData)."<br>";
// //print_r($repoData);
// for ($i=0; $i<sizeof($repoData); $i++ ){
//     echo $repoData[$i]['name']."<br>";


// };

?>