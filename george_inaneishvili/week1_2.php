<!DOCTYPE html>
<html>
<head>
<style>
table {
    border: 2px solid black;
}
.box {
    background-color: white;
   height: 100%;
   text-align: center;
   border: 1px solid black;
   margin-left: 40%;
   margin-right: 40%;
}

table{
    text-align: center;
}

table, td{
    border: 1px solid red;
    text-align: center;
}



</style>
</head>
<body>
    <div class="box">
<form  action="week1_2.php" method="POST" enctype="multipart/form-data">
<input type="text" name="username" placeholder="username"> <br>
<label> repos: </label>
<input type="checkbox" name="repos[]" value="value1"> 
<label> followers: </label>
<input type="checkbox" name="followers[]" value="value2"><br>
<input type="submit" name="submit" value="submit">

</form>
</div>


<?php
if (isset($_POST['submit'])){  
    $username = $_POST['username'];
    

 
    if(isset( $_POST['repos'])){
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
            print $key;
            echo '</td>';
            echo '<td>';
            echo $value['name'] . '</br>';
            echo '</td>';
            echo '<td>';
            echo $value['description'] . '<br>';
            echo '</td>';
            echo '</tr>';    
        }
        echo "</table>";
        curl_close($curl);
    }
  
    if(isset( $_POST['followers'])){
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
</body>
</html>