<?php
    // echo '<pre>';
    // print_r($_FILES['image']);
    
    // echo '</pre>';

    if($_SERVER["REQUEST_METHOD"] == 'POST'){
        
        

        if(empty($_POST['user_name']) && empty($_POST['last_name']) && empty($_FILES['image']['tmp_name'])){
            header('Location: index.php?error=გთხოვთ შეავსოთ ველები.');
        }else{
            if(!empty($_POST['user_name'])){
                $name = $_POST['user_name'];
                if (!preg_match("/^[a-zA-Z-' ]*$/",$name)) {
                    header('Location: index.php?error=გთხოვთ შეიყვანეთ მხოლოდ ასოები.');
                    exit();
                }              
                
            }else{
                header('Location: index.php?error=გთხოვთ შეიყვანეთ სახელი.');
                exit();
            }
            if(!empty($_POST['last_name'])){
                $last_name = $_POST['user_name'];
                if (!preg_match("/^[a-zA-Z-' ]*$/",$last_name)) {
                    header('Location: index.php?error=გთხოვთ შეიყვანეთ მხოლოდ ასოები.');
                    exit();
                }  
            }else{
                header('Location: index.php?error=გთხოვთ შეიყვანეთ გვარის ველი.');
                exit();

            }
            // var_dump($_FILES['images']);
            // exit();
            if(empty($_FILES['image']['tmp_name'])){
                header('Location: index.php?error=გთხოვთ შეავსოთ Image.');
            }else{
                    if($_FILES['image']['type'] == 'image/png' || $_FILES['image']['type'] == 'image/jpg'){
                        $image = $_FILES['image'];
                        $imagePath = '';
                        if(!is_dir('images')){
                            mkdir('images');
                        }
                        $imagePath = 'images/' . time() .'_' . $image['name'];                    
                        move_uploaded_file($image['tmp_name'],$imagePath);
                    }else{
                        header("Location: index.php?error=მხოლოდ jpg და png გაფარტოების ფაილის ატვირთვა შეგიძლიათ");
                    }
        
            } 
        }
    }
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0-beta1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-0evHe/X+R7YkIZDRvuzKMRqM+OrBnVFBL6DOitfPri4tjfHxaWutUpFmBp4vmVor" crossorigin="anonymous">
</head>
<body>
    <?php if($_SERVER['REQUEST_METHOD'] == 'GET'){ ?>

        <div class="container mt-4">
            <div class="row justify-content-center">
                <div class="col-md-8">
                    <div class="card">
                        <div class="card-header">
                           <h1>რეგისტრაცია</h1>
                        </div>

                        <div class="card-body">
                            <?php if(isset($_GET['error'])){ ?>
                                    <p class="alert alert-danger" role="alert"><?php echo $_GET['error']?>
                            <?php } ?>
                                <form method="POST" action="<?php $_SERVER['PHP_SELF'] ?>" enctype="multipart/form-data">
                                    <div class="mb-3">
                                        <label class="form-label">სახელი: </label>
                                        <input type="text" class="form-control" name="user_name"  placeholder="User Name">
                                    </div>
                                    <div class="mb-3">
                                        <label  class="form-label">გვარი: </label>
                                        <input type="text" class="form-control" name="last_name"  placeholder="Last Name" >
                                    </div>
                                    <div class="mb-3">
                                        <label for="formFile" class="form-label d-flex">ფოტოს ატვირთვა</label>
                                        <span class=""><strong>მხოლოდ jpg და png გაფართოების ფოტო.</strong></span>
                                        <input class="form-control" type="file" name="image"  id="formFile">
                                    </div>
                                    <div class="mb-3 align-items-center">
                                        <button class="btn btn-primary"  type="submit" name=submit>Click Me</button>
                                    </div>
                                </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
       
    <?php } else { ?>
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-md-8">
                    <div class="card">
                        <div class="card-header">User</div>

                        <div class="card-body">
                            <a href="/index.php" class="btn btn-warning">Back</a>

                            <div class="card" style="width:400px">
                                <img class="card-img-top" src="<?php echo $imagePath ?>" alt="Card image" style="width:100%">
                                <div class="card-body">
                                    <h4 class="card-title"><?php echo "$name $last_name" ?></h4>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    <?php } ?>
</body>
</html>