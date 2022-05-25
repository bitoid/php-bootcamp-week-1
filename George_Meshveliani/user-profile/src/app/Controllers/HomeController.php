<?php


namespace App\Controllers;


use App\ViewsControllers\View;
use Ramsey\Uuid\Uuid;

class HomeController {
    public function index(): string {
        return 'Data';
    }

    public function update(): View {
        return View::make('forms/form');
    }

    public function store() {

        if (!empty($_POST['name']) && !empty($_POST['lastName'])) {
            if (preg_match("/^([a-zA-Z' ]+)$/", $_POST['name']) &&
                preg_match("/^([a-zA-Z' ]+)$/", $_POST['lastName']))  {
                $name = $_POST['name'];
                $lastName = $_POST['lastName'];
            }
            else {
                echo 'first name and last name should be string';
                die;
            }
        }
        else {
            echo 'fields should not be empty!';
            die;
        }

        $target_file =  basename($_FILES["fileToUpload"]["name"]);
        $uploadOk = 1;
        $imageFileType = strtolower(pathinfo($target_file, PATHINFO_EXTENSION));
        $uploads_dir = '/var/www/app/uploads';

        if (isset($_POST["submit"])) {
            $check = getimagesize($_FILES["fileToUpload"]["tmp_name"]);
            if ($check !== false) {
                $uploadOk = 1;
            }
            else {
                echo "File is not an image.";
                $uploadOk = 0;
            }
        }

        if ($_FILES["fileToUpload"]["size"] > 500000) {
            echo "Sorry, your file is too large.";
            $uploadOk = 0;
        }

        if ($imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg"
            && $imageFileType != "gif") {
            echo "Sorry, only JPG, JPEG, PNG & GIF files are allowed.";
            $uploadOk = 0;
        }

        if ($uploadOk == 0) {
            echo "Sorry, your file was not uploaded.";
        }
        else {
            if (move_uploaded_file($_FILES["fileToUpload"]["tmp_name"], "$uploads_dir/$target_file")) {
                echo "Inputs has been updated, thanks, you can add more";
            }
            else {
                echo "Sorry, there was an error uploading your file.";
            }
        }

        $user_id = Uuid::uuid4();

        $form = View::make('forms/form');

        $userProfile = View::make('user/userProfile', [
            'name' => $name,
            'lastName' => $lastName,
            'user_id' => $user_id,
            'target_file' => $target_file,
            'uploads_dir' => $uploads_dir,
        ]);

        return $form . $userProfile;

    }
}
