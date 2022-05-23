<?php

	require_once '../request.php';

	if (!empty($_GET)) {
		session_start();	

		$username = $_GET['username'];
		$user_info = fetch_data('https://api.github.com/users/'.$username, []);
		
		if (!key_exists("error", $user_info)) {
			$_SESSION['user_info'] = $user_info;
			header("Location: http://$_SERVER[HTTP_HOST]/profile.php");
			exit();
		}

	}

?>


<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<title>Bitoid Week #1 Challenge #2</title>
	<link href="https://fonts.googleapis.com/css2?family=Roboto+Slab:wght@300&display=swap" rel="stylesheet">
    <link rel='stylesheet' href='style.css'>
</head>
<body>
	<div class="wrapper">
		<?php 
			require_once 'search_form.php';		
			if (isset($user_info['error'])) {
				print "<div class='error-alert'>". $user_info['error'] . "</div>";
			}         
		?>
	</div>
	<footer>
		<?php
		$remaining_requests = fetch_data("https://api.github.com/rate_limit", []);
		print "Remaining requests : " . $remaining_requests['resources']['core']['remaining'] . "<br>";
		?>
        Bitoid Week #1 Challenge #2 12.05.2022
    </footer>
</body>
</html>