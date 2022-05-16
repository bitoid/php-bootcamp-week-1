<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="styles/style.css">
    <link rel="stylesheet" href="styles/reset.css">
    <?php include 'main.php'; ?>
    <title>Hello PHP</title>
</head>

<body>
    <main class="main">
        <div class="form_container">
            <form class="main-form" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>" method="POST" enctype="multipart/form-data">
                <!-- Input field for first name. -->
                <span class="error fname-error" style="visibility:<?php echo $text_input_error ?>;"><?php echo $firstNameErr;?></span>
                <input class="input" type="text" name="fname" autocomplete="none" placeholder="First name">
                <!-- Input field for last name. -->
                <span class="error lname-error" style="visibility:<?php echo $text_input_error ?>;"><?php echo $lastNameErr;?></span>
                <input class="input" type="text" name="lname" autocomplete="none" placeholder="Last name">
                <!-- File upload -->
                <span class="error image-error" style="visibility:<?php echo $file_upload_error?>"><?php echo $upload_error_message ?></span>
                <input id="files" type="file" name="upfile">
                <label for="files" id="file">Select file</label>
                <!-- Button -->
                <div class="button">
                    <button type="submit" name="submit">SUBMIT</button>
                </div>
            </form>
        </div>
        <!-- Profile -->
        <div class="flex-container">
            <div class="usr-profile">
                <div class="usr-pfp">
                    <?php echo $display_image ?>
                </div>
                <div class="usr-name">
                    <h3 class="full_name"><?php echo $first_name . " " . $last_name ?></h3>
                </div>
            </div>
        </div>
    </main>
</body>

</html>