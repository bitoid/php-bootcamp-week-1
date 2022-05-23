<?php  require "function.php"?>


<?php session_start()  ?>  


<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <link rel="stylesheet" href="index.css">  
        <title>Document</title>
    </head>
    <body>
        <section id="form_section">
            <form action="" method="POST">
                <input type="text" id="input_name" name="input_username" placeholder="Enter username"> 
                    <?php   if(isset($_POST['input_username'])){
                                $_POST['input_username']=trim($_POST['input_username']);  }?>
                                                   
                <select id="dropdown"  name="operation" required>
                   

                    <option value="repository">repository</option>
                    <option value="followers">followers</option>
                </select>

                <button type="submit" name="submit" value="submit">Submit</button>
            </form>
        </section>

        <section id="php_section">                       
            <?php if ( isset($_POST['input_username']) && strlen($_POST['input_username'])>0) : 
                    require_once "usagevariables.php"; ?> 

                        <a  href="<?php echo $user_info["html_url"] ?>" target='#_blank'><img id='img' src=" <?php echo $user_info["avatar_url"] ?> "></a>
                        <p id='profile'> <?php echo $username ?>'s <?php echo $operation?> </p><br>
                                                        
                    <table>          
                                                   
                        <?php while($i<=$data_count) :  
                                $i+=29;
                                $pagenumber++;                        
                                $url=[
                                    'repository'=>"https://api.github.com/users/". $username."/repos?page=".$pagenumber,
                                    'followers'=>"https://api.github.com/users/". $username."/followers?page=".$pagenumber
                                ];                      
                                $data_list= dataFromUrl($url[$operation]);                    
                                                                    
                                foreach($data_list as $data) :?>
                                    <tr>                                 
                                        <td><?php echo $c  ?></td>
                                        <?php $c++ ?>
                                        <?php if($operation==='repository'):?>                                                                                    
                                            <td> <a href='<?php echo $data["html_url"] ?> ' target='#_blank'><?php echo $data["name"] ?> </a></td>
                                            <td> <?php echo $data["description"] ?>  </td>
                                        <?php  else: ?>                              
                                            <td> <a href='<?php echo $data["html_url"]?> ' target='#_blank'><?php echo $data["login"]?> </a></td>
                                            <td> <img id='img' src=<?php echo $data["avatar_url"]?> > </td>                                 

                                        <?php endif ?>                                                              
                                    </tr>                              
                                <?php endforeach ?>                                                                                                                  
                            <?php endwhile ?>
                        </table>    
                <?php endif ?>                                                                                         
         </section>
    </body>
</html>