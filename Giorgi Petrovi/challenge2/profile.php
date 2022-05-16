<div class="profile">
    <div class="profile__item">
        <img src=<?php print $user_info['avatar_url'] ?> class="profile__picture" alt="profil picture">
    </div>
    <div class="profile__item">
        <div class="profile__title">
            <?php print $user_info['login'] ?>
        </div>
        <ul class='profile__list'>
            <li><button id='repos' class="profile__button show-btn">Repositories: <?php print $user_info['public_repos']?></button></li>
            <li><button id='followers' class="profile__button show-btn">Followers: <?php print $user_info['followers'] ?></button></li>
            <li><a href=<?php print $user_info['html_url']?>><button class="profile__button">GitHub</button></a></li>
        </ul>
    </div>
</div>