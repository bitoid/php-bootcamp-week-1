<?php /* resourcess */

$name = $_POST['name'];
$type = "";
$alpha = "/^[a-zA-z]+$/";

//if ($_SERVER['REQUEST_METHOD'] === 'POST'){
    /* $name = $_POST['name'];
    $type = $_POST['repos' || 'followers']; */

    $headers = [
            "User-Agent: vaaakoo",
            "Authorization:"
    ];
        $resource = curl_init($url);
        curl_setopt($resource, CURLOPT_HTTPHEADER, $headers);
        curl_setopt($resource, CURLOPT_RETURNTRANSFER, true);
//}    

?>
<!DOCTYPE html>
<html lang="en">
     <head>
     <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>php browse</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="/style.css">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"></script>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.3.1/dist/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
     <title>HomeWork-2</title>
     </head>
<body>
    <div class="container p-5 my-5 bg-dark text-white">
        <center><h2>Lets Try : )) </h2><center></center>
            <form action="/index.php" method="POST">
                <label for="username" >Search people:</label>
                <input type="text" id="name" name="name" placeholder="Enter User Name" required>
                <input class="submit" type="submit" name="submit" value="Submit"><br>
                <input type="radio" id="repos" name="repository" value="repository">
                <label class="click" for="repos">repository</label>
                <input  type="radio" id="followers" name="followers" value="followers">
                <label class="click" for="followers">followers</label><br>     
            </form>
    </div>  
    <hr>
    <!-- repository php -->
    <div class="container p-3 mb-2 border bg-success">
        <?php if(isset($_POST['submit'])){
            if(preg_match($alpha, $name)){
                if(isset($_POST['repository'])){
            
            
                curl_setopt($resource, CURLOPT_URL, "https://api.github.com/users/"."$name"."/repos?page=1&per_page=10");
                
                $name = $_POST['name'];
                $response = curl_exec($resource);
                curl_close($resource);

                $data = json_decode($response, true); 

                foreach ($data as $repository) {
                echo "<pre>";
                //var_dump($repository["login"]); 
                var_dump($repository["owner"]);
                //var_dump($repository["html_url"]); 
                echo "</pre>";
                 "<br>";     
                }     
            } 
            }
        }
    ?>
    <!-- Followers php  -->
    <div class="content p-3 mb-2 bg-secondary">

    <?php  if(isset($_POST['submit'])){
            if(preg_match($alpha, $name)){
                if(isset($_POST['followers'])){
                
                    curl_setopt($resource, CURLOPT_URL, "https://api.github.com/users/"."$name"."/followers");
                    $name = $_POST['name'];
                    
                    $response = curl_exec($resource);
                    curl_close($resource);

                    $data = json_decode($response, true); 

                    foreach ($data as $repository) {
                    echo $repository["login"], "<br>",
                    "<img id='img' src='".$repository["avatar_url"]."'>", "<br>",
                    "<a href='".$repository["html_url"]."' target='_blank'>visit to ".$repository["login"]."</a>","<br>", 
                    "<br>";     
                    }
                }           
                }
            }
    
    ?>
    </div>
</div>

</body>
</html>