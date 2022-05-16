<?php
    if ($_SERVER['REQUEST_METHOD'] === 'GET') {
        // The request is using the POST method
        require "layout.html";
    }

    if ($_SERVER['REQUEST_METHOD'] === 'POST') { 
        $firstname = $_POST['firstname'];
        $lastname = $_POST['lastname'];
        $file = $_FILES['file'];

        $picture = "image/" . $_FILES['file']['name'];
        $tmp = $_FILES['file']['tmp_name'];
        move_uploaded_file($tmp, $picture);

        if ($_POST['firstname'] && $_POST['lastname'] && $_FILES['file']) {
            if (!ctype_alpha($firstname) || !ctype_alpha($lastname)) {
                require "layout.html";
                print '<div class="validation">First and last name must contain only letters</div>';
            } else {
                print '<!DOCTYPE html>
                <html lang="en">
                <head>
                    <meta charset="UTF-8">
                    <meta http-equiv="X-UA-Compatible" content="IE=edge">
                    <meta name="viewport" content="width=device-width, initial-scale=1.0">
                    <link href="/styles/main.css" rel="stylesheet">
                    <title>Uploaded</title>
                </head>
                <body class="front">
                    <h1>' . $firstname . ' ' . $lastname . '</h1>
                    <img class="uploaded" src="' . $picture . '" alt=Profle photo>
                </body>
                </html>';
            }
        } else {
            require "layout.html";
            print '<div class="validation">All fields are required</div>';
        }
    }

?>