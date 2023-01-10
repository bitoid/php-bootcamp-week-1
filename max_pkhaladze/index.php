<!doctype html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>ChallengeN1</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://getbootstrap.com/docs/5.3/assets/css/docs.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="p-3 m-0 border-0 bd-example">
    <?php if (empty($_POST)) : ?>
        <!-- Form HTML -->
        <form action="index.php" method="POST" enctype="multipart/form-data">
            <div class="input-group mt-3">
                <span class="input-group-text">First and last name</span>
                <input type="text" aria-label="First name" class="form-control" name="first_name" placeholder="First name">
                <input type="text" aria-label="Last name" class="form-control" name="last_name" placeholder="Last name">
            </div>
            <div class="input-group mt-3">
                <input type="file" class="form-control" name="profile_picture">
                <label class="input-group-text" ></label>
            </div>
            <div class="d-grid gap-2">
                <button type="submit" name="submit" class="btn btn-primary mt-3" value="submit">Submit</button>
            </div>
        </form>
    <?php else: ?>
    <?php
        // Validate first name and last name
        if (!preg_match('/^[A-Za-z]+$/', $_POST['first_name']) || !preg_match('/^[A-Za-z]+$/', $_POST['last_name'])) {
            $error_message = 'First and last name must contain only alphabet characters';
        } else {
            // Create upload folder if it doesn't exist
            $upload_folder = 'uploads';
            if (!file_exists($upload_folder)) {
                mkdir($upload_folder);
            }
            // Upload profile picture
            $profile_picture = $upload_folder . '/' . basename($_FILES['profile_picture']['name']);
            if (move_uploaded_file($_FILES['profile_picture']['tmp_name'], $profile_picture)) {
                // Show first name, last name and profile picture
                $first_name = htmlspecialchars($_POST['first_name']);
                $last_name = htmlspecialchars($_POST['last_name']);
            } else {
                $error_message = 'Failed to upload profile picture';
            }
        }
    ?>
    <div class="card">
        <img src="<?php print $profile_picture; ?>" class="card-img-top" alt="photoebi">
        <div class="card-body">
            <h2 class="card-title"><?php print $first_name; ?> <?php print $last_name; ?></h2>
        </div>
        <div>
            <!-- Show error message if there is one -->
            <?php if (isset($error_message)) { echo $error_message; } ?>
        <div>
    </div>
    <?php endif; ?>
</body>
</html>
