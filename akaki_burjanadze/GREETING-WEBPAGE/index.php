<?php include 'inc/header.php' ?>

<?php
    $errors = [];
    $inputs = [];
    $image = [];
    $FIRST_NAME_REQUIRED;
    $LAST_NAME_REQUIRED;
    $IMAGE_MAX_SIZE;

    if (isset($_POST['submit'])) {
        // check first and last names
        if (!$_POST['first_name']) {
            $FIRST_NAME_REQUIRED = 'First Name is required';
        }

        if (!$_POST['last_name']) {
            $LAST_NAME_REQUIRED = 'Last Name is required';
        }

        // check if first and last names only contain alphabet chars
        if (!ctype_alpha($_POST['first_name'])) {
            $errors['first_name'] = 'First Name must only contain alphabet characters';
        } else {
            $inputs['first_name'] = htmlspecialchars($_POST['first_name']);
            $errors['first_name'] = '';
        }

        if (!ctype_alpha($_POST['last_name'])) {
            $errors['last_name'] = 'Last Name must only contain alphabet characters';
        } else {
            $inputs['last_name'] = htmlspecialchars($_POST['last_name']);
            $errors['last_name'] = '';
        }

        // get file contents
        $image['name'] = $_FILES['profile_pic']['name'];
        $image['tmp_name'] = $_FILES['profile_pic']['tmp_name'];
        $image['error'] = $_FILES['profile_pic']['error'];
        $image['size'] = $_FILES['profile_pic']['size'];

        // get image extension
        $image_ext = explode('.', $image['name']);
        $image_actual_ext = strtolower(end($image_ext));

        // define allowed image extensions
        $allowed_image_exts = ['png', 'jpg', 'jpeg', 'gif', 'webp'];

        if (in_array($image_actual_ext, $allowed_image_exts)) {
            $image_dest = 'images/'.$image['name'];
            // upload image
            if ($image['error'] === 0 && $image['size'] <= 15000) {
                move_uploaded_file($image['tmp_name'], $image_dest);
            }
            if ($image['size'] > 15000) {
                $IMAGE_MAX_SIZE = 'Maximum image size to upload is 15 mb';
            }
        } else {
            $errors['file_upload'] = 'You cannot upload this type of file';
        }
    }
?>

<?php
    $req_method = $_SERVER['REQUEST_METHOD'];

    if ($req_method === 'GET') {
        include 'inc/form.php';
    }
    if (!empty($errors['first_name'])
    || !empty($errors['last_name'])
    || !empty($errors['file_upload'])
    || !empty($FIRST_NAME_REQUIRED)
    || !empty($LAST_NAME_REQUIRED)
    || !empty($IMAGE_MAX_SIZE)) {
        include 'inc/form.php';
    } else {
        include 'inc/output.php';
    }
?>

<?php include 'inc/footer.php' ?>
