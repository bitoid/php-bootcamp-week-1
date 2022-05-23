<?php
 require_once 'connection.php';

 $statement = $pdo->prepare('SELECT * FROM users');
 $statement->execute();
 $products = $statement->fetchAll(PDO::FETCH_ASSOC);
 $errors = [];
?>
<?php   require_once 'header.php';  ?>
<?php   require_once 'validation.js';  ?>

<style>
            .header, h1, .container {
                display: absolute;
                transform: translate(500px, 10px);
            }
            .new {
                transform: translate(900px, -400px);
            }
        </style>

<body>
      <form action="index.php" method="post" enctype="multipart/form-data" name="myform" onsubmit="return validation()">

          <div class="container">
                <label for="image"><em>Profile Picture</em></label><br>
                <input type="file" placeholder="upload image" id="image" name="image">
                <br><br><br>

                <label class="nameClass" ><b>First Name</b></label><br>
                <input type="text" placeholder="Enter your name" id="username" name="username" autocomplate="off"><br>
                <em>(only alphabet characters (A to Z))</em><br><br><br>
                
                <label class="nameClass"><b>Last Name</b></label><br>
                <input type="text" placeholder="Enter your last name" id="name" name="name" autocomplate="off"><br><em>(only alphabet characters (A to Z))</em><br><br><br>
                
                <div id="error"></div>

                <button type="submit" name="upload" value="submit" ><strong>Submit</strong></button>
            </div>

        </form>

        <?php   require_once 'upload.php';  ?>
