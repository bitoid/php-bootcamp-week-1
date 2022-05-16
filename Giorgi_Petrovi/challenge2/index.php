<?php

    if (!empty($_GET)) {
        require_once 'request.php';
        
        $user_info = fetch_data("https://api.github.com/users/".$_GET['username'], []);
        $repos = [];
        $followers = [];

        if (!key_exists('error', $user_info) && $user_info['public_repos'] > 0) {
            $pages = ceil($user_info['public_repos'] / 100);
            for ($i = 1; $i <= $pages; $i++) {
                array_push(
                    $repos, 
                    ...fetch_data("https://api.github.com/users/".$_GET['username']."/repos?", array(
                        'per_page' => 100,
                        'page' => $i,
                    ))
                );
            }
        }
    
        if (!key_exists('error', $user_info) && $user_info['followers'] > 0) {
            $pages = ceil($user_info['followers'] / 100);
            for ($i = 1; $i <= $pages; $i++) {
                array_push(
                    $followers,
                    ...fetch_data("https://api.github.com/users/".$_GET['username']. "/followers?", array(
                        'per_page' => 100,
                        'page' => $i,
                    ))
                );
            }
        } 
    }
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Bitoid Week #1</title>
    <link href="https://fonts.googleapis.com/css2?family=Roboto+Slab:wght@300&display=swap" rel="stylesheet">
    <link rel='stylesheet' href='style.css'>
</head>
<body>
    <div class="wrapper">
        <form action="/index.php" maethod='GET' class="form">
            <div class="form__title">
                SEARCH
            </div>
            <div class="form__search-bar">
                <input type="text" id='search_input' name="username" class="form__input"  placeholder="Ex. Anemoiaa" require>
                <button type="submit" class="form__submit-button"><svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24"><path d="M12 0c-6.626 0-12 5.373-12 12 0 5.302 3.438 9.8 8.207 11.387.599.111.793-.261.793-.577v-2.234c-3.338.726-4.033-1.416-4.033-1.416-.546-1.387-1.333-1.756-1.333-1.756-1.089-.745.083-.729.083-.729 1.205.084 1.839 1.237 1.839 1.237 1.07 1.834 2.807 1.304 3.492.997.107-.775.418-1.305.762-1.604-2.665-.305-5.467-1.334-5.467-5.931 0-1.311.469-2.381 1.236-3.221-.124-.303-.535-1.524.117-3.176 0 0 1.008-.322 3.301 1.23.957-.266 1.983-.399 3.003-.404 1.02.005 2.047.138 3.006.404 2.291-1.552 3.297-1.23 3.297-1.23.653 1.653.242 2.874.118 3.176.77.84 1.235 1.911 1.235 3.221 0 4.609-2.807 5.624-5.479 5.921.43.372.823 1.102.823 2.222v3.293c0 .319.192.694.801.576 4.765-1.589 8.199-6.086 8.199-11.386 0-6.627-5.373-12-12-12z"/></svg></button>     
            </div>      
        </form>
            <?php 
                if (isset($user_info) && !key_exists('error', $user_info)) {
                    require_once 'profile.php';

                    // repos table
                    if (isset($repos) && !key_exists('error', $repos)) {
                        require_once 'repo_table.php';
                    } else if (isset($repos) && key_exists('error', $repos)) {
                        print "<div class='error-alert'>". $repos['error'] . "</div>";
                    }

                    // followers table 
                    if (isset($followers) && !key_exists('error', $followers)) {
                        require_once 'followers_table.php';
                    } else if (isset($followers) && key_exists('error', $followers)) {
                        print "<div class='error-alert'>". $followers['error'] . "</div>";
                    }

                } else if (isset($user_info) && key_exists('error', $user_info)) {
                    print "<div class='error-alert'>". $user_info['error'] . "</div>";
                }
            ?>
    </div>
    <footer>
        Bitoid Week #1 Challenge #2 12.05.2022
    </footer>

    <script type="text/javascript">
        window.addEventListener('DOMContentLoaded', () => {
            const btns = document.querySelectorAll('.show-btn');
            const tables = document.querySelectorAll('.tbl-wrapper');
        
            btns.forEach(btn => {
                btn.addEventListener('click', (e) => {
                    tables.forEach(tbl => {
                        tbl.classList.add("hidden");
                    });
                    document.querySelector(`.tbl-wrapper.${e.target.id}` ).classList.remove("hidden");
                });
            });
        });    
    </script>

</body>
</html>