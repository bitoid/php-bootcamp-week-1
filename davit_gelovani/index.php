<!doctype HTML>
<html>
    <head> 
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title>Challange 1</title>
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-gH2yIJqKdNHPEq0n4Mqa/HGKIhSkIHeL5AyhkYV8i59U5AR6csBvApHHNl/vI1Bx" crossorigin="anonymous">
    </head>
    <body class="container">
        <form action="/upload.php" method="POST" enctype="multipart/form-data">
                <legend>Fill the form:</legend>
                <div class="mb-3">
                  <label for="nameInput" class="form-label">Name</label>
                  <input type="text" name="name" class="form-control" id="nameInput" aria-describedby="emailHelp">
                </div>
                <div class="mb-3">
                  <label for="surnameInput" class="form-label">Surname</label>
                  <input type="text" name="surname" class="form-control" id="surnameInput" aria-describedby="emailHelp">
                </div>
                <div class="mb-3">
                  <label for="formFile" class="form-label">Upload your profile picture</label>
                  <input class="form-control" name="profile" type="file" id="formFile">
                </div>

                <input type="submit" name="submit" class="btn btn-success" />
        </form> 
    </body>
  
</html>