<!doctype html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Bootstrap demo</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0-beta1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-0evHe/X+R7YkIZDRvuzKMRqM+OrBnVFBL6DOitfPri4tjfHxaWutUpFmBp4vmVor" crossorigin="anonymous">
  </head>
  <body>
    <form action="index.php" method="post" enctype="multipart/form-data">
     <input type="text" name="username" placeholder="Github პროფილი" required />
     <div class="icon"><i class='bx bxs-message-square-check'></i></div>
        <div class="input">
          <select name="selected">
            <option value="repo">Repository</option>
            <option value="follow">folowers</option>
          </select>
          <br>
    <input type="submit" name="gagzavna" value="გაგზავნა">
</form> 
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0-beta1/dist/js/bootstrap.bundle.min.js" integrity="sha384-pprn3073KE6tl6bjs2QrFaJGz5/SUsLqktiwsUTF55Jfv3qYSDhgCecCxMW52nD2" crossorigin="anonymous"></script>
  </body>
</html>
<?php


$headers = [
    "User-Agent: Example REST API Client",
    "Authorization: token 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"
];

$ch = curl_init();

curl_setopt_array($ch, [
    CURLOPT_HTTPHEADER => $headers,
    CURLOPT_RETURNTRANSFER => true
]);
if(isset($_POST['gagzavna']))
{
    $full_name = $_POST['username'];
    if($_POST['selected'] === "repo")
    {
        curl_setopt($ch, CURLOPT_URL, "https://api.github.com/users/$full_name/repos");


        $response = curl_exec($ch);
        
        curl_close($ch);
        $i = 1;
        $data = json_decode($response, true);
        ?>
                                   
                <table class="table">
                    <thead>
                        <tr>
                            <th scope="col">#</th>
                            <th scope="col">Name</th>
                            <th scope="col">Description</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach ($data as $repository): ?>
                        <tr>
                        
                        <td> <?php echo $i++; ?> </td>
                            <td> 
                                <a href="http://github.com/<?= $repository["full_name"] ?>" target="_blank">
                
                                    <?= $repository["name"] ?> 
                                </a>
                                </td>
                            
                            <td> <?= $repository["description"] ?> </td>
                            <?php endforeach; ?>
        
                        </tr>
                        <tr>
                </tbody>
        </table>
        <?php
    } 
    else if($_POST['selected'] === "follow")
    {
        curl_setopt($ch, CURLOPT_URL, "https://api.github.com/users/$full_name/followers");


        $response = curl_exec($ch);
        
        curl_close($ch);
        $i = 1;
        $data = json_decode($response, true);
        ?>
                                   
                <table class="table">
                    <thead>
                        <tr>
                            <th scope="col">#</th>
                            <th scope="col">Photo</th>
                            <th scope="col">Name</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach ($data as $users): ?>
                        <tr>
                        
                        <td> <?php echo $i++; ?> </td>
                            <td> 
                                <img src="<?= $users["avatar_url"] ?>" alt="foto" width="40px" height="40px">
                                    
                                </td>
                            
                            <td> 
                            <a href="http://github.com/<?= $users["login"] ?>" target="_blank">
                
     
    
                                <?= $users["login"] ?> 
                            </td>
                            <?php endforeach; ?>
        
                        </tr>
                        <tr>
                </tbody>
        </table>
        <?php
    } ?>
    <?php
} ?>

    







