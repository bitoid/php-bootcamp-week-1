
<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Document</title>
        <link rel="stylesheet" href="style.css" />
    </head>
    <body>
        <header>
            <form action="/challenge1.2/index.php" method="post">
                <input type="text" placeholder="Username" name="username"/>
                <button type="submit" name="submit">Search</button>
            </form>
        </header>
        <main>
            <div class="repositories">
                <h1>Repositories</h1>
                <ul>
                    <?php 
                        $context = stream_context_create(
                            array(
                                "http" => array(
                                    "header" => "User-Agent: Mozilla/5.0 (Windows NT 10.0; WOW64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/50.0.2661.102 Safari/537.36"
                                )
                            )
                        );


                        if(isset($_POST["submit"]) && $_POST["username"]){

                            $username = $_POST['username'];
                        
                            $repos_res = file_get_contents("https://api.github.com/users/$username/repos", false , $context);
            
                            $repositories = json_decode($repos_res, true);

                            foreach($repositories as $repo){
                                $url = $repo["html_url"];
                                $name = $repo["name"];
                                echo "<li><a href='$url'>$name</a></li>";
                            
                            }
                        }
                    ?>
                </ul>
            </div>
            <div class="followers">
                <h1>Followers</h1>
                <ul>
                <?php 

                    if(isset($_POST["submit"]) && $_POST["username"]){

                    $followers_res = file_get_contents("https://api.github.com/users/$username/followers", false, $context);
                    
                    $followers = json_decode($followers_res, true);
                    


                    foreach($followers as $follower){
                        $name = $follower["login"];
                        $image = $follower["avatar_url"];
                        $url = $follower["url"];
                        
                        $followers_content = <<<FOLLOWER

                            <li>
                                <a href='$url'>$name</a>
                                <img src='$image' alt='$name' width="200"/>
                            </li>
                        
                        FOLLOWER;

                        echo $followers_content;
                    }
                }
                ?>
                
                </ul>
            </div>
        </main>
    </body>
</html>


