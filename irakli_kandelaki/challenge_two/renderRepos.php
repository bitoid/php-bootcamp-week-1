<!-- Render repositories -->
<section class="main-section repo-section section-results">
  <h2><?= $username ?>'s repositories</h2>
  <ol class="list list-repos">
    <?php foreach ($repos as $i => $repo): ?>
      <li class='list-item'>
        <span class='repo-num'><?=++$i?>)</span>
        <a href=". $repo->html_url ." target='_blank' class='repo-name-link'>
          <span class='repo-title'><?= $repo->name ?></span>
        </a>
        <a href=". $repo->html_url ." target='_blank' class='repo-link'>Go to repo</a>
      </li>
    <?php endforeach ?>
  </ol>
</section>
