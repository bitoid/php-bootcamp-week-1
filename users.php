<?php
if (isset($_POST['submit'])){  
    $username = $_POST['username'];    
 
    if(isset($_POST['repositorys'])){
        $directory = "https://api.github.com/users/$username/repos";
        $curl = curl_init();
        curl_setopt_array($curl ,[
        CURLOPT_RETURNTRANSFER => 1 ,
        CURLOPT_URL => $directory ,
        CURLOPT_USERAGENT => 'Github API in CURL'
        ]);
        $response = curl_exec($curl);
        $mass = json_decode($response , true);
        echo "<table>";
        foreach($mass as $key => $value){
            echo '<tr>';
            echo '<td>';
            print $key + 1;
            $repository = $value['name'];
            print "<a href=https://github.com/$username/$repository target='_blank'>$repository</a>";
            echo '</td>';
            echo '<td>';
            echo $value['description'] . '<br>';
            echo '</td>';
            echo '</tr>';    
        }
        echo "</table>";
        curl_close($curl);
    }
  
    if(isset($_POST['followers'])){
        $directory = "https://api.github.com/users/$username/followers";
        $curl = curl_init();
        curl_setopt_array($curl ,[
        CURLOPT_RETURNTRANSFER => 1 ,
        CURLOPT_URL => $directory ,
        CURLOPT_USERAGENT => 'Github API in CURL'
        ]);
        $response = curl_exec($curl);
        $mass = json_decode($response , true);
        echo '<table>';
        foreach($mass as $key => $value){
            echo '<tr>';
            echo '<td>';
            print $key;
            echo '</td>';
            echo '<td>';
            echo $value['login'] . '</br>';
            echo '</td>';
            echo '<td>';
            echo $value['id'] . '<br>';
            echo '</td>';
            $avatar = $value['avatar_url'];
            echo '<td>';
            echo "<img src=$avatar width='100' height='100' >" ;
            echo '</td>';
            echo '</tr>'; 
        }
        echo '</table>';
         curl_close($curl);
    }
    
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <title>week 1</title>
  <meta name="description" content="just description">
  <meta name="viewport" content="width=device-width, initial-scale=1">
</head>
<body>
<h1>challange #2</h1>
<form action="<?= htmlspecialchars($_SERVER['PHP_SELF']); ?>"  method="POST" enctype="multipart/form-data">
<input type="text" name="username" placeholder="username"> <br>
<label> repositorys: </label>
<input type="checkbox" name="repositorys" value="repositorys"> 
<label> followers: </label>
<input type="checkbox" name="followers" value="followers"><br>
<input type="submit" name="submit" value="submit">
</form>
</body>
</html>