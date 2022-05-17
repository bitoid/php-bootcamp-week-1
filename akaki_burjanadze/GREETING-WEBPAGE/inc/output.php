<div class="container text-center mt-5">
    <div>
        <?php if ($inputs): ?>
            <h2><?php echo $inputs['first_name'] . ' ' . $inputs['last_name'] ?></h2>
            <br />
            <img width="400" height="400" src="<?php echo 'images/'.$image['name'] ?>">
            <br />
            <br />
            <a href="index.php">
                <button class="btn btn-primary text-white">
                    Go back
                </button>
            </a>
        <?php endif; ?>
    </div>
</div>