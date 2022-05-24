<?php 
    session_start();
    
    if(!isset($_SESSION['name'])):    
?>
    <!DOCTYPE html>
    <html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Document</title>
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
    </head>
    <body>
    <div class="container mt-5 pt-5">
            <div class="row">
                <div class="col-12 col-sm-8 col-md-6 m-auto">
                    <div class="card border-0 shadow">
                        <div class="card-body">
                            <?php if(isset($_GET['error'])){ ?>
                                <p class="alert alert-danger" role="alert"><?php echo $_GET['error']?>
                            <?php } ?>
                            <div style="text-align: center">
                                <svg class="my-3" xmlns="http://www.w3.org/2000/svg" width="50" height="50" fill="currentColor" class="bi bi-person-circle" viewBox="0 0 16 16">
                                    <path d="M11 6a3 3 0 1 1-6 0 3 3 0 0 1 6 0z"/>
                                    <path fill-rule="evenodd" d="M0 8a8 8 0 1 1 16 0A8 8 0 0 1 0 8zm8-7a7 7 0 0 0-5.468 11.37C3.242 11.226 4.805 10 8 10s4.757 1.225 5.468 2.37A7 7 0 0 0 8 1z"/>
                                </svg>
                            </div>
                            
                            <form action="form.php" method="POST">
                                <input class="form-control my-3 py-2" name="user_name" placeholder="GitHub UserName" />
                                <div class="text-center mt-3">
                                    <button class="btn btn-primary">Click</button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
    </div>
        
    </body>
    </html>
    <?php else :
        header('Location: home.php'); 
        endif
    ?>