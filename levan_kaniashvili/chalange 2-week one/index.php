

    <?php include 'repocode.php'; ?>
    <?php include 'followercode.php'; ?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <!-- CSS only -->
    <link rel="stylesheet" href="styles.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
    <title>Document</title>
</head>
<body>
    <div class="deadline">
        <h1>GitHub Info</h1>
    </div>

    <form action="index.php" method="POST" class="form" enctype="multipart/form-data">
        <!-- github-ის იუზერნეიმის შესავსები ველი   Github username field -->
        <div class="input-group mb-3 w-25" >
            <input type="text" name="name" class="form-control"  id="name" aria-label="Sizing example input" aria-describedby="inputGroup-sizing-default" placeholder="Enter GitHub UserName" value="">
        </div>

        <!-- dropdown menu  ჩამოსაშლელი მენიუ  -->

        <select class="form-select w-25 mx-auto"  name = "selectedValue" aria-label="Default select example">
            <option selected>Select One Of This Option</option>
            <option value="1">Repositories</option>
            <option value="2">Github Followers</option>
            <option value="3">Followers Avatars</option>
            <option value="4">ALL</option>
        </select>
                
        <!-- საბმითის ღილაკი  Submit button -->
        <div class="btn-group" role="group" aria-label="Basic outlined example">
            <button type="submit" class="btn btn-outline-primary">Submit</button>
        </div>
    </form>

    



    <div class="float-container">
 <!-- რეპოზიტორიები   -->
        <div class="float-child">
            <div class="green">
                <h2><?php  echo $username ?> Github Repositories</h2>
                <?php 
                if(empty($_POST['name'])){
                    echo 'fill form';
                }elseif(($_POST['selectedValue'] !== "1") && ($_POST['selectedValue'] !== "4")){
                    echo "You did not choose to see user repositories";
                }else{
                    foreach ($data as  $response ) : ?>
                        <li><a href= <?php echo $response ['html_url'];?>><?php echo $response ['name']; ?></a> </li><br>
                   <?php
               
                   endforeach;
                }
                 ?>
            </div>
        </div>
    <!-- ფოლოვერების ციკლი   -->
        <div class="float-child">
            <div class="blue">
            <h2><?php  echo $username ?> Github Followers</h2>
                <?php 
                if(empty($_POST['name'])){
                    echo 'fill form';
                }elseif($_POST['selectedValue'] !== "2" && $_POST['selectedValue'] !=="4"){
                    echo "You did not choose to see user followers";
                }else{
                foreach ($value as  $result) : ?>
                    <li><a href=<?php echo $result ['html_url'];?>><?php echo $result ['login']; ?></a></li><br>
                <?php endforeach;
                }
                ?>
            </div>
        </div>


        <!-- ფოტოზე დაკლიკებით შეგიძლია გადახვიდე ფოლოვერების რეპოზიტორიაზე   -->
        <div class="float-child">
            <div class="blue">
            <h2><?php  echo $username ?> Followers Avatars</h2>
                <?php 
                if(empty($_POST['name'])){
                    echo 'fill form';
                }elseif($_POST['selectedValue'] !== "3" && $_POST['selectedValue'] !=="4"){
                    echo "You did not choose to see user avatars";
                }else{
                foreach ($value as  $result) : ?>
                    <li><a href=<?php echo $result ['html_url'];?>><img class="repoimg" src=<?php echo $result ['avatar_url']; ?> alt=""></a></li><br>
                <?php endforeach; 
                }
                ?>
            </div>
        </div>
    </div>




       
</body>
</html>