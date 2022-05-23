<div class="infoContainer">
        <?php if (isset($_POST['btn']) && $opt == "both" && !empty($jsons_repo)) : ?>
            <?php foreach ($jsons_repo as $data) : ?>
                <h2>name: <?php echo $data->name; ?></h2>
                <p>id: <?php echo $data->id; ?></p>
                <p>full_name: <?php echo $data->full_name; ?></p>
                <p>login: <?php echo $data->owner->login; ?></p>
                <p>followers_url: <?php echo $data->owner->followers_url; ?></p>
                <p>deployments_url: <?php echo $data->deployments_url; ?></p>
                <p>created_at: <?php echo $data->created_at; ?></p>
                <p>updated_at: <?php echo $data->updated_at; ?></p>
                <p>pushed_at: <?php echo $data->pushed_at; ?></p>
                <p>git_url: <?php echo $data->git_url; ?></p>
                <p>clone_url: <?php echo $data->clone_url; ?></p>
                <p>ssh_url: <?php echo $data->ssh_url; ?></p>
                <p>svn_url: <?php echo $data->svn_url; ?></p>
                <p>visibility: <?php echo $data->visibility; ?></p>
                <p>default_branch: <?php echo $data->default_branch; ?></p>
                <hr style="background-color:white; width: 90%;">
            <?php endforeach ?>

            <?php foreach ($jsons_followers as $data) : ?>
                <h2><?php echo $data->login; ?></h2>
                <img src="<?php echo $data->avatar_url; ?>">
            <?php endforeach ?>

        <?php elseif (isset($_POST['btn']) && $opt == "repo" && !empty($jsons_repo)) : ?>
            <?php foreach ($jsons_repo as $data) : ?>
                <h2>name: <?php echo $data->name; ?></h2>
                <p>id: <?php echo $data->id; ?></p>
                <p>full_name: <?php echo $data->full_name; ?></p>
                <p>login: <?php echo $data->owner->login; ?></p>
                <p>followers_url: <?php echo $data->owner->followers_url; ?></p>
                <p>deployments_url: <?php echo $data->deployments_url; ?></p>
                <p>created_at: <?php echo $data->created_at; ?></p>
                <p>updated_at: <?php echo $data->updated_at; ?></p>
                <p>pushed_at: <?php echo $data->pushed_at; ?></p>
                <p>git_url: <?php echo $data->git_url; ?></p>
                <p>clone_url: <?php echo $data->clone_url; ?></p>
                <p>ssh_url: <?php echo $data->ssh_url; ?></p>
                <p>svn_url: <?php echo $data->svn_url; ?></p>
                <p>visibility: <?php echo $data->visibility; ?></p>
                <p>default_branch: <?php echo $data->default_branch; ?></p>
                <hr style="background-color:white; width: 90%;">
            <?php endforeach ?>

        <?php elseif (isset($_POST['btn']) && $opt == "followers" && !empty($jsons_followers)) : ?>

            <?php foreach ($jsons_followers as $data) : ?>
                <h2><?php echo $data->login; ?></h2>
                <img src="<?php echo $data->avatar_url; ?>">
            <?php endforeach ?>

        <?php endif ?>

    </div>
