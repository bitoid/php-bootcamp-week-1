<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title>Document</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>
</head>
<body style="background: ">

<div class="container" style="margin-top: 40px">

    <form method="POST" enctype="multipart/form-data" action="index.php">
        <div class="form-group row">
            <label for="firstname" class="col-sm-2 col-form-label">Firstname</label>
            <div class="col-sm-10">
                <input type="text" class="form-control" id="firstname"
                       pattern="[a-zA-Z]+" title="only Letters"
                       name="firstname" placeholder="Firstname" required>
            </div>
        </div>
        <div class="form-group row">
            <label for="lastname" class="col-sm-2 col-form-label">Lastname</label>
            <div class="col-sm-10">
                <input type="text" name="lastname" id="lastname"
                       pattern="[a-zA-Z]+" title="only Letters"
                       class="form-control" placeholder="Lastname" required>
            </div>
        </div>
        <label class="custom-file-label" for="formFile">Choose Picture...</label>
        <input class="form-control" name="image" type="file" id="formFile">
        <fieldset class="form-group">
            <div class="row">
                <div class="col-sm-10">
                    <div class="form-check">
                        <input class="form-check-input" type="checkbox" name="get_repos" id="repos">
                        <label class="form-check-label" for="repos">
                            Collect Github Repositories
                        </label>
                    </div>
                    <div class="form-check">
                        <input class="form-check-input" type="checkbox" name="get_followers" id="followers">
                        <label class="form-check-label" for="followers">
                            Collect Github Followers
                        </label>
                    </div>
                </div>
            </div>
        <div class="form-group row">
            <div class="col-sm-10">
                <input type="submit" class="btn btn-primary" name="submit">
            </div>
        </div>
    </form>
    <?php if(! isset($profile['error'])):?>
        <?php if(! empty($profile)):?>
            <div class="row" style="margin-top: 30px">
                <?php if(isset($profile['image'])):?>
                    <div class="col-sm-4">
                        <img src="<?=$profile['image']?>" alt="profile_pic"
                             style="border-radius: 3%" height=200 width=300 />
                    </div>
                <?php endif?>
                <div class="col-sm-3">
                    <?php if($profile['firstname']):?>
                        <h3><?= $profile['firstname'] ?></h3>
                    <?php endif?>
                    <?php if($profile['lastname']):?>
                        <h3><?= $profile['lastname'] ?></h3>
                    <?php endif?>
                </div>
            </div>
        <?php endif?>

        <?php if(! empty($repos)):?>
            <h2><?=$profile['firstname']?>'s Github Repositories</h2>
            <table class="table">
                <tr>
                    <th scope="col">#</th>
                    <th scope="col">Name</th>
                    <th scope="col">Description</th>
                    <th scope="col">URL</th>
                </tr>
                <?php for($i=0; $i < count($repos); $i++):?>

                    <tr>
                        <th scope="col"><?= $i+1 ?></th>
                        <th scope="col"><?= $repos[$i]['name']?></th>
                        <th scope="col"><?= $repos[$i]['description']?></th>
                        <th scope="col">
                            <a href="<?= $repos[$i]['url']?>" target="_blank"> <?= $repos[$i]['url']?> </a>
                        </th>
                    </tr>
                <?php endfor ?>
            </table>
        <?php endif ?>

        <?php if(! empty($followers)):?>
            <h2><?=$profile['firstname']?>'s Github Folowers</h2>
            <table class="table">
                <tr>
                    <th scope="col">#</th>
                    <th scope="col">Avatar</th>
                    <th scope="col">name</th>
                </tr>
                <?php for($i=0; $i < count($followers); $i++):?>

                    <tr>
                        <th scope="col"><?= $i+1 ?></th>
                        <th scope="col">
                            <a href="<?=$followers[$i]['profile_url']?>" target="_blank">
                                <img src="<?= $followers[$i]['img_url'] ?>"
                                     height=50 width=50 style="border-radius: 50%">
                            </a>
                        </th>
                        <th scope="col"><?= $followers[$i]['name']?></th>
                    </tr>
                <?php endfor ?>
            </table>
        <?php endif ?>
    <?php else:?>
        <h1 class="alert alert-danger"><?= $profile['error']?></h1>
    <?php endif?>
</div>

</body>
</html>