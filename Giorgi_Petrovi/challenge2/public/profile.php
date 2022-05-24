<?php 

	require_once "../request.php";
	session_start();
	if (!isset($_SESSION['user_info'])) {
		header("Location: http://$_SERVER[HTTP_HOST]/index.php");
	}

	$preprocess_show_value = [
		"repos" => "public_repos",
		"followers" => "followers",
	];

	$user_info = $_SESSION['user_info'];

	$current_show = $_GET['show'] ?? "repos";
	$per_page = 20;
	$last_page = ceil($user_info["$preprocess_show_value[$current_show]"] / $per_page);

	// validate and store current page number
	$current_page = isset($_GET['page']) && (0 < $_GET['page'] && $_GET['page'] <= $last_page) ? $_GET['page'] : 1;


	$data = fetch_data(
		"https://api.github.com/users/$user_info[login]/$current_show?",
		[
			"per_page" => $per_page,
			"page" => $current_page,
		]
	);

?>


<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<title><?= ucfirst($user_info['login']) ?></title>
	<link href="https://fonts.googleapis.com/css2?family=Roboto+Slab:wght@300&display=swap" rel="stylesheet">
    <link rel='stylesheet' href='style.css'>
</head>
<body>
	<div class="wrapper">
		<!-- Search Bar -->
		<?php require_once 'search_form.php'; ?>

		<!-- Profile -->
		<div class="profile">
			<div class="profile__item">
				<img src="<?php print $user_info['avatar_url'] ?>" class="profile__picture" alt="profil picture">
			</div>
			<div class="profile__item">
				<div class="profile__title">
					<?php print $user_info['login'] ?>
				</div>
				<ul class='profile__list'>
					<li><a href="?show=repos&page=1"><button class="profile__button">Repositories:<?php print $user_info['public_repos']?></button></a></li>
					<li><a href="?show=followers&page=1"><button class="profile__button">Followers:<?php print $user_info['followers'] ?></button></a></li>
					<li><a href=<?php print $user_info['html_url']?>><button class="profile__button">GitHub</button></a></li>
				</ul>
			</div>
		</div>

     	<!-- Content Table (Repos/Followers) -->
		<?php 
			if(file_exists($current_show."_table.php")) { 
				require_once $current_show."_table.php";
			} else {
				header("Location: http://$_SERVER[HTTP_HOST]/profile.php?show=repos&page=1");
				exit();
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
</script>
</body>
</html>