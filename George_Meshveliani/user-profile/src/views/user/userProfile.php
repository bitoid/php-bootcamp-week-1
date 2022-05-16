<style>
    .profile {
        padding: 50px 0 50px 43%;
        background: springgreen;
        border: 5px solid lightgreen;
        text-align: justify;
    }
    img {
        border-radius: 5px;
    }
</style>
<div class='profile'>
    <li>First name: <?= $name ?></li>
    <li>Last name:<?= $lastName ?></li>
    <li>UserId:<?= $user_id ?></li>
    <li>File name:<?= $target_file ?></li>
    <img src='<?= $target_file ?>'width='300' height='250' />
</div>";