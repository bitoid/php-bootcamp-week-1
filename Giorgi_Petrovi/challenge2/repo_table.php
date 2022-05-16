<div class="tbl-wrapper repos">
    <?php if(empty($repos)): ?>
        <div class="error-alert">User doesn't have any repository</div>
    <?php else: ?>
    <table class="tbl">
        <tr>
            <th>Repository</th>
            <th>Language</th>
            <th>Home Page</th>
        </tr>
        <?php foreach($repos as $repo): ?>
            <tr>
                <td><a href="<?php print $repo['html_url']?>"><?php print $repo['name']?></a></td>
                <td><?php print $repo['language']?></td>
                <td><?php print $repo['homepage']?></td>
            </tr>
        <?php endforeach ?>
    </table>
    <?php endif ?>
</div>