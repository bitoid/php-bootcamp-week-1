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

            <select id="dropdown"  name="operation" required>
                <option disabled selected value>Select an option</option>
                <option value="repository">repository</option>
                <option value="followers">followers</option>
            </select>

            <button type="submit" name="submit" value="submit">Submit</button>
        </form>
    </section>

    <section id="php_section">
        <?php

            $param = [
                'http' => [
                    'method' => 'GET',
                    'header' => [
                        'User-Agent: Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/101.0.4951.54 Safari/537.36 Edg/101.0.1210.39',
                    ]
                ]
            ];

            //removing all space cheracters from username
            if(isset($_POST['input_username'])){
                $_POST['input_username']=trim($_POST['input_username']); 
            }
            
            //cheking if all form is submited
            if (isset($_POST['submit'])&& isset($_POST['input_username']) && strlen($_POST['input_username'])>0) {     
                
                    
                $github_user_url="https://api.github.com/search/users?q=". $_POST['input_username'];
                
                $user_decoded=file_get_contents( $github_user_url, false, stream_context_create($param));
                $user_validation=json_decode($user_decoded, true);

                //cheking if username is valid, if not showing error 
                if($user_validation["total_count"]===0) {

                    die("error: invalid github username '".$_POST['input_username']."'");
                    
                } elseif(isset($_POST['operation'])) {

                    //cheking what value is in dropdown section
                    if($_POST['operation']==='repository'||$_POST['operation']==='followers') {
                        $username=$_POST['input_username'];
                        $operation=$_POST['operation'];

                        //getting information from users api
                        $user_url="https://api.github.com/users/". $username;

                        $content=file_get_contents($user_url, false, stream_context_create($param));
                        
                        $user_info= json_decode($content, true);

                        //showing name, picture and operation ifo
                        echo "<img id='img' src='".$user_info["avatar_url"]."'>";
                        echo "<p id='profile'>".$username."'s ".$operation." </p>"."<br>";

                        //getting numbers of followers and repos
                        if($operation==='repository'){                           
                           $data_count=$user_info["public_repos"];
                        }else{                               
                            $data_count=$user_info["followers"];
                        }


                        //using while loop to get all information
                        echo "<table>";
                        $i=0;
                        $c=1;
                        $pagenumber=0;
                        while($i<=$data_count){
                            $i+=29;
                            $pagenumber++; 

                            //declearing links using arrey based of dropdown operation info and number of pages
                            $url_list=[
                                'repository'=>"https://api.github.com/users/". $username."/repos?page=".$pagenumber,
                                'followers'=>"https://api.github.com/users/". $username."/followers?page=".$pagenumber
                            ];
                        
                            $data_list= json_decode(file_get_contents($url_list[$operation], false, stream_context_create($param)), true);                    
                                        
                            //showing user repos and followers
                            foreach($data_list as $data){
                                echo "<tr>";                                 
                                echo "<td>$c</td>";
                                $c++; 
                                if($operation==='repository'){                                                                                      
                                    echo "<td> <a href='".$data["html_url"]."' target='#_blank'>". $data["name"]."</a></td>";
                                    echo "<td> ".$data["description"]." </td>";
                                }else{                               
                                    echo "<td> <a href='".$data["html_url"]."' target='#_blank'>". $data["login"]."</a></td>";
                                    echo "<td> <img id='img' src=".$data["avatar_url"]."> </td>";                                  

                                }                                                              
                                echo "</tr>";                               
                            }                                                                                                                      
                        }
                        echo "</table>";                   
                    }                                         
                }else{                  
                    die('error: missing information');
                }           
            }
                              
        ?>
    </section>
</body>
</html>