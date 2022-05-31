<!DOCTYPE html>
<html lang="en">
<head>
    <link rel="stylesheet" href="./meoredavaleba.css">
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    
</head>
<body>
    <?php
    $name="";
    $manipulati=0;
    $headers=[
        'User-Agent: Generate new token',
        'Authorization: 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'
    ];
    if(isset($_POST['submit'])){
      if(!empty($_POST['name'])){
        $name=$_POST["name"];
        $manipulati=1;
      }
      else{
        echo "<h2 class='er'>* Enter a search name *</h2>";
      }
    }
    

  if($manipulati==1){
    $ch =curl_init("https://api.github.com/users/$name");
    curl_setopt($ch,CURLOPT_HTTPHEADER,$headers);
    curl_setopt($ch,CURLOPT_RETURNTRANSFER,true);
    $responce=curl_exec($ch);
    curl_close($ch);
    $data=json_decode($responce,true);
    $imge= $data["avatar_url"];
    $saxeli=$data['name'];
    $followers=$data['followers'];
    $user=$data['login'];

    
      $ch =curl_init("https://api.github.com/users/$name/followers");
      curl_setopt($ch,CURLOPT_HTTPHEADER,$headers);
     curl_setopt($ch,CURLOPT_RETURNTRANSFER,true);
     $responce=curl_exec($ch);
     curl_close($ch);
     $data=json_decode($responce,true);
     
  
  }
  
    ?>

   

<form class="forms" action="./davaleba2.php" method="post" enctype="multipart/form-data">
<input  class="Name_Control" type="text" name="name" placeholder="შეიყვანეთ საძიებო  სახელი"><br>
<input class="submit" type="submit" name="submit" value="ძებნა">
</form>
<?php if($manipulati==1):?>
   <div class="person">
   <img class="img" src="<?php echo $imge ?>" alt="">
   <h4><?php echo "user :".$saxeli ?></h4>
   <h4><?php echo "folowers :" .$followers ?></h4>
   </div>
    <?php  foreach($data as $repositori):?>
      
        <?php
          $suraTi= $repositori['avatar_url'];
          $id=  $repositori['id'];
          $login=  $repositori['login'];
          $cl=1;
          ?>
          <div class="person_folowers">
          <img class="img" src="<?php echo $suraTi ?>" alt="">
          <h1><?php echo "nick-name :". $login ?></h1>
          <h6><?php echo "ID :". $id  ?></h6>
          </div> <br>
      
      <?php endforeach ?>
    <?php endif ?>
</body>
</html>