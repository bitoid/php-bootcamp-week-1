<?php require "check_data.php" ?>

<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Chivo:
    wght@300;400;700&family=Lobster&family=Poppins:wght@200;400&family=Roboto:wght@400;500;700&display=swap"
    rel="stylesheet"> 
    <link rel="stylesheet" href="./style/style.css" type="text/css">
    <title>Challenge N1</title>
  </head>
  <body>
    <div class="index-container">
      <nav class="navigation">
        <a href="index.php">Challenge 1</a>
        <a href="../challenge_two/challenge-two.php">Challenge 2</a>    
        <label for="name" class="link-to-input">Name</label>
        <label for="last-name" class="link-to-input">Last name</label>
        <label for="image" class="link-to-input">Upload photo</label>
      </nav>
      <section class="main-section">
        <form class="form-upload" action="/index.php" method="post" enctype="multipart/form-data">
        <div class="form form--name">
          <label for="name" class="label">Name</label>
          <input type="text" id="name" name="name" class="input input-text" required>
        </div>
        <div class="form form--email">
          <label for="last-name" class="label">Last name</label>
          <input type="text" id="last-name" name="last-name" class="input input-text" required>
        </div>
        <div class="form form--image">
          <label for="image" class="label label-button">Upload your image</label>
          <input type="file" id="image" name="image" class="hidden">
        </div>
          <button type="submit" name="submit" value="Submit" class="label-button">Submit</button>
        </form>
          <!-- Displays who are you ONLY if post is null -->
        <?php if (empty($_POST)): ?>
          <h1 class="main-title">Who are you?</h1>
        <?php endif ?>
      </section>
      <section class="upload-section">
        <div class="about-user">
          <?php if (!empty($_POST)): ?>
          <!-- Print the errors to the user if there are any -->
            <?php if ($errors): ?>
              <?php foreach($errors as $error): ?>
              <h4 class="not-uploaded-message"><?= $error ?></h4>
              <?php endforeach ?>
              <img src="/images/question-mark.png" class="image">
            <!-- If there are no errors, print the input information -->
            <?php else: ?>
              <div class="about-user upload-successful">
                <p class="hello-message">Hello <?=$name . ' ' . $last_name?></p>
                <img src=<?=$target_file?> class="uploaded-image">
              </div>
            <?php endif ?>
          <?php else: ?>
            <img src="/images/question-mark.png" class="image">
          <?php endif ?>
        </div>
      </section>
    </div>    
  </body>
</html>