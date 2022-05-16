<?php
class Followers
{
  public function __construct() {
    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
      $username = $_POST['username'];
      if (empty($username)) {
        $usernameerror = "Filling in this field is required";
      } else {
        $curl = curl_init();
        curl_setopt($curl, CURLOPT_URL, "https://api.github.com/users/" . $username . "/followers");
        curl_setopt($curl,
        CURLOPT_RETURNTRANSFER, true);
        curl_setopt($curl, CURLOPT_USERAGENT, "George");
        $result = curl_exec($curl);
        curl_close($curl);
        $this->followers = json_decode($result);
      }
    }
  }
}
$followersfunction = new Followers();