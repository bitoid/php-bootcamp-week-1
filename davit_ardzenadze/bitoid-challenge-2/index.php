<?php  require "githubApi.php"; ?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
    <title>Document</title>
</head>
<body>
    <div class="container">
            <div class="row d-flex justify-content-center mb-5 ">
                <div class=" col-sm-12  col-md-6">   
                    <form action="" method="POST">
                        <div class="input-group mt-5 shadow p-3 mb-3 bg-body rounded">
                            <input type="text"  name="name" class="form-control" placeholder="username"  required>
                            <button class="btn btn-outline-secondary" type="submit" name="submit">search</button>
                        </div>
                        <div class="d-flex flex-row justify-content-evenly">
                            <div class="form-check">
                                <input class="form-check-input" type="radio" name="githubApi" id="Both" value="Both" checked>
                                <label class="form-check-label" for="Both"> Both</label>
                            </div>
                            <div class="form-check">
                                <input class="form-check-input" type="radio" name="githubApi" id="followers" value="followers">
                                <label class="form-check-label" for="followers">followers</label>
                            </div>
                            <div class="form-check">
                                <input class="form-check-input" type="radio" name="githubApi" id="repositories" value="repositories">
                                <label class="form-check-label" for="repositories">repositories</label>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        <div class="row  gx-5">
            <?php if($userInfo == 'repositories' || $userInfo == 'Both'): ?>
                <div class="col">
                    <table class="table table-hover">
                        <thead >
                            <tr class="shadow-sm p-3 mb-5 bg-body rounded">
                                <th scope="col" class="text-center">#</th>
                                <th scope="col" class="text-center">image</th>
                                <th scope="col" class="text-center">repository name</th>
                                <th scope="col"></th>
                            </tr>
                        </thead>
                        <tbody>
                        <?php foreach($userRepos  as $i => $repo): ?>
                            <tr class="shadow-sm  p-3 mb-5 bg-body rounded">
                                <th scope="row"><?= $i + 1 ?></th>
                                <td>
                                    <img class="rounded-circle" src="<?= $repo->owner->avatar_url?>" alt="image" style="width: 50px;" >
                                </td>
                                <td class="text-center"> 
                                    <?= $repo->name ?>
                                </td>
                                <td>
                                    <a href="<?= $repo->html_url ?>" target="_blank">
                                        <button type="button" class="btn btn-info">visit</button>
                                    </a>
                                </td>
                            </tr>
                        <?php endforeach; ?>
                        </tbody>
                    </table>
                </div>
            <?php endif ;?>
            <?php if($userInfo == 'followers' || $userInfo == 'Both'): ?>
                <div class="col">
                    <table class="table table-hover">
                        <thead>
                            <tr class="shadow-sm  p-3 mb-5 bg-body rounded">
                                <th scope="col" >#</th>
                                <th scope="col" >image</th>
                                <th scope="col" class="text-center">folower name</th>
                                <th scope="col"></th>
                            </tr>
                        </thead>
                        <tbody>
                        <?php foreach($userfolowers as $v => $folower): ?>
                            <tr class="shadow-sm  p-3 mb-5 bg-body rounded">
                                <th scope="row"> <?= $v + 1 ?></th>
                                <td >
                                    <img class="rounded-circle" src="<?= $folower->avatar_url ?>" alt="image" style="width: 50px;" >
                                </td>
                                <td class="text-center">
                                    <?= $folower->login ?>
                                </td>
                                <td class="text-center">
                                    <a href="<?= $folower->html_url ?>" target="_blank">
                                        <button type="button" class="btn btn-info">visit</button>
                                    </a>
                                </td>
                            </tr>
                        <?php endforeach ;?>
                        </tbody>
                    </table>
                </div>
            <?php endif ;?>
        </div>
    </div>
</body>
</html>