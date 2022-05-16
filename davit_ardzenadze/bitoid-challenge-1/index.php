<?php
    require_once "upload.php"
?> 

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
    <link rel="stylesheet" href="index.css">
    <title>User Profile</title>
</head>
<body>
    <div class="container ">
        <?php  if($displeyInputs): ?>
            <div  class="d-flex flex-column justify-content-center align-items-center" style="height: 100vh">
            <?php  if($erorr): ?>
                <div class="alert alert-danger d-flex align-items-center" role="alert">
                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="currentColor" class="bi bi-exclamation-triangle-fill flex-shrink-0 me-2" viewBox="0 0 16 16" role="img" aria-label="Warning:">
                        <path d="M8.982 1.566a1.13 1.13 0 0 0-1.96 0L.165 13.233c-.457.778.091 1.767.98 1.767h13.713c.889 0 1.438-.99.98-1.767L8.982 1.566zM8 5c.535 0 .954.462.9.995l-.35 3.507a.552.552 0 0 1-1.1 0L7.1 5.995A.905.905 0 0 1 8 5zm.002 6a1 1 0 1 1 0 2 1 1 0 0 1 0-2z"/>
                    </svg>
                    <div><?= $erorr ?></div>
                </div>
             <?php  endif ?>
                <div class="form shadow-lg p-3 mb-5 bg-body rounded">
                    <form action="" method="POST" enctype="multipart/form-data">
                        <div  style="width: 25rem;">
                            <div class="row  m-3" >
                                <input 
                                    type="text" 
                                    name="name" 
                                    class="form-control" 
                                    placeholder="First name" 
                                    pattern="^[A-Z]+$" 
                                    title="input only A-Z"
                                    required
                                >
                            </div>
                            <div class="row m-3">
                                <input 
                                    type="text" 
                                    name="lastname" 
                                    class="form-control" 
                                    placeholder="Last name" 
                                    pattern="^[A-Z]+$" 
                                    title="input only A-Z"
                                    required
                                >
                            </div>
                            <div class="row m-3">
                                <input 
                                    type="file"
                                    name="image" 
                                    class="form-control" 
                                    accept="image/*"
                                    required
                                >
                            </div>
                            <div class="row m-3">
                                <input class="btn btn-primary" type="submit" name="submit"></input>
                            </div>
                        </div>
                    </form>  
                </div>
            </div>
        <?php  else: ?>
                <div class="d-flex justify-content-center mt-5">
                    <div class="card border border-3 shadow p-3 mb-5 bg-body rounded" style="width: 18rem;">
                        <img class="card-img-top rounded" src="image/<?= $fileName ?>" alt="image">
                        <div class="card-body">
                            <p class="card-text"><?= $name ?></p>
                            <p class="card-text"><?= $lastname  ?></p>
                        </div>
                    </div>
                 </div>
        <?php endif ?>
    </div>
</body>
</html>