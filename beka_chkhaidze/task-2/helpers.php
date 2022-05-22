<?php

session_start();

define('API_BASE_URL', 'https://api.github.com/users/');
define('USER_AGENT', 'Mozilla/4.0 (compatible; MSIE 6.0; Windows NT 5.1; SV1)');
define('PER_PAGE', 21);

$_SESSION['fetch_target'] = isset($_POST['type']) && in_array($_POST['type'],["followers","repos"])
    ? $_POST['type']
    : "followers";

$fetch_target = $_SESSION['fetch_target'];

echo "$fetch_target";

$meta_info = [
    'code' => null,
    'repos_count' => null,
    'followers_count' => null,
];



function my_curl ($url) {

    $CURL_DATA = [];
    
    $handle = curl_init();
    
    curl_setopt($handle, CURLOPT_URL, $url);
    curl_setopt($handle, CURLOPT_USERAGENT, USER_AGENT);
    curl_setopt($handle, CURLOPT_RETURNTRANSFER, true);
    curl_setopt($handle, CURLOPT_HEADER, false);
    
    $response = curl_exec($handle);
    $httpcode = curl_getinfo($handle, CURLINFO_HTTP_CODE);

    curl_close($handle);

    $CURL_DATA["response"] = json_decode($response);
    $CURL_DATA["code"] = $httpcode;


    return $CURL_DATA;
}

function get_basic_info(string $username): void {
    global $meta_info;
    $url = API_BASE_URL . $username;

    $_SESSION['username'] = $username;

    $data = my_curl($url);
    $response = $data['response'];

    $meta_info['code'] = $data['code'];

    $meta_info['repos_count'] = $response->public_repos;
    $meta_info['followers_count'] = $response->followers;

}


function check_user_existence(): bool {
    global $meta_info;

    $code = $meta_info['code'];

    return $code === 200;
}


function draw_pagination(): void {
    global $meta_info;
    global $fetch_target;

    if (!$meta_info) return;

    $max = $meta_info[ $fetch_target . '_count' ];
    $range = ceil($max / PER_PAGE);
    
    if ($range <= 1) return;
    
    $str = "<ul class='pagination'>";

    for ($i = 1; $i <= $range; $i++) {
        $str .= "<li><a href=\"?page=$i\">$i</a></li>";
    }
    
    $str .= "</ul>";

    echo $str;
}

function fetch_data(string $username) {
    global $meta_info;
    global $fetch_target;

    $max = $meta_info[ $fetch_target . '_count' ];
    $range = ceil($max / PER_PAGE);


    
    $page = isset($_GET['page']) && is_numeric($_GET['page'])
        ? $_GET['page']
        : 1;


    $url = API_BASE_URL . $username . "/". $fetch_target ."?per_page=". PER_PAGE . "&page=" . $page;
    $data = my_curl($url);
    $response = $data['response'];


    return $response;

}


function print_error(string $message) {
    echo "<div class='error'>" . htmlspecialchars($message, ENT_QUOTES, 'UTF-8') . "</div>";
}

function draw_data($items) {
    if (count($items) < 1) return;
    
    global $fetch_target;

    
    $html = <<< HTML
        <p class="intro">{$fetch_target}:</p>
        <ul class="items {$fetch_target}">
    HTML;

    foreach($items as $item) {
        $img = $fetch_target == "followers"
            ? $item->avatar_url
            : $item->owner->avatar_url;
    
        $text = $fetch_target == "followers"
            ? $item->login
            : $item->description;

        

        $html.= <<<HTML
        <li class='items__item'>
            <a href="$item->html_url" target='blank'>
                <img src="$img" alt="$item->html_url" />
                <p>$text</p>
            </a>
        </li>
        HTML;
    }

    $html .= "</ul>";

    echo $html;
}


// union types only work after  PHP 8.0
// function draw_html(string | null $username)
function draw_html() {

    $sent = (bool)isset($_POST['fetch']);    
    
    if (!$sent && (!isset($_SESSION['username']) || !isset($_GET['page'])) ) return;
    
    $username = isset($_POST['username']) ? $_POST['username'] : $_SESSION['username'];

    if (empty($username)) {
        print_error("please enter username"); 
        return;
    }
    

    get_basic_info($username);
    $user_exist = check_user_existence();
    
    if (!$user_exist) {
        print_error("user $username doesn't exist.");
        return;
    }

    $items = fetch_data($username);

    draw_data($items);
}
