<!DOCTYPE html>
<html>
<head>

    <title>Lika Mikhanashvili</title>
</head>

<body>
<form action="github.php" method="post" >
     Insert Username: <input type="text" name="username" ><br>
    <input type="submit" value="Submit" name="Submit1"> <br/>
</form>

<?php


$headers = [
    "User-Agent: Example REST API Client",
    "Authorization: token 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"
];
if(isset($_POST['Submit1'])) {
    $username =  $_POST['username'];
    $ch = curl_init("https://api.github.com/$username/repos");
    curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);

    if($response = curl_exec($ch))
    {
        curl_close($ch);
        $data = json_decode($response, true);

        foreach ($data as $repository) {
            echo $repository["full_name"], " ",
            $repository["name"], " ",
            $repository["description"], "<br>";
        }
    }
else
    {
        echo "Please choose image file!!";
    }
}


?>

</body>
</html>