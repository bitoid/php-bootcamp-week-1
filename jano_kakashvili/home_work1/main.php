<?php
// header('Content-Type: text/plain; charset=utf-8');

$first_name_validated = false;
$last_name_validated = false;
$name_validation_passed = false;

// Show Error in html
// define variables for errors
$first_name_eror = $last_name_error = $upload_error_message = "";
$text_input_error = "hidden"; // if error occurs displait
$file_upload_error = "hidden";

// do not display user information block before validation
$display_user_info = "hidden";


if ($_SERVER["REQUEST_METHOD"] == "POST") {
    /*  ///////////////
        name validation
    */  ///////////////

    if (empty($_POST['fname'])) {
        $first_name_eror = "First name is required!";
    } else if (ctype_alpha($_POST['fname'])) {
        $first_name_validated = true;
    } else {
        $first_name_eror = "Please use only letters (a-z).";
    }


    if (empty($_POST['lname'])) {
        $last_name_error = "Last name is required!";
    } else if (ctype_alpha($_POST['lname'])) {
        $last_name_validated = true;
    } else {
        $last_name_error = "Please use only letters (a-z).";
    }

    // display errors
    if ($first_name_eror || $last_name_error) {
        $text_input_error = "visible";
    }

    /*  ///////////////
        image validation
    */  ///////////////
    // uploaded file saved to the /tmp directory on the web server
    try {
        // Undefined | Multiple Files | $_FILES Corruption Attack
        // If this request falls under any of them, treat it invalid.
        if (
            !isset($_FILES['upfile']['error']) ||
            is_array($_FILES['upfile']['error'])
        ) {
            throw new RuntimeException('Invalid parameters.');
        }

        // Check $_FILES['upfile']['error'] value.
        switch ($_FILES['upfile']['error']) {
            case UPLOAD_ERR_OK:    // if == 0 წარმატებით აიტვირთა.
                break;
            case UPLOAD_ERR_NO_FILE:    // ფაილი არ ატვირთულა
                throw new RuntimeException('No file sent.');
            case UPLOAD_ERR_INI_SIZE:   // ფაილის ზომა upload_max_filesize კონფიგურაციის დირექტივას აღემატება
            case UPLOAD_ERR_FORM_SIZE:  // ფაილის ზომა html ფორმის MAX_FILE_SIZE ელემენტის მოცულობას აღემატება
                throw new RuntimeException('Exceeded filesize limit.');
            default:
                throw new RuntimeException('Unknown errors.');
        }

        // We should also check filesize here.
        if ($_FILES['upfile']['size'] > 1000000) {
            throw new RuntimeException('Exceeded filesize limit.');
        }

        // DO NOT TRUST $_FILES['upfile']['mime'] VALUE !!
        // Check MIME Type by yourself.
        $finfo = new finfo(FILEINFO_MIME_TYPE);
        if (false === $ext = array_search(
            $finfo->file($_FILES['upfile']['tmp_name']),
            array(
                'jpg' => 'image/jpeg',
                'png' => 'image/png',
                'gif' => 'image/gif',
            ),
            true
        )) {
            throw new RuntimeException('Invalid file format.');
        }
        // You should name it uniquely.
        // DO NOT USE $_FILES['upfile']['name'] WITHOUT ANY VALIDATION !!
        // On this example, obtain safe unique name from its binary data.
        if (!move_uploaded_file(
            $_FILES['upfile']['tmp_name'],
            sprintf(
                './uploads/%s.%s',
                $sha1file = sha1_file($_FILES['upfile']['tmp_name']),
                $ext  // ატვირთული ფაილის გაფართოება
            )
        )) {
            throw new RuntimeException('Failed to move uploaded file.');
        }

        $fileUploadSuccess = true;
    } catch (RuntimeException $e) {
        // $upload_error_message ცვლადი მიიღებს მნიშვნელობას იმ დარღვევისა, რომელიც 
        // შეიძლება ზედა 'try' ბლოკში დაფიქსირდეს 
        $upload_error_message =  $e->getMessage();
    }

    // ცარიელი სტრინგის boolean მნიშვნელობა არის false
    // თუ არაა ცარიელი შეცდომა ფიქსირდება 
    if ($upload_error_message) {
        $file_upload_error = "visible";
    }

    $target_file = "uploads/" . $sha1file . '.' . $ext; // ატვირთული ფაილის მისამართი

    // add results
    if ($first_name_validated && $last_name_validated) {
        $name_validation_passed = true;  // სახელი და გვარის ვალიდაცია დასრულდა წარმატებით
    }


    // თუ text და file input-ების ვალიდაცია წარმატებით დასრულდა მონაცემთა 
    // დამუშავება გაგრძელდება
    if ($name_validation_passed && $fileUploadSuccess) {
        $first_name = $_POST['fname'];
        $last_name = $_POST['lname'];
        $display_user_info = "visible";
    }
}

print_r($target_file);
