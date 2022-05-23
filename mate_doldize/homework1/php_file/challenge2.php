<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Title</title>
</head>
<body>

<?php
$userName = $submit = "";
$userName = $_POST['username'];
$submit = $_POST['submit'];

$param = [
    'http' => [
        'method' => 'GET',
        'header' => [
            'User-Agent: PHP',
        ]
    ]
];

if (isset($userName)) {
    $userName = trim($userName);
}
if (isset($submit) && isset($userName) && strlen($userName) > 0) {
    $userurl = "https://api.github.com/search/users?q=" . $userName;
    $userdecoded = file_get_contents($userurl, false, stream_context_create($param));
    $user_validation = json_decode($userdecoded, true);

    if ($user_validation["total_count"] === 0) {
        die("error: username '" . $userName . "'");
    }


}

?>

<form action="" method="POST">
    <label>
        <input type="text" name="username" placeholder="Enter username">
    </label>
    <select name="operation" required>
        <option disabled selected value>Select option</option>
        <option value="repository">repository</option>
        <option value="followers">followers</option>
    </select>
    <button type="submit" name="submit" value="submit">Submit</button>

</body>
</html>