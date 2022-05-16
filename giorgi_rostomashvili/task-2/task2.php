<?php 

    $opts = [
        'http' => [
            'method' => 'GET',
            'header' => [
                'User-Agent: PHP'
            ]
        ]
    ];

    $context = stream_context_create($opts);
    $content = file_get_contents("https://api.github.com/users/giorosto/followers", false, $context);
    $data = json_decode($content);
    ?>

    <!DOCTYPE html>
    <html>
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title></title>
    </head>
    <body>
        <?php  foreach ($data as $d) :?>
            <div>
                <a href="<?php echo $d->html_url?>" target="_blank">
                    <img src="<?php echo $d->avatar_url ?>" height="30px">     
                    <?php echo $d->login ?>
                 </a>
            </div>
        <?php endforeach; ?>
    </body>
    </html>