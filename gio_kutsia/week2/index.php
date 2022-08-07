<?php

// From URL to get webpage contents.
// $url = "https://api.github.com/users/giokutsia/repos";
// $url = "https://api.github.com/users/giokutsia/repos";
// session_start();
$nameErr = "";
$username = "";
$url = "";
$repos = "";
$page = "";
$dataErr = "";


if ($_SERVER["REQUEST_METHOD"] == "POST") {
    if (empty($_POST["username"])) {
        $nameErr = "Name is required";
    } else {
        $username = $_POST["username"];

        if (isset($_POST["arr"])) {
            $repos = $_POST["arr"][0];
        } else {
            $dataErr = "No Username Like that";
        }
    }
};

//fetching github API
$url = "https://api.github.com/users/$username/$repos";
$ch = curl_init();
curl_setopt($ch, CURLOPT_HTTPHEADER, [
    'Accept: application/vnd.github.v3+json',

    'User-Agent: GitHub-username'
]);
curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);

// Return Page contents.
curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);

//grab URL and pass it to the variable.
curl_setopt($ch, CURLOPT_URL, $url);

$resultphp = curl_exec($ch);
$result = json_decode($resultphp, true);

curl_close($ch);
//logic for pagging


$result_on_page = 6;

// if (isset($result)) {
//     // echo count($result) . "<br>";

// if (!isset($_GET["page"])) {
//     $page = 1;
// } else {
//     $page = $_GET['page'];
// }
$total_records = count($result);

$pag_page_num = ceil($total_records / $result_on_page);
if ($page > $pag_page_num) {
    $page = $pag_page_num;
}

// Validation: Page to display can not be less than 1
if ($page < 1) {
    $page = 1;
}
$offset = ($page - 1) * $result_on_page;
$result = array_slice($result, $offset, $result_on_page);


// }





// echo $pag_page_num . "<br>";