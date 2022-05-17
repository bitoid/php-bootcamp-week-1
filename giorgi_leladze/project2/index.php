<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <header>Week-1 <br> Task-2</header>
    <hr>

    <form action="/index.php" method="post">
        <select name="dropdown">
            <option value="followers">followers</option>
            <option value="repos">repositories</option>
        </select>
        <input type="text"name="username" placeholder="User Name">
        <button type="submit">click</button>
    </form>
    
    <table class="main_contant">

        <tr>
            <th>N</th>
            <th>img</th>
            <th>name</th>
            <th>link</th>
        </tr>


        <?php
            function getData($url){ // this function gets data from github
                $param = [
                    'http' => [
                        'method' => 'GET',
                        'header' => [
                            'User-Agent: PHP'
                        ]
                    ]
                ];

                $json = file_get_contents($url, false, stream_context_create($param));
                return json_decode($json, true);
            }

            function renderData($data, $option, $i) { // this function renders data as a table
                foreach($data as $val) { // get single repo or follower from array
                    $num = $i;
                    $link = $val['html_url'];

                    $imgUrl = $val['avatar_url'];
                    $name = $val['login'];

                    if($option == "repos") {
                        $name = $val['name'];
                        $imgUrl = 'imgs/unknown.jpeg';
                    }
                    // render it as a table row 
                    print "
                        <tr>
                            <td><p>$num</p></td>
                            <td><img src='$imgUrl' alt='no img available for repos'></td>  
                            <td><h4>$name</h4></td>     
                            <td><a href='$link'>go to $option</a></td>             
                        </tr>";
                    $i++;
                }
            }

            if(isset($_POST["username"])){
                $numOfPage = 1;  // current page
                $username = $_POST["username"];
                $option = $_POST["dropdown"];
                
                $i = 1; // variable to numberize table rows
                $data = [];
                do { // do-while ---> if count(data) = 100 than we need to send one more request
                    $url = "https://api.github.com/users/$username/$option?page=$numOfPage"."&per_page=100";
                    $data = getData($url);
                    renderData($data, $option, $i);
                    $i += 100;
                    $numOfPage++;
                } while (count($data) === 100);
            }
        ?>
    </table>
    
</body>
</html>