<?php
if ($_SERVER['REQUEST_METHOD'] === 'POST')
{
    $file = $_FILES['profile']['name'];
    $file_tmp = $_FILES['profile']['tmp_name'];
    $firstname = htmlspecialchars($_POST['firstname']);
    $lastname = htmlspecialchars($_POST['lastname']);
    if (empty($file) || !preg_match('/^[a-z,A-Z]+$/i', $firstname) || !preg_match('/^[a-z,A-Z]+$/i', $lastname) || empty($firstname) || empty($lastname))
    {
      // Validation messages
        if (empty($file))
        {
            $fileerror = "Please upload image";
        }
        if (empty($firstname))
        {
            $firstnameerror = "Filling in this field is required";
        }
        elseif (!preg_match('/^[a-z,A-Z]+$/i', $firstname))
        {
            $firstnameerror = "Allowed only alphabets";
        }
        if (empty($lastname))
        {
            $lastnameerror = 'Filling this field is required';
        }
        elseif (!preg_match('/^[a-z,A-Z]+$/i', $lastname))
        {
            $lastnameerror = "Allowed only alphabets";
        }
    }
    elseif (move_uploaded_file($file_tmp, "./image/" . $file))
    {
?>
    <center>
        <img src="./image/<?php echo $file ?>" />
        <br>
        <b><?php echo $firstname . ' ' . $lastname ?></b>
    </center>
<?php
    }
}
?>
