<!doctype HTML>
<html>
    <head> 
    </head>
    <body>
        <form action="/upload.php" method="POST" enctype="multipart/form-data">
            <h1>Fill the form:</h1>
            <input type="text" name="name" placeholder="Enter your name:" />
            <input type="text" name="surname" placeholder="Enter your surname:" />
            <input type="file" name="profile" />
            <input type="submit" name="submit" />
        </form> 
    </body>
  
</html>