<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="styles/style.css">
    <link rel="stylesheet" href="styles/reset.css">
    <?php include 'main.php'; ?>
    <title>Hello</title>
</head>

<body>
    <main class="main">
        <div class="form_container">
            <form class="main-form" action="<?= htmlspecialchars($_SERVER["PHP_SELF"]);?>" method="POST" enctype="multipart/form-data">
                <!-- Input field for first name. -->
                <span class="error fname-error" style="visibility:<?= $text_input_error ?>;"><?= $first_name_eror;?></span>
                <input class="input" type="text" name="fname" autocomplete="none" placeholder="First name">
                <!-- Input field for last name. -->
                <span class="error lname-error" style="visibility:<?= $text_input_error ?>;"><?= $last_name_error;?></span>
                <input class="input" type="text" name="lname" autocomplete="none" placeholder="Last name">
                <!-- File upload -->
                <span class="error image-error" style="visibility:<?= $file_upload_error?>"><?= $upload_error_message ?></span>
                <input id="files" type="file" name="upfile">
                <label for="files" id="file">Select file</label>
                <!-- Button -->
                <div class="button">
                    <button type="submit" name="submit">SUBMIT</button>
                </div>
            </form>
        </div>
        <!-- Profile -->
        <div class="flex-container" style=" visibility: <?= $display_user_info ?>">
            <div class="usr-profile">
                <div class="usr-pfp">
                    <img src="<?= $target_file ?>" alt="image not present" style="width:250px; height: 280px;" >
                </div>
                <div class="usr-name">
                    <h3 class="full_name"><?= $first_name . " " . $last_name ?></h3>
                </div>
            </div>
        </div>
    </main>
</body>

</html>