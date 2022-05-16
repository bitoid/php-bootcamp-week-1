<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Title</title>
</head>
<body>

<?php
$headrs = [
    "User Agent:Example res api",
    "Authorization: datoxx"
];
$ch = curl_init("https://api.github.com/users/{user_name}/repos");
//$ch = "https://api.github.com/users/otarza";
curl_setopt($ch, CURLOPT_HTTPHEADER, $headrs);
curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);

$result = curl_exec($ch);
curl_close($ch);
$data = json_decode($result, true);

//foreach ($data as $repository) {
//    echo $repository["full name"], "",
//    $repository["full name"], "",
//    $repository["url"], "",
//    $repository["img"], "<br>";
//}

?>

<table>
    <thead>
    <tr>
        <th>id</th>
        <th>saxeli</th>
        <th>foto</th>
    </tr>
    </thead>
    <tbody>
    <?php foreach ($data as $repository): ?>
        <tr>
            <td><?= $repository["id"] ?></td>
            <td><?= $repository["saxeli"] ?></td>
        </tr>
    <?php endforeach; ?>
    </tbody>
</table>

</body>
</html>