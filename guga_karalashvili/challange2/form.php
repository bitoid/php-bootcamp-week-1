<form action="./index.php" method="post">
    <div class="form-group">
        <input type="text" name="userName" placeholder="Please Enter Github username" value="<?php echo $usrName ?>" class="form-control" id="formGroupExampleInput" required>
    </div>
    <select name="takeOption" id="" class="custom-select custom-select-sm mb-3">
        <option value="" disabled selected>Choose Option</option>
        <option value="repositories">Repositories</option>
        <option value="followers">Followers</option>
        <option value="both">Both</option>
    </select>
    <input type="submit" name="submit" class="btn btn-primary mb-2 submit">
</form>