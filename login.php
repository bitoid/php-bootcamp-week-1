
<?php include('server.php') ?>
<!DOCTYPE html>
<head>
<title> registration form </title>
</head>
<body>
<div class="box">
    <div class="head">
      <h2> Register here</h2>
    </div>
<form  action="login.php" method="post">
<div>
<label> First name</label>
    <input type="text"  name="firstname" required>
</div>
    <div>
        <label> Last name</label>
        <input type="text"  name="lastname" requiered>
    </div>
    <div>
        <label for="password">Password:</label>
        <input type="password" name="password" required>
    </div>
   <button type="submit" name="login_user"> Log in</button>
    <p> Don't  have an account? <a href="registrationform.php.php"><i>Register here </i></a></p>
</form>

</div>
</body>
</html>