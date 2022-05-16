<?php
$userData = array();
$file = 'user.json';
$url = '';
$upload = 'upload/';
$errors = array('', 'You must FILL field "Name" only A-Z', 'You must FILL field "Surname" only A-Z', 'You must Choice picture', 'Dublicate User');
$error = 0;
$count = 0;

if ($_POST != null) {

    //შემოწმება A-Z
    //name, surname, url
    if (!preg_match("/^([A-Z']+)$/", $_POST['name'])) {
        $error = 1;
    } elseif (!preg_match("/^([A-Z']+)$/", $_POST['surname'])) {
        $error = 2;
    } elseif (!($_FILES['image']['name'])) {
        $error = 3;
    } else {
        $preview = $_POST['preview'];
        $name = $_POST['name'];
        $surname = $_POST['surname'];
        //json ფაილის არსებობის შემოწმება
        if (!file_exists($file)) {
            $data = array();
            //დუბლირებაზე შემოწმება
            $a = search_in_array($name, $data);
            $b = search_in_array($surname, $data);
            if ($a && $b) {
                $error = 4;
            } else {
                $error = 0;
                //ფაილის შენახვა
                $file_name = $_FILES['image']['name'];
                $file_size = $_FILES['image']['size'];
                $file_tmp = $_FILES['image']['tmp_name'];
                $file_type = $_FILES['image']['type'];
                move_uploaded_file($file_tmp, $upload . $file_name);
                //მონაცემების შევსება + ჩაწერა
                $subData = array();
                $subData = array($name, $surname, $file_name);
                array_push($data, $subData);

                $json = json_encode($data);
                $data = file_put_contents($file, $json);
            }
        } else {
            //ძველი მონაცემების ჩატვირთვა
            $data = json_decode(file_get_contents($file), true);
            //დუბლირებაზე შემოწმება
            $a = search_in_array($name, $data);
            $b = search_in_array($surname, $data);
            if ($a && $b) {
                $error = 4;
            } else {
                $error = 0;

                //ფაილის შენახვა
                $file_name = $_FILES['image']['name'];
                $file_size = $_FILES['image']['size'];
                $file_tmp = $_FILES['image']['tmp_name'];
                $file_type = $_FILES['image']['type'];
                move_uploaded_file($file_tmp, $upload . $file_name);

                //მონაცემების შევსება + ჩაწერა
                $subData = array();
                $subData = array($name, $surname, $file_name);
                array_push($data, $subData);
                $json = json_encode($data);
                $data = file_put_contents($file, $json);
            }

        }

    }

    $preview = $_POST['preview'];
} else {
    $preview = '';
//    $userData = json_decode(file_get_contents($file), true);
}

function search_in_array($value, $array)
{
    $found = array();
    foreach ($array as $key => $val) {
        if ($val[1] == $value) {
            array_push($found, $val[1]);
        }
    }
    if (count($found) != 0)
        return $found;
    else
        return null;
}

unset($_POST);
unset($_GET);

?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">
    <link rel="icon" href="favicon.ico">
    <title>Challenge #1: 3-10 May 2022</title>

    <!-- Bootstrap -->
    <link rel="stylesheet" href="/vendor/bs5/css/bootstrap.min.css">

    <!-- Main Style -->
    <link href="/css/main.css" rel="stylesheet" type="text/css">

    <!-- Scripts -->
    <script src="/vendor/bs5/js/bootstrap.bundle.min.js"></script>
    <script src="/vendor/jquery351/jquery-3.5.1.min.js"></script>
    <script src="/js/main.js"></script>
</head>
<body>

<div class="container pt-3">
    <form method="post" enctype="multipart/form-data" action="">
        <div class="alert alert-primary" role="alert">
            <strong>Challenge #1:</strong> 3-10 May 2022
        </div>

        <div class="row row-cols-1 row-cols-sm-2 row-cols-md-3 g-3">
            <div class="col">
                <div class="card mb-3">
                    <div class="card-header">User List <span class="badge bg-primary float-end">
                        <?php
                        if (!file_exists($file)) {
                            echo '0';
                        } else {
                            $userData = json_decode(file_get_contents($file), true);
                            echo count($userData);
                        }
                        ?>
                    </span></div>
                    <div class="card-body">

                        <div class="list-group">
                            <?php
                            foreach ($userData as $key => $value) {

                                if (intval($preview) == $key) {
                                    echo '<button type="submit" name="preview" value="' . $key . '" class="list-group-item list-group-item-action active">';
                                } else {
                                    echo '<button type="submit" name="preview" value="' . $key . '" class="list-group-item list-group-item-action">';
                                }
                                echo $value[0] . ' ' . $value[1];
                                echo '</button>';
                            }
                            ?>
                        </div>

                    </div>
                    <!--                <div class="card-footer"></div>-->
                </div>
            </div>
            <div class="col">
                <div class="card mb-3">
                    <div class="card-header">Preview</div>
                    <div class="card-body align-content-center">
                        <div class="card-img">

                            <?php
                            if ($preview == '') {
                                echo '<img src="/img/warning.png" class="img-thumbnail" alt="warning" width="280">';
                            } else {
                                echo '<p>' . $userData [$preview][0] . ' ' . $userData [$preview][1] . '</p>';
                                $file_name = $userData [$preview][2];
                                $url = $upload . $file_name;
                                echo '<img src="' . $url . '" class="img-thumbnail" alt="warning" width="280">';
                            }
                            ?>
                        </div>
                    </div>
                    <!--                <div class="card-footer"></div>-->
                </div>
            </div>
            <div class="col">
                <div class="card mb-3">
                    <?php
                    switch ($error) {
                        case 0:
                            echo '<div class="card-header bg-primary text-white">GOOD LUCK | Form Input</div>';
                            break;
                        case 1:
                            echo '<div class="card-header bg-danger text-white">' . $errors[1] . '</div>';
                            break;
                        case 2:
                            echo '<div class="card-header bg-danger text-white">' . $errors[2] . '</div>';
                            break;
                        case 3:
                            echo '<div class="card-header bg-danger text-white">' . $errors[3] . '</div>';
                            break;
                        case 4:
                            echo '<div class="card-header bg-danger text-white">' . $errors[4] . '</div>';
                            break;
                    }
                    ?>
                    <!--                <div class="card-header bg-danger text-white">Form Input</div>-->
                    <div class="card-body">


                        <div class="mb-3">
                            <input type="text" class="form-control" id="name" name="name" placeholder="Name">
                        </div>
                        <div class="mb-3">
                            <input type="text" class="form-control" id="surname" name="surname" placeholder="SurName">
                        </div>
                        <div class="mb-3">
                            <input class="form-control" type="file" id="image" name="image">
                        </div>
                        <button type="submit" name="preview" value="" class="btn btn-primary w-100">start</button>
                        <!--                        <input name="preview" value="" hidden>-->
                    </div>
                    <!--                <div class="card-footer"></div>-->
                </div>
            </div>
        </div>
        <hr>

    </form>
</div>

</body>

</html>
