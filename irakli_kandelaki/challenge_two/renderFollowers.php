<!-- Render followers -->
<section class="upload-section follower-section section-results">
  <h2><?= $username ?>'s followers</h2>
  <ul>
    <?php foreach ($followers as $i => $follower): ?>
      <li class='list-item-followers'>
        <span class='follower-num'><?= ++$i ?>)</span>
        <div class='img-name-wrapper'>
          <a href="<?= $follower->html_url ?>" target='_blank' class='follower-link-image'>
            <img src="<?= $follower->avatar_url ?>" class='follower-image'>
          </a>
          <span class='follower-title'><?= $follower->login ?></span>
        </div>
        <a href="<?= $follower->html_url ?>" target='_blank' class='follower-link'>See profile</a>
      </li>
    <?php endforeach ?>
  </ul>
</section>