<?php include_once "getdata.php" ?>

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
      <link rel="stylesheet" href="../style/style.css" type="text/css">
      <title>Challenge N2</title>
  </head>
  <body>
    <div class="challenge_two-container">
      <nav class="navigation">
          <a href="../index.php">Challenge 1</a>
          <a href="/challenge_two/challenge-two.php">Challenge 2</a>    
          <label for="username" class="link-to-input">Input GIT</label>
      </nav>
      <section class="main-section-git">
        <!-- Renders a form until we have a data to print it to screen -->
        
        <!-- If the user exists, both were checked, render the user's repos and followers -->
        <?php if (isset($_POST) && $haveData === true): ?>
          <?php if ($_POST['repos'] === 'yes' && $_POST['followers'] === 'yes'): ?>
            <div class="git-container">
              <?php 
              include 'renderRepos.php';
              include 'renderFollowers.php'; 
              ?>
            </div>

            <!-- If only repos were checked, render repos -->
          <?php elseif ($_POST['repos'] === 'yes'): ?>
            <?php include 'renderRepos.php' ?>

          <!-- if only followers were checked, render followers -->
          <?php elseif ($_POST['followers'] === 'yes'): ?>
            <div class='only-followers'>
              <?php include 'renderFollowers.php' ?>
            </div>

            <!-- If none were checked, render form and show the error message -->
          <?php else: ?>
            <?php include 'renderForm.php' ?>
            <?php $errors[] = "You must check at least one of the boxes"?>
            <p class='error-message'>You must check at least one of the boxes</p>
          <?php endif ?>
          <!-- Render form at the beginning, when the user has not yet submitted the data -->
        <?php elseif (isset($_POST) && $haveData === false): ?>
            <?php include 'renderForm.php' ?>
            <?php foreach ($errors as $error): ?>
              <p class="error-message"><?= $error ?></p>
            <?php endforeach ?>
        <?php endif ?>
      </section>
    </div>
  </body>  
</html>