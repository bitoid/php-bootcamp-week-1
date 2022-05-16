<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0-beta1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-0evHe/X+R7YkIZDRvuzKMRqM+OrBnVFBL6DOitfPri4tjfHxaWutUpFmBp4vmVor" crossorigin="anonymous">
    <link rel="stylesheet" href="github.css">
    <title>Challenge #2</title>
    <style>
        ul{
            display: flex;
            flex-wrap: wrap;
            justify-content: space-between;
            padding: 0; 
        }
        .repo-item{
            width: 200px;
            height: 100px;
        }
        .min-height{
            min-height: 100vh;
        }
    </style>
</head>
<body>
    <section class="container-fluid bg-dark bg-gradient text-center p-5 min-height d-flex">
        <section class="container bg-light bg-gradient p-5 align-self-center">
            <?php
                // $name='';
                // $selectedOption=null;
            ?>

            <h1>Challenge #2</h1>

            <div class="form">
                <form action="" method="post">
                    <div class="mt-3">
                       <input class="form-control" type="text" name="name" placeholder="name" required> 
                    </div>
                    <div class="mt-3">
                        <select class="form-select" name="select" required>
                            <option selected disabled value="">select an options</option>
                            <option value="1">repositories</option>
                            <option value="2">followers</option>
                            <option value="3">repositories and followers</option>
                        </select>
                    </div>
                    <div class="mt-3 mb-3">
                        <button class="btn btn-primary" type="submit" value="submit" name="submit">Submit form</button>
                    </div>
                    
                </form>
            </div>

            <?php
                // name / select
                $name = $_POST['name'];
                $selectedOption = filter_input(INPUT_POST, 'select', FILTER_SANITIZE_STRING);
                // echo gettype($selectedOption);

                // call function after submit 

                if(isset($_POST['submit'])){
                    getData($name, $selectedOption);
                }

                // functions

                function getRepos($userName)
                {
                        
                            $j=1;
                            while(true){
                                $url = "https://api.github.com/users/$userName/repos?page=$j&per_page=100";
                            $param = [
                                'http' => [
                                    'method' => 'GET',
                                    'header' => [
                                        'User-Agent: PHP'
                                    ]
                                ]
                            ];
                                $json = @file_get_contents($url, false, stream_context_create($param));
                            $statusCode = $http_response_header[0];
                            $data = json_decode($json, false);
                            if($statusCode=='HTTP/1.1 200 OK'){
                                
                                ?>

                                <ul class="">
                                <?php
                                for ($i=0; $i < count($data); $i++) { 
                                ?>
                            
                                    <li class="repo-item">
                                        <a href="<?php echo $data[$i]->html_url?>" class="btn btn-dark btn-lg">
                                            <span>
                                                <?php echo $data[$i]->name?>
                                            </span>
                                        </a>
                                    </li>
                                
                                <?php
                                }
                                
                                ?>
                                
                                </ul>

                                    <?php
                            }else{
                                echo "There is no such user";
                            }
                            $j++;
                                if (empty($data)){   
                                    break;
                                  } 
                            }
                            
                            ?>
                            
                        
                    <?php
                }

                function getFollowers($userName)
                {
                    $j=1;
                    while(true){
                        $url = "https://api.github.com/users/$userName/followers?page=$j&per_page=100";
                        $param = [
                            'http' => [
                                'method' => 'GET',
                                'header' => [
                                    'User-Agent: PHP'
                                ]
                            ]
                        ];

                        $json = @file_get_contents($url, false, stream_context_create($param));
                        $statusCode = $http_response_header[0];
                        $data = json_decode($json, false);
                        if($statusCode=='HTTP/1.1 200 OK'){
                            ?>
                                <ul class="">
                        <?php
                    for ($i=0; $i < count($data); $i++) { 
                        ?>
                    
                            <li class="followers-item">
                                <a href="<?php echo $data[$i]->html_url?>">
                                    <div>
                                        <img class="image" src="<?php echo $data[$i]->avatar_url?>" alt="">
                                    </div>
                                    <div>
                                        <p><?php echo $data[$i]->login?></p>
                                       
                                    </div>
                                </a>
                            </li>
                    
                        <?php
                    }
                    ?>
                    
                    </ul>
                            <?php
                        }else{
                            echo "There is no such user";
                        }
                        $j++;
                        if (empty($data)){   
                            break;
                          } 
                    }
                    
                        ?>
                        
                    
                    <?php
                }

                function getData($userName, $requestType)
                {
                    if($requestType==='1'){
                        getRepos($userName);
                    }elseif($requestType==='2'){
                        getFollowers($userName);
                    }else{
                        getRepos($userName);
                        getFollowers($userName);
                    }
                }

            ?> 
        </section>
    </section>
  
</body>
</html>

