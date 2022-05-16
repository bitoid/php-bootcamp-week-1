<div class="tbl-wrapper  followers hidden">
    <?php if(empty($followers)): ?>
        <div class="error-alert">User doesn't have any follower</div>
    <?php else: ?>
    <table class="tbl">
        <tr>
            <th>Followers</th>
            <th></th>
        </tr>
        <?php foreach($followers as $follower): ?>
            <tr>
                <td>
                    <a href = <?php print $follower['html_url'] ?>>
                        <img class="tbl__image"src=<?php print $follower['avatar_url'] ?>>
                    </a>
                </td>
                <td><?php print $follower['login']?></td>
            </tr>
        <?php endforeach ?>
    </table>
    <?php endif ?>
</div>
