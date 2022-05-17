<!DODCTYPE html>
<html>
    <head>
        <title>gtihub api</title>
        <link rel='stylesheet' href='style/styles.css'>
    </head>
    <body>
        <form action='/' method='post'>
            <label for='search'>Enter github username</label>
            <input id='search'  name='username' type='text' placeholder='Enter username'>
            <input id='submit' type='submit' value='submit'>
        </form>
        <?php
             
            include 'get.php';
            $api_url = 'https://github.com/';
            if($_SERVER['REQUEST_METHOD'] === 'POST'){
                $user_name = $_POST['username'];
                $followers = fetch_user_followers($user_name);
                echo "<h2>$user_name Followers</h2>";
                echo "<div class='followers'>";
                
                foreach($followers as $follower){
                    echo 
                    "<div class='item'><a href='$follower->html_url'>$follower->login<img src=$follower->avatar_url alt='follower'>
                    </a></div>";
                }
                echo "</div>";
                $data = fetch_user_repo($user_name);
                echo "<h2>$user_name Repositories</h2>";
                echo "<ul class='repos'>";
                foreach($data as $repo){
                    echo "<li><a href=$repo->html_url><img id='folder' src='folder.png'>$repo->name</a></li>";
                }
                echo "</ul>";

                
            }
        ?>
        
    </body>
</html>

