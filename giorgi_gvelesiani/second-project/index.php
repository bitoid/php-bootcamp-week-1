<?php
    if (!isset($_SESSION)) {
        session_start();
         
    }

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <!-- CSS only -->
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0-beta1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-0evHe/X+R7YkIZDRvuzKMRqM+OrBnVFBL6DOitfPri4tjfHxaWutUpFmBp4vmVor" crossorigin="anonymous">
    <style>
     .error {color: #FF0000;} 
    </style>
</head>
<body>
    
<?php
 $data = $status_code = $api = $api_type = ""; 
 $unameErr = ""; 

     

   if ($_SERVER['REQUEST_METHOD'] == 'POST') {
        $_SESSION['postdata'] = $_POST;    

      $uname = $_POST['uname']; 
      $_SESSION['api_type'] = $_POST['api-github-type'];
     
      $url = "https://api.github.com/users/".$uname."/".$_SESSION['api_type']."?per_page=100";
 
     
      $ch = curl_init(); 
        curl_setopt_array($ch, [
            CURLOPT_URL => $url , 
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_HTTPHEADER => array('Accept: application/json', 'Content-Type: application/json', 'User-Agent: Gvele')
        ]); 

        $data =  curl_exec($ch); 
        $_SESSION['status_code'] = curl_getinfo($ch, CURLINFO_HTTP_CODE);
        curl_close($ch); 
        $_SESSION['api'] =  json_decode($data);
          
         
          unset($_POST);
          header("Location: ".$_SERVER['PHP_SELF']);
          exit;

    }
?>


<form action="index.php" method="POST"  id="githubForm">
        <label for="uname">User name:</label><br>
        <input type="text" id="uname" name="uname">
        <input type="submit" value="Submit"> 
    </form>
    <br>
    
    <label for="api-github">Choose a api for github:</label>
    <select id="api-github" name="api-github-type" form="githubForm">
    <option value="repos">Repos</option>
    <option value="followers">Followers</option>
    </select>


    <div class="container">
    <div class="row-fluid "> 
    <?php  if ( array_key_exists('postdata', $_SESSION) && $_SESSION['status_code'] == 200 &&   $_SESSION['api_type'] =="repos" ) { ?>

        <?php  foreach ($_SESSION['api'] as $key => $value) : ?>
        <div class="col-md-4 ">
            <div class="card-columns-fluid">
                <div class="card  bg-light" style = "width: 22rem; " >
                    <div class="card-body">
                        <h5 class="card-title"><b><?php  print($_SESSION['api'][$key]->name) ?></b></h5>
                        <p class="card-text"><b><?php   print($_SESSION['api'][$key]->html_url)?></b></p>
                        <a href=<?php   print($_SESSION['api'][$key]->html_url)?>  class="btn btn-secondary">Full Details</a>
                    </div>
                </div>
            </div>
        </div>
    <?php endforeach; ?>
   
    <?php
    } else if(array_key_exists('postdata', $_SESSION) && $_SESSION['status_code'] == 200 &&   $_SESSION['api_type']  =="followers") { ?>
        
        <?php  foreach ($_SESSION['api'] as   $value) : ?>
             
            <div class="col-md-4 ">
            <div class="card-columns-fluid">
                <div class="card  bg-light" style = "width: 10rem; " >
                     <img class="card-img-top"  src=<?php print ($value->avatar_url) ?>  width="50" height="150"  alt="Card image cap">  
                      <div class="card-body">
                        <h5 class="card-title"><b><?php  print($value->login) ?></b></h5>
                        <a href=<?php   print($value->html_url)?>  class="btn btn-secondary">Full Details</a>
                     </div>
                </div>
            </div>
        </div>
            
    <?php endforeach; ?>
    </div>
    <?php }
    else if( array_key_exists('postdata', $_SESSION) && $_SESSION['status_code'] == 404) {
        print("User not found!");  
    }
    else {
        print(array_key_exists('postdata', $_SESSION) && $_SESSION['status_code'])  ; 
    }

    unset($_SESSION['postdata'], $_SESSION['api'],  $_SESSION['status_code'] ,$_SESSION['api_type'] );
?>

  

 

</body>
</html>