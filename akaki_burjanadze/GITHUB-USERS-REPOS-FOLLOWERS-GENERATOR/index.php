<?php include 'inc/header.php' ?>

<?php
    $USERNAME_REQUIRED;
    $data_to_render = 'repos';

    if (isset($_POST['submit'])) {
        if (!$_POST['username']) {
            $USERNAME_REQUIRED = 'Github Username is required';
        }

        if ($_POST['category']) {
            $data_to_render = htmlspecialchars($_POST['category']);
        }

        // get github user
        $github_user_json = get_api_data('https://api.github.com/users/'.htmlspecialchars($_POST['username']), 'REPOS-FOLLOWERS-GENERATOR');
        $github_user = json_decode($github_user_json, true);

        // get user repos
        if ($data_to_render === 'repos') {
            $repos_json = get_api_data('https://api.github.com/users/'.htmlspecialchars($_POST['username']).'/repos?page=1&per_page=100', 'REPOS-FOLLOWERS-GENERATOR');
            $repos = json_decode($repos_json, true);
        }

        // get user followers
        if ($data_to_render === 'followers') {
            $followers_json = get_api_data('https://api.github.com/users/'.htmlspecialchars($_POST['username']).'/followers?page=1&per_page=100', 'REPOS-FOLLOWERS-GENERATOR');
            $followers = json_decode($followers_json, true);
        }

        // get repos and followers
        if ($data_to_render === 'both') {
            $repos_json = get_api_data('https://api.github.com/users/'.htmlspecialchars($_POST['username']).'/repos?page=1&per_page=100', 'REPOS-FOLLOWERS-GENERATOR');
            $repos = json_decode($repos_json, true);

            $followers_json = get_api_data('https://api.github.com/users/'.htmlspecialchars($_POST['username']).'/followers?page=1&per_page=100', 'REPOS-FOLLOWERS-GENERATOR');
            $followers = json_decode($followers_json, true);
        }
    }

?>

<div class="container mt-5">
    <form action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']) ?>" method="POST">
        <div class="mb-5">
            <label class="form-label text-white" for="username">Github Username</label>
            <input class="form-control" type="text" name="username" id="username" placeholder="Enter a github username">
            <?php if (!empty($USERNAME_REQUIRED)): ?>
                <div class="form-text text-danger">
                    <?php echo $USERNAME_REQUIRED ?>
                </div>
            <?php endif; ?>
            <br />
            <select class="form-select" name="category">
                <option value="repos">Repos</option>
                <option value="followers">Followers</option>
                <option value="both">Repos and Followers</option>
            </select>
            <br />
            <button style="width: 100%;" class="btn btn-success btn-medium" name="submit" type="submit">
                Search
            </button>
        </div>
    </form>
</div>

<div class="container">
    <?php if (!empty($repos) && empty($github_user['message']) && $data_to_render === 'repos'): ?>
        <ul class="list-group">
            <?php foreach ($repos as $repo): ?>
                <a href="<?php echo $repo['html_url'] ?>">
                    <li class="list-group-item text-white bg-primary rounded m-2">
                        <?php echo $repo['name'] ?>
                    </li>
                </a>
            <?php endforeach; ?>
        </ul>
    <?php elseif (!empty($followers) && empty($github_user['message']) && $data_to_render === 'followers'): ?>
        <div class="row justify-content-center">
            <div class="col-auto">
                <table class="table table-secondary">
                    <thead>
                        <th scope="col">#</th>
                        <th scope="col">Name</th>
                        <th scope="col">Image</th>
                    </thead>
                    <tbody>
                        <?php for ($i = 0; $i < count($followers); $i++): ?>
                            <tr>
                                <th scope="row">
                                    <?php echo $i ?>
                                </th>
                                <td>
                                    <a href="<?php echo $followers[$i]['html_url'] ?>">
                                        <?php echo $followers[$i]['login'] ?>
                                    </a>
                                </td>
                                <td>
                                    <a href="<?php echo $followers[$i]['html_url'] ?>">
                                        <img width="100" height="100" src="<?php echo $followers[$i]['avatar_url'] ?>" alt="<?php echo $followers[$i]['login'] ?>">
                                    </a>
                                </td>
                            </tr>
                        <?php endfor; ?>
                    </tbody>
                </table>
            </div>
        </div>
    <?php elseif (!empty($repos) && !empty($followers) && empty($github_user['message']) && $data_to_render === 'both'): ?>
        <div class="d-flex justify-content-center">
            <div>
                <h2 class="text-white m-3">Repos</h2>
                <br />
                <?php foreach ($repos as $repo): ?>
                    <a href="<?php echo $repo['html_url'] ?>">
                        <li class="p-2 text-white bg-primary rounded m-3">
                            <?php echo $repo['name'] ?>
                        </li>
                    </a>
                <?php endforeach; ?>
            </div>
            <div>
                <h2 class="text-white m-3">Followers</h2>
                <br />
                <?php foreach ($followers as $follower): ?>
                    <a href="<?php echo $follower['html_url'] ?>">
                        <div class="border p-2 m-3 bg-primary text-white">
                            <?php echo $follower['login'] ?>
                        </div>
                    </a>
                    <a href="<?php echo $follower['html_url'] ?>">
                        <div>
                            <img class="m-3" width="200" height="200" src="<?php echo $follower['avatar_url'] ?>" alt="<?php echo $follower['login'] ?>">
                        </div>
                    </a>
                <?php endforeach; ?>
            </div>
        </div>
    <?php endif; ?>
</div>

<?php include 'inc/footer.php' ?>