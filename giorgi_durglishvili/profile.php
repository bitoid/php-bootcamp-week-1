<?php include 'header.php' ?>
    <?php
        session_start();
        if(isset($_SESSION['fname'])){
            $fname = $_SESSION['fname'];
            $lname = $_SESSION['lname'];
            $image = $_SESSION['file_name'];  
        }else{
            header('location: index.php');
            exit();
        }
      
     ?>
     <a href="includes/logout.inc.php">
        <div class="button">
            Log Out
        </div>
     </a>
    
    <div class="profile-component">
        <img src="uploads/<?php echo $image; ?>" alt="image">
        <div class="full-name">
            <?php echo "$fname $lname" ?>
        </div>
    </div>

<?php include 'footer.php' ?>
