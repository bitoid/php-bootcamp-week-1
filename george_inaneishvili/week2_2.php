<!DOCTYPE html>
<html>
<head>
<style>
.content-table {
    border-collapse: collapse;
    margin: 25px 0;
    font-size: 0.9em;
    min-width: 400px;
    border-radius: 5px 0px 5px 0px ;
    border-top: 2px solid black;
    overflow: hidden;
    box-shadow: 0 0 20px gray;
    width: 90%;
    text-align: center;
    margin-left:auto;
    margin-right:auto;
    border: 2px solid black;
}

.content-table  tr{
    background-color: #171515;
    color: white;
    text-align: left;
    font-weight: bold;
}

.content-table td{
    padding: 12px 15px;
    border-right: 5px dotted white;
    border-bottom: 5px solid #f5f5f5;   text-align: center;
}


    .content-table tbody tr:nth-of-type(even) {
    background-color: #333;
    border-right: 1px dotted solid;
}


.box {
    background-color: #171515;
    height: 100%;
    text-align: center;
    border: 1px solid black;
    margin-left: 35%;
    margin-right: 35%;
    border: 5px solid black;
    border-radius: 15px;
}

.github{
    font-size: 50px;
    color: #171515;
    display: inline-block;
}

.button{
    padding: 10px;
    border: 1px solid gray;
    background-color:#171515;
    border-radius: 5px;
    font: inherit;
    color: white;
    margin-bottom: 5px;
}

.box label {
    font-size: 28px;
    line-height: 50px;
    color: #03253c;
    color: white;
}

.houu{
    line-height: 20px;
    text-align: center;
    margin-top: 10px;
    margin-bottom: 10px;
    border: 5px solid white;
    text-align: center;
    border-radius: 4px;
}
</style>
</head>
<body>
    <div class="box">
<form  action="week2_2.php" method="POST" enctype="multipart/form-data">
    <label style="font-size: 40px;"> github </label> <br>
    <input type="text" name="username" placeholder="username" class="houu"><br>
    <label> followers: </label>
    <input type="checkbox" name="followers[]" value="value2"><br>
    <label> repos: </label>
    <input type="checkbox" name="repos[]" value="value1">  <br>
    <input type="submit" name="submit" value="submit" class="button">

</form>
</div>


<?php
//validaciebia gasaketebeli da tables css

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
        echo "<table class='content-table'>";
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
        echo "<table class='content-table'>";
        foreach($mass as $key => $value){
            echo '<tr>';
            echo '<td>';
            print $key + 1;
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
        echo "</table>";
         curl_close($curl);
        }
        

}
?>
</body>
</html>