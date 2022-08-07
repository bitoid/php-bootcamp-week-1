<!DOCTYPE html>
<html lang="en">
<?php require 'index.php'; ?>

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="./dist/output.css" rel="stylesheet">
    <title>Document</title>
</head>

<body>








    <?php if (empty($_POST) || !empty($nameErr)) : ?>
    <div class="grid grid-cols-3">
        <form action="" method="post" class="p-4">
            <input class="border border-amber-300" type="text" name="username" id="searchbox"
                placeholder="input username" value="<?php $username; ?>">
            <span style="color:red"><?= $nameErr ?></span>
            <label for="repo">Repo</label>
            <input class="accent-pink-300 md:accent-pink-500" type="radio" name="arr[]" value="repos" id="repos"
                checked>
            <label for="follow">Folowers</label>
            <input type="radio" name="arr[]" value="followers" id="followers">

            <input class="border outline outline-offset-2 outline-blue-500" type="submit" value="Search">
        </form>

    </div>


    <?php elseif ($repos === "followers") : ?>
    <main class="px-64 py-8   bg-gray-100  ">

        <div class=" container ">
            <?php foreach ($result as $info) { ?>
            <div class="card m-4">
                <img src="<?= $info["avatar_url"] ?>" alt="profile picture" class="w-full h-32 sm:h-48 object-cover">
                <div class="m-4">
                    <span class="font-bold"><?= $info["login"] ?></span>
                    <span class=" text-emerald-300">
                        <a href="<?= $info["html_url"] ?>">See Profile</a>
                    </span>
                </div>
            </div>
            <?php } ?>

        </div>

        <div class=" px-96 space-x-2 flex justify-start items-center">
            <h5>pagging</h5>
            <?php for ($page = 1; $page <= $pag_page_num; $page++) : ?>
            <a class="w-10 h-10 flex justify-center items-center border border-blue-300 rounded-full 
        hover:bg-blue-500 text-blue-500 hover:text-white" href="repos.php?page=<?= $page ?>"><?= $page ?></a>
            <?php endfor; ?>
        </div>

    </main>
    <!-- repos output -->
    <?php elseif ($repos === "repos") : ?>

    <?php foreach ($result as $info) : ?>
    <li><a href="<?= $info["html_url"] ?>"> <?= $info["name"] ?></a></li>
    <?php endforeach ?>
    <?php else : ?>
    <h1><?= $dataErr ?></h1>
    <?php endif; ?>
















</body>

</html>