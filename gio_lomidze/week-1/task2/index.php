<?php
session_start();

if(isset($_SESSION['gitName'])) {
    $user = $_SESSION['gitName'];
    $info = $_SESSION['github'];
} else {
    $user = [];
    $info = [];
}

if(isset($_GET['submit'])) {
    $user = $_GET['gitName'];
    $info = $_GET['github'];
}
$_SESSION['gitName'] = $user;
$_SESSION['github'] = $info;
?>

<!doctype HTML>
<html>
    <head>
        <meta content="width=device-width, user-scalable=no, initial-scale=1.0, minimal-ui" name='viewport'>
        <title>Submit form</title>
        <link href="css/reset.css" rel="stylesheet" type="text/css">        
        <link href="css/form.css" rel="stylesheet" type="text/css">
        <link rel="preconnect" href="https://fonts.googleapis.com">
        <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
        <link href="https://fonts.googleapis.com/css2?family=Roboto&display=swap" rel="stylesheet">
    </head>
    <body>
        <div class='wrapper'>
            <form action='' method='GET'>
            <h1>Github Info Generator 👇</h1>
                <input type='text' name='gitName' placeholder='Enter Github Username' <?php echo "value=$user"?> >
                <p>What do you want me to generate for you?</p>

                <div>
                    <input type="radio" id="rp" name="github" value="repos" <?php if($info === "repos") echo "checked"?>>
                    <label for="rp">Repositories</label>
                </div>
                <div>
                    <input type="radio" id="fl" name="github" value="followers" <?php if($info === "followers") echo "checked"?>>
                    <label for="fl">Followers</label>
                </div>
                <button type='submit' name='submit'>Submit</button>
            </form>

            <div class='result'>
                <?php
                    include 'function.php';
                ?>
            </div>
        </div>
    </body>
</html>