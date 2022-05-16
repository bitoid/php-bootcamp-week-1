<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <link rel="stylesheet" href="axali.css">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
<form class="box"action="axali.php" method="post" enctype="multipart/form-data">
        <h1>Enter Github Username</h1>
        <input type="text1" name="name1"placeholder="username">
        <input type="submit" name="submit1" value="repos">
        <input type="submit" name="submit2" value="followers">
        <input type="submit" name="submit3" value="both">

</form>
    <?php
        $username = $_POST['name1'];
        $url = "https://api.github.com/users/$username/repos?per_page=100";
        $url2 = "https://api.github.com/users/$username/followers?per_page=100 ";
        $param = [
            'http' => [
                'method' => 'GET',
                'header' => [
                    'User-Agent: PHP'
                ]
            ]
        ];
        $json = file_get_contents($url, false, stream_context_create($param));
        $data = json_decode($json, false);

        $json = file_get_contents($url2, false, stream_context_create($param));
        $data2 = json_decode($json, false);
    ?>
        <?php
        $num = count($data);
        $num2=count($data2);
        if(isset($_GET['page'])){
            $page = $_GET['page'];
        }else{
            $page = 1;
        }

        if(isset($_POST['submit1'])){ 
            if(!empty($_POST['name1'])){
                
                ?>
                <center><div class="divd">
                <table  class= "tablee"border="1">
                <?php for ($dd = 0; $dd < $num; $dd++){ ?>
                    <tr>
                    <th> <p style='color: white;'> <?php echo $dd+1 ?></p> </th>
                    <th><?php echo '<a style="text-decoration: none;" href="'.$data[$dd]->html_url.'">' . "<p style='color: green; '>".$data[$dd]->name."</p>" ?></a></th>
                    <th><?php echo "<p style='color: white;'>".$data[$dd]->id."</p>" ?></th>
    
                    </tr>
                <?php } ?>
                
                </table>
                
                
             <?php
            }
        }
         else if(isset($_POST['submit2'])){
            if(!empty($_POST['name1'])){
                
                ?>
                <center><div class="divd">
                
                <table  class= "tablee"border="1">
            <?php   for ($dd = 0; $dd < $num2; $dd++){ ?>
                        <?php $no = $data2[$dd]->avatar_url;
                         $noo = $data2[$dd]->html_url;
                        ?>

                        <tr>
                            <th><?php echo $dd+1; ?></th>
                            <th><?php echo "<p style='color: white;'>".$data2[$dd]->login."</p>"; ?></th>
                            <th><a href="<?php echo $noo  ?>" target="_blank"> <img src=" <?php echo $no ?>" style="max-width: 200px; max-height: 200px;"alt=""></a></th>
    
                        </tr>
            <?php   } ?>
                </table>
                </div></center><?php
            }
        } 
        else if(isset($_POST['submit3'])){
            if(!empty($_POST['name1'])){?>
                <center><div class="divd">
                <table  class= "tablee"border="1">
                <?php for ($dd = 0; $dd < $num; $dd++){ ?>
                    <tr>
                    <th> <p style='color: white;'> <?php echo $dd+1 ?></p> </th>
                    <th><?php echo '<a style="text-decoration: none;" href="'.$data[$dd]->html_url.'">' . "<p style='color: green; '>".$data[$dd]->name."</p>" ?></a></th>
                    <th><?php echo "<p style='color: white;'>".$data[$dd]->id."</p>" ?></th>
    
                    </tr>
                <?php } ?>
                
                </table>

                <center><div class="divd">
                
                <table  class= "tablee"border="1">
            <?php   for ($dd = 0; $dd < $num2; $dd++){ ?>
                        <?php $no = $data2[$dd]->avatar_url;
                         $noo = $data2[$dd]->html_url;
                        ?>

                        <tr>
                            <th><?php echo $dd+1; ?></th>
                            <th><?php echo "<p style='color: white;'>".$data2[$dd]->login."</p>"; ?></th>
                            <th><a href="<?php echo $noo  ?>" target="_blank"> <img src=" <?php echo $no ?>" style="max-width: 200px; max-height: 200px;"alt=""></a></th>
    
                        </tr>
            <?php   } ?>
                </table>
                </div></center><?php


            }
        }
        ?>
</body>
</html>

