<div class="tbl-wrapper">
    <?php if(empty($data)): ?>
        <div class="error-alert">User doesn't have any follower</div>
    <?php else: ?>
    <div class="follower-tbl">
    <?php foreach ($data as $follower): ?>
        <div class="follower-tbl__card">
            <a href = <?php print $follower['html_url'] ?>>
            <img class="tbl__image" src=<?= $follower['avatar_url'] ?>>
            </a>
            <h4><?php print $follower['login']?></h4> 
        </div>  
    <?php endforeach  ?>
    </div>

    <!-- Pagination -->
    <div class="page-select-wrapper">
        <a class='page-select__page' href="?show=followers&page=1">First</a>
        <?php
            for ($i=$current_page-1; $i <= $current_page + 2 ; $i++) { 
                if ($i <= 0 || $i > $last_page) {
                    continue;
                }
                if ($i == $current_page) {
                    print "<a class='page-select__page active-page'  disabled>$i</a>";
                } else {
                    print "<a class='page-select__page' href='?show=followers&page=$i'>$i</a>";
                }
            }
        ?>
        <a class='page-select__page' href="?show=followers&page=<?= $last_page ?>">Last</a>
    </div>
    <?php endif ?>
</div>
