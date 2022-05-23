<?php
$errors = [
    'profile-input' => '',
    'firstname' => '',
    'lastname' => ''
];

$inputs = [
    'firstname' => '',
    'lastname' => ''
];

function validateForm(){
    global $errors, $inputs;

    $isValid = true;

    if(!$_POST['submit']){
        return false;
    }

    if(isset($_POST['firstname']) && $_POST['firstname']){
        $inputs['firstname'] = $_POST['firstname'];
    } else {
        $errors['firstname'] = 'Firstname is mandatory';
        $isValid = false;
    }
    
    if(isset($_POST['lastname']) && $_POST['lastname']){
        $inputs['lastname'] = $_POST['lastname'];
    } else {
        $errors['lastname'] = 'lastname is mandatory';
        $isValid = false;
    }
    
    if(isset($_FILES['profile-input']) && $_FILES['profile-input']['name']){
        $profileImage = $_FILES['profile-input']['name'];
        $type = $_FILES['profile-input']['type'];
        if(isset(explode('.', $profileImage)[1])){
            $extension = explode('.', $profileImage)[1];
            if(in_array($type , array('image/jpeg', 'image/jpg', 'image/png'))){
                if($isValid){
                    $image_Path = "images/".basename('profile' . '.' . $extension);

                    if(!file_exists('images')){
                        mkdir('images');
                    }
                
                    if (move_uploaded_file($_FILES['profile-input']['tmp_name'], $image_Path)) {
                        
                    }else{
                        $errors['profile-input'] = 'Error uploading image';
                    } 
                }
            } else {
                $errors['profile-input'] = 'Invalid file type';
                $isValid = false;
            }
        }
    } else {
        $errors['profile-input'] = 'Profile Image is mandatory';
        $isValid = false;
    }

    return $isValid;
};

function getUploadedProfilePic() {
    $mydir = 'images';
    if(file_exists($mydir)){

        $profile_image_name = scandir($mydir);
        
        if(isset($profile_image_name[2])){
            $profile_image_name = $profile_image_name[2];
        } else {
            $profile_image_name = null;
        }
        
        return $profile_image_name ?  ($mydir . '/' . $profile_image_name) : null;
    }
    return null;
}

$isValid = null;
$profile_image_url = null;
if(isset($_POST['submit'])){
    $isValid = validateForm();
    
    if($isValid){
        $profile_image_url = getUploadedProfilePic();
    }
}

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="./index.css" rel="stylesheet" />
    <title>Document</title>
</head>
<body>
    <div class="main">
        <form action="/index.php" method="POST" enctype="multipart/form-data">
            <div class="form-group">
                <label for="firstname" class="label">First Name</label>
                <span class="error"><?php echo $errors['firstname']; ?></span>
                <input value="<?php echo $inputs['firstname']; ?>" type="text" id="firstname" name="firstname" class="form-input">
            </div>
    
            <div class="form-group">
                <label for="lastname" class="label">Last Name</label>
                <span class="error"><?php echo $errors['lastname']; ?></span>
                <input value="<?php echo $inputs['lastname']; ?>" type="text" id="lastname" name="lastname" class="form-input">
            </div>
    
            <div class="form-group">
                <label for="profile-input" class="label">Profile Picture</label>
                <span class="error"><?php echo $errors['profile-input']; ?></span>
                <label for="profile-input">

                </label>
                
                <label class="profile-image-wrp">
                    <input type="file" id="profile-input" name="profile-input" type="file" class="form-input">
                    <div class="profile-image-actions">
                        <img src="./upload.png" alt="delete">
                    </div>
                    <div class="profile-image-sizing-wrp">
                        <?php if(isset($profile_image_url) && $profile_image_url): ?>
                            <img src="<?php echo $profile_image_url; ?>" id="profile-image" alt="profile">
                        <?php else: ?>
                            <img id="profile-image" alt="profile">
                        <?php endif; ?>
                    </div>
                </label>
            </div>
            
            <input type = "submit" name = "submit" value = "Submit">
        </form>

        <?php if(isset($_POST['firstname']) && isset($_POST['lastname']) && $_POST['firstname'] && $_POST['lastname'] && $profile_image_url): ?>
        <div class="data_wrp">
            <div>
                <img src="<?php echo $profile_image_url ?? 'default.png'; ?>">
            </div>
            <p><?php echo $_POST['firstname'] . ' ' . $_POST['lastname']; ?></p>
        </div>
        <?php endif; ?>
    </div>



    <script src="./index.js"></script>
</body>
</html>