<?php 
    session_start();


    if(isset($_SESSION['user_name'])){

        $url_user = "https://api.github.com/users/{$_SESSION['user_name']}";
        $curl_user = curl_init();

        curl_setopt_array($curl_user,[
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_URL => $url_user,
            CURLOPT_USERAGENT => $_SESSION['user_name']
        ]);

        $response_user = curl_exec($curl_user);
        $decode_user = json_decode($response_user,true);
        
        if(!isset($decode_user['message'])){
            $_SESSION['followers'] = $decode_user['followers'];
            $_SESSION['repos'] = $decode_user['public_repos'];
        }
       
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
        <body style="background-color: #eee;">
            
            <section >
                <div class="container py-5">
                    <div class="row">
                        <?php if(!isset($decode_user['message'])) { ?>
                            <div class="col">
                                <nav aria-label="breadcrumb" class="bg-light rounded-3 p-3 mb-4">
                                <?php if(isset($_GET['warning'])){ ?>
                                    <p class="alert alert-warning" role="alert"><?php echo $_GET['warning']?>
                                <?php } ?>
                                <ol class="breadcrumb mb-0">
                                    <li class="breadcrumb-item"><a href="#">Home</a></li>
                                    <li class="breadcrumb-item"><a href="#">User</a></li>
                                    <li class="breadcrumb-item active" aria-current="page">User Profile</li>
                                </ol>
                            
                                </nav>
                            </div>
                            

                            <div class="row">
                                <div class="col-lg-4">
                                    <div class="card mb-4">
                                        <div class="card-body text-center">
                                            <img src="<?php echo $decode_user['avatar_url'] ?>" alt="avatar"
                                            class="rounded-circle img-fluid" style="width: 150px;">
                                            <h5 class="my-3"><?php echo $decode_user['login'] ?></h5>
                                            <p class="text-muted mb-1">Full Stack Developer</p>
                                            <p class="text-muted mb-4"><?php echo $decode_user['location'] ?></p>
                                            <div class="d-flex justify-content-center mb-2">
                                            <?php if($decode_user['followers'] == 0 && $decode_user['public_repos'] == 0) {    
                                            ?>  
                                            <?php }  else { 
                                                            if($decode_user['followers'] > 0){
                                            ?>
                                                                <a href="view_followers.php?per_page=10&page=1" class="btn btn-primary">View Followers</a>
                                                            <?php }?>
                                                            <?php if($decode_user['public_repos']) { ?>
                                                                <a href="rep_view.php?per_page=10&page=1"  class="btn btn-outline-primary ms-1">View Repositor</a>
                                                            <?php } ?>
                                            <?php }
                                            ?>
                                            <a href="logout.php" class="btn btn-outline-primary ms-1">Logout</a>

                                            </div>
                                        </div>
                                    </div>
                                    
                            </div>
                            <div class="col-lg-8">
                                <div class="card mb-4">
                                    <div class="card-body">
                                        <div class="row">
                                            <div class="col-sm-3">
                                                <p class="mb-0">Full Name</p>
                                            </div>
                                            <div class="col-sm-9">
                                                <p class="text-muted mb-0"><?php echo $decode_user['name'] ?? $decode_user['login'] ?></p>
                                            </div>
                                        </div>
                                        <hr>
                                        <div class="row">
                                            <div class="col-sm-3">
                                                <p class="mb-0">Following</p>
                                            </div>
                                            <div class="col-sm-9">
                                                <p class="text-muted mb-0"><?php echo $decode_user['following'] ?></p>
                                            </div>
                                        </div>
                                        <hr>
                                        <div class="row">
                                        <div class="col-sm-3">
                                            <p class="mb-0">Followers</p>
                                        </div>
                                        <div class="col-sm-9">
                                            <p class="text-muted mb-0"><?php echo $decode_user['followers'] ?></p>
                                        </div>
                                        </div>
                                        
                                        <hr>
                                        <div class="row">
                                            <div class="col-sm-3">
                                                <p class="mb-0">Git Hub LInk </p>
                                            </div>
                                            <div class="col-sm-9">
                                                <a href="<?php echo $decode_user['html_url'] ?>"><p class="text-muted mb-0">Here</p></a>
                                            </div>
                                        </div>
                                        <hr/>
                                        <div class="row">
                                        <div class="col-sm-3">
                                            <p class="mb-0">Address</p>
                                        </div>
                                        <div class="col-sm-9">
                                            <p class="text-muted mb-0"><?php echo $decode_user['location'] ?? 'Not Found' ?></p>
                                        </div>
                                        </div>
                                    </div>
                                </div>
                                
                        </div>
                        </div>
                        <?php } else {?>
                        <?php 
                            echo "<h1>{$decode_user['message']}<h1>";
                            echo "<a href='logout.php' class='btn btn-primary'>Logout</a>";

                         }?>
                    </div>
                </div>
            </section>

        </body>
        </html>
<?php   }else{
            header('Location: index.php?error=თქვენ არ გაგივლიათ ავტორიზაცია');
        }
?>