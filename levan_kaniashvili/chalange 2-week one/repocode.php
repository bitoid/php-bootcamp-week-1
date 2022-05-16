<?php  

$username = '';

if ($_SERVER['REQUEST_METHOD'] === 'POST'){
    $username = $_POST['name'];
}


$url = "https://api.github.com/users/". "$username" ."/repos?page=1&per_page=100";

$headers = [
    "User-Agent: Bitoid",
];

$ch = curl_init($url);

curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);

curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);

$response = curl_exec($ch);

curl_close($ch);


$data = json_decode($response, true);


foreach ($data as $repository) {
    // echo $name = $repository ['name'];
    // echo  $fullname = $repository ['full_name'];
    // echo count($data, $data['id']);
}

// echo var_dump($data);

// echo count($data);


















// curl_setopt($curl, CURLOPT_URL, $url);
// curl_setopt($curl, CURLOPT_SSL_VERIFYPEER, false);
// curl_exec($curl);




// $ch = curl_init();
//     curl_setopt_array($ch, [
//         CURLOPT_URL => $url,
//         CURLOPT_HTTPHEADER => [
//             "Content-Type: application/json",
//             "User-Agent: Mozilla/5.0 (Windows NT 6.1) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/47.0.2526.111 YaBrowser/16.3.0.7146 Yowser/2.5 Safari/537.36"
//         ],
//         CURLOPT_RETURNTRANSFER => true,
//         CURLOPT_FOLLOWLOCATION => true,
//         CURLOPT_POST => true,
//         CURLOPT_POSTFIELDS => json_encode($username)
//     ]);
//     $response = curl_exec($ch);
//     curl_close($ch);

//     print($response);

//      var_dump($username);

//      print ($url);

// // $ch = curl_init($url);   //რესურსი

// // curl_setopt_array($ch, [
// //     CURLOPT_POST =>true,
// //     CURLOPT_POSTFIELDS => json_encode($username),
// //     CURLOPT_RETURNTRANSFER =>true,
// //     CURLOPT_HTTPHEADER =>[
// //         "Accept: application/vnd.github.v3+json",
// //         "Content-Type: text/plain",
// //         "User-Agent: Mozilla/5.0 (Windows NT 6.1) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/47.0.2526.111 YaBrowser/16.3.0.7146 Yowser/2.5 Safari/537.36"
// //     ]
// // ]);

// // $result = curl_exec($ch);

// // var_dump($result);
// // curl_setopt($ch, CURLOPT_URL, $url);

// // curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);   //დააბრუნოს მონაცემები

// // $result = curl_exec($ch);

// // curl_close($ch);


// // echo $result;




// // $api_url = "https://api.github.com/users/". "$username" ."/repos";

// // $json_data = file_get_contents($api_url);

// // $response_data = json_decode($json_data);

// // $user_data = $response_data->data;

// $user_data = array_slice($user_data, 0, 9);

// Print data if need to debug
// print_r($user_data);

// var_dump($user_url);