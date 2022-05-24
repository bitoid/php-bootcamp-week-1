<?php 
    session_start();
    if(isset($_SESSION['name'])):
        if($_SESSION['repos'] > 0):
            $url_repositor = "https://api.github.com/users/{$_SESSION['name']}/repos?per_page={$_GET['per_page']}&page={$_GET['page']}";

            $n = 1;
            $repos = $_SESSION['repos'];
            while($repos > 10 ):
                $repos -= 10 ;
                $n++;
            endwhile;

            include '_function.php';

            $response = getAPIDate($url_repositor,$_SESSION['name']);
            
        else:
            header('Location: home.php?warning=სამწუხაროდ ვერ მოიძებნა Repositor');
        endif
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
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">
                        <a href="<?= '/home.php' ?>" class="btn btn-info">Back</a>

                        <h1 class="d-flex justify-content-center"><?= $_SESSION['name']."'s  Repositors"  ?></h1>

                    </div>

                    <div class="card-body">
                    <?php if(!isset($response['message'])): ?>
                        <table class="table table-striped">
                            <thead>
                                <tr>
                                    <th scope="col">ID</th>
                                    <th scope="col">Repositor's Name</th>
                                    <th scope="col">Repositor's Link</th>
                                    <th scope="col">Full Name</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                     $id = 0; 
                                     foreach ($response as $repositor):
                                    $id++         
                                ?>
                                <tr>
                                    <td><?=  $id ?></td>
                                    <td><?= $repositor['name'] ?></td>
                                    <td>
                                        <a href="<?php echo $repositor['html_url']?>" target="_blank" class="btn btn-danger">Link</a>
                                    </td>
                                    <td><?= $repositor['full_name'] ?></td>
                                </tr>
                                <?php 
                                    endforeach
                                ?>
                            </tbody>
                        </table>
                        <ul class="pagination">
                            <?php 
                                    $i = 1;
                                    while($i <= $n ):                  
                            ?>
                                <li class="page-item"><a class="page-link" href=<?php echo "{$_SERVER['PHP_SELF']}?per_page=10&page=$i" ?>><?= $i++ ?></a></li>
                            <?php 
                                endwhile 
                            ?>
                        </ul>
                        <?php  else : ?>
                            <?= "<h1>{$decode_repos['message']}</h1>"; ?>
                        <?php 
                            endif;
                        ?>
                    </div>
                </div>
            </div>
        </div>
    </div>
</body>
</html>
<?php  
    else : 
        header('Location: index.php?error=თქვენ არ გაგივლიათ ავტორიზაცია');
    endif;
?>