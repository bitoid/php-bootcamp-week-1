<form action="./index.php" method="POST" enctype="multipart/form-data">
    
    <div class="form-group">
        <input type="text" name="FirstName" placeholder="Enter First Name..." value = "<?php echo $firstName ?>" class="form-control" id="formGroupExampleInput" required>
    </div>
    <div class="form-group">
        <input type="text" name="LastName" placeholder="Enter Last Name..." value = "<?php echo $lastName ?>" class="form-control" id="formGroupExampleInput2" required>
    </div>
   
    <div class="form-group">
        <input type="file" name="image" class="form-control-file" id="exampleFormControlFile1">
    </div>
    <input type="submit" name="submit" class="btn btn-primary mb-2">
</form>