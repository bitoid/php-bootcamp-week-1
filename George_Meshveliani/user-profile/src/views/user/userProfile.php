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
    <div class="card" style="width: 18rem;">
        <img class="card-img-top" src='<?= $target_file ?>' alt="img" />
        <div class="card-body">
            <h4 class="card-title"><?= $name . ' ' . $lastName ?></h4>
            <h5>File name:</h5>
            <p class="card-text">
                <?=  $target_file ?>
            </p>
            <h5>uid: </h5>
            <p class="card-text">
                <?=  $user_id ?>
            </p>
            <a href="/" class="btn btn-primary">Add more users</a>
        </div>
    </div>
</div>";