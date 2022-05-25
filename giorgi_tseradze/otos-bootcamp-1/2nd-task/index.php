<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="index.css">  
    <title>2nd task: GitHub</title>
</head>
<body>
        <!-- input form -->
        <section class="form">
                <form action="" method="POST">
                <input type="text" id="input_name" name="input_username" placeholder="Enter username"> 

                <select id="dropdown"  name="operation" required>
                        <option disabled selected value>Select an option</option>
                        <option value="repository">repository</option>
                        <option value="followers">followers</option>
                </select>

                <button type="submit" name="submit" value="submit">Submit</button>
                </form>
        </section>

        <section class="php">
        <?php
                //http options
            $opts = [
                'http' => [
                    'method' => 'GET',
                    'header' => [
                        'User-Agent: Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/101.0.4951.54 Safari/537.36 Edg/101.0.1210.39',
                    ]
                ]
            ];

            //trimming white space
            if(isset($_POST['input_username'])){
                $_POST['input_username'] = trim($_POST['input_username']); 
            }

            //cheking if all form is submitted
            if (isset($_POST['submit'])&& isset($_POST['input_username']) && strlen($_POST['input_username'])>0) {     


                $github_user_url="https://api.github.com/search/users?q=". $_POST['input_username'];

                $user_decoded = file_get_contents( $github_user_url, false, stream_context_create($opts));
                $user_validation = json_decode($user_decoded, true);

                //username validation
                if($user_validation["total_count"] === 0) {

                    die("error: invalid github username '".$_POST['input_username']."'");

                } elseif(isset($_POST['operation'])) {

                    //checking dropdown value
                    if($_POST['operation']==='repository'||$_POST['operation']==='followers') {
                        $username = $_POST['input_username'];
                        $operation = $_POST['operation'];

                        //getting information from users api
                        $user_url = "https://api.github.com/users/". $username;

                        $content = file_get_contents($user_url, false, stream_context_create($opts));

                        $user_info = json_decode($content, true);
                        
                        //showing name, picture and operation info
                        ?><img id = 'img' src=<?= $user_info["avatar_url"]?>> 
                        <p id = 'profile'><?php print"$username's $operation" ?></p><br><?php

                        //getting the number of followers and repos
                        if($operation === 'repository'){                           
                           $data_count = $user_info["public_repos"];
                        }else{                               
                            $data_count = $user_info["followers"];
                        }?>

                        <!-- using while loop to get all information ---> 
                        <table>
                        <?php
                        $i = 0;
                        $c = 1;
                        $pagenumber = 0;
                        while($i <= $data_count){
                            $i += 29;
                            $pagenumber++; 

                            //declearing links using array based on dropdown operation info and number of pages
                            $url_list = [
                                'repository'=>"https://api.github.com/users/". $username."/repos?page=".$pagenumber,
                                'followers'=>"https://api.github.com/users/". $username."/followers?page=".$pagenumber
                            ];

                            $data_list = json_decode(file_get_contents($url_list[$operation], false, stream_context_create($opts)), true);                    

                            //showing user repos and followers
                            foreach($data_list as $data){
                                ?><tr>                                
                                <td><?php $c ?></td>
                                <?php $c++; 
                                if($operation === 'repository'){ 
                                    ?>                                                                          
                                    <td> <a href=<?= $data["html_url"] ?> target='#_blank'><?= $data["name"] ?></a></td>
                                    <td> <?=$data["description"] ?></td><?php
                                }else{                               
                                    ?>
                                    <td> <a href=<?= $data["html_url"] ?> target='#_blank'> <?= $data["login"] ?></a></td>
                                    <td> <img id='img' src=<?=$data["avatar_url"] ?>> </td><?php                                 

                                }                                                              
                                ?></tr><?php                             
                            }                                                                                                                      
                        }
                        ?></table><?php                  
                    }                                         
                } else {                  
                    die('error: missing information');
                }           
            }

        ?>
        </section>
</body>
</html> 
