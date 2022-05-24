<?php include('server.php') ?>
    <!DOCTYPE html>
<head>
    <title> registration form </title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
<div class="box">
    <div class="header">
        <h2> Register here</h2>
    </div>
    <form  action="registrationform.php" method="post">
        <?php include($errors.php) ?>
        <div>
            <label> First name</label>
            <input type="text"  name="firstname" required>
        </div>
        <div>
            <label> Last name</label>
            <input type="text"  name="lastname" required>
        </div>
        <div>
            <label for="password">Password:</label>
            <input type="password" name="password" required>
        </div>
        <div>

            <form action="upload.php" method="post" enctype="multipart/form-data">
                <label>Select Image File:</label>
                <input type="file" name="image">
                <input type="submit" name="submit" value="Upload">
            </form>
        </div>
        <button type="submit" name="reg_user"> Register</button>
        <p> Already  have an account? <a href="login.php"><i>Log in</i></a></p>
    </form>

</div>
</body>
</html>