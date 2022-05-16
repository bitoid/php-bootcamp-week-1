<!DOCTYPE html>
<html>
    <form action="index.php" method="POST" enctype="multipart/form-data">
        <label for="firstname">Firstname</label>
        <input type="text" name="firstname" placeholder="firstname" id="firstname"
        pattern="[a-zA-Z]+" title="only Letters" required>
        <label for="lastname">Lastname</label>
        <input type="text" name="lastname" placeholder="lastname" id="lastname"
        pattern="[a-zA-Z]+" title="only Letters" required>
        <label  for="image">Upload Picture</label>
        <input  name="image" type="file" id="image">
        <input type="submit" name="submit">
    </form>
</html>
<?php
    if (isset($_POST['submit'])) {
        $firstname = $_POST['firstname'];
        $lastname = $_POST['lastname'];
        $img_path = "images/" . $_FILES["image"]["name"];

        if (move_uploaded_file($_FILES["image"]["tmp_name"], $img_path)) {
            $image = $img_path;
        }
        echo '<h1>Fistname: '.$firstname.'</h1>';
        echo '<h1>Lastname: '.$lastname.'</h1>';
        echo '<img src="'.$image.'" alt="profile_pic"
            height=200 width=200>';
    }
?>