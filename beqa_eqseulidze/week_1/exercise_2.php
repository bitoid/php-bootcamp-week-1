

<?php
$user = '';
$repos = '';
$followers = '';
$erorstatus;
$gitData;
$service;
?>

<!-- =================== PHP BLOCK FOR VALIDATION=========== -->
<?php                                       
if ($_SERVER["REQUEST_METHOD"] == "POST") {  
    if( isset($_POST['followers']) || isset($_POST['repos'])){
        $service=true;
    }      
    if (isset($service) && $_POST['search']!='') {
        $user = $_POST['search'];        
        isset($_POST['repos']) ?  $repos=$_POST['repos']:  $repos='';
        isset($_POST['followers']) ?  $followers=$_POST['followers']:  $followers='';        
    } else {
         $erorstatus = 'Enter user name end check chechbox';
         $repos='';
         $followers='';
        }
    }
?>
  
<!--  ===================== PHP BLOCK FOR curl Authorization===================== -->
<?php
$header = [
    "User-Agent: Example REST API Client",
    "Authorization: token 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"
]; 
?>
<!--  ===================== PHP BLOCK TO FETCH DATAS FROM GitHub ===================== -->
<?php

//==========DATA ABOUT REPOS===============
$url1 = "https://api.github.com/users/" . $user . "/" . $repos . "?page=1&per_page=100"; 
$ch1 = curl_init($url1);
curl_setopt($ch1, CURLOPT_HTTPHEADER, $header);
curl_setopt($ch1, CURLOPT_RETURNTRANSFER, true);
$result1 = curl_exec($ch1);
curl_close($ch1);
$gitData1 = json_decode($result1, true);

//==========DATA ABOUT fOLLOWERS===============
$url2 = "https://api.github.com/users/" . $user . "/" . $followers . "?page=1&per_page=100"; 
$ch2 = curl_init($url2);
curl_setopt($ch2, CURLOPT_HTTPHEADER, $header);
curl_setopt($ch2, CURLOPT_RETURNTRANSFER, true);
$result2 = curl_exec($ch2);
curl_close($ch2);
$gitData2 = json_decode($result2, true);
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
                <?php if (isset($erorstatus)): ?>
                    <p class="error"><?php echo $erorstatus ?> </p>                
                <?php endif ?>
                <div class='container'>
                    <label class='search' for="search">Enter User Name</label>
                    <input class='search' type="text" name="search" value="">
                </div>
                <div class="radio">
                    <label for="repos">User Repositories</label>
                    <input type="checkbox" name="repos" value="repos">
                </div>
                <div class="radio">
                    <label for="followers"> User Followers</label>
                    <input type="checkbox" name="followers" value="followers">
                </div>
                <div class='submit'>
                    <input type="submit" value="Search">
                </div>
            </form>
        </fieldset>


<div class="content" >
        <?php
        if (  $repos!=''):?>
             <p> <?php echo 'Searched:'.sizeof($gitData1).' Repositories' ?> </p> <br>;           
            <?php foreach ($gitData1 as $gitData1) :?>
                <a  target='blank'; href='<?php echo $gitData1["html_url"] ?>'>  <?php echo $gitData1["name"] ?>  </a> <br>              
            <?php endforeach ?>;
            <?php endif ?>
        <?php 
        if ($followers!=''): ?>        
            <p> <?php echo 'Searched:'.sizeof($gitData2).' Followers' ?> </p> <br>
            <?php foreach ($gitData2 as $gitData2):?>
                <a  target='blank'; href='<?php echo $gitData2["html_url"] ?>'> <span><?php echo $gitData2["login"] ?> </span> <img style='width:200px' src='<?php echo $gitData2["avatar_url"] ?>' alt='photo'> </a> <br>
            <?php endforeach ?>
         <?php endif ?>
</div>

    </main>

</body>

</html>