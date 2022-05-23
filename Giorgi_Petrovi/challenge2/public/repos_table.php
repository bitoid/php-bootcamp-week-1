<div class="tbl-wrapper">
    <?php if(empty($data)): ?>
        <div class="error-alert">User doesn't have any repository</div>
    <?php else: ?>
    <table class="tbl">
        <tr>
            <th>Repository</th>
            <th>Language</th>
            <th>Home Page</th>
        </tr>
        <?php foreach ($data as $repo): ?>
            <tr>
                <td><a href="<?php print $repo['html_url']?>"><?php print $repo['name']?></a></td>
                <td><?php print $repo['language']?></td>
                <td><a href="<?php print $repo['homepage']?>"><?php print $repo['homepage']?></a></td>
            </tr>
        <?php endforeach ?>
    </table>
    
    <!-- Pagination -->
    <div class="page-select-wrapper">
        <a class='page-select__page' href="?show=repos&page=1">First</a>
        <?php
            for ($i=$current_page-1; $i <= $current_page + 2 ; $i++) { 
                if ($i <= 0 || $i > $last_page) {
                    continue;
                }
                if ($i == $current_page) {
                    print "<a class='page-select__page active-page' disabled>$i</a>";
                } else {
                    print "<a class='page-select__page' href='?show=repos&page=$i'>$i</a>";
                }
            }
        ?>
        <a class='page-select__page' href="?show=repos&page=<?= $last_page ?>">Last</a>
    </div>
    <?php endif ?>
</div>




