<div class="container bg-dark p-5 mt-5">
    <form enctype="multipart/form-data" action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']) ?>" method="POST">
        <div class="mb-5">
            <label class="form-label text-white" for="first_name">First Name</label>
            <input class="form-control" type="text" autocomplete="off" name="first_name" id="first_name" placeholder="Enter your first name">
            <?php if (!empty($FIRST_NAME_REQUIRED)): ?>
                <div class="form-text text-danger">
                    <?php echo $FIRST_NAME_REQUIRED ?>
                </div>
            <?php elseif (!empty($errors['first_name'])): ?>
                <div class="form-text text-danger">
                    <?php echo $errors['first_name'] ?>
                </div>
            <?php endif; ?>
        </div>
        <div class="mb-5">
            <label class="form-label  text-white" for="last_name">Last Name</label>
            <input class="form-control" type="text" autocomplete="off" name="last_name" id="last_name" placeholder="Enter your last name">
            <?php if (!empty($LAST_NAME_REQUIRED)): ?>
                <div class="form-text text-danger">
                    <?php echo $LAST_NAME_REQUIRED ?>
                </div>
            <?php elseif (!empty($errors['last_name'])): ?>
                <div class="form-text text-danger">
                    <?php echo $errors['last_name'] ?>
                </div>
            <?php endif; ?>
        </div>
        <div class="mb-5">
            <label class="form-label  text-white" for="profile_pic">Profile Picture</label>
            <input class="form-control" type="file" autocomplete="off" name="profile_pic" id="profile_pic">
            <?php if (!empty($IMAGE_MAX_SIZE)): ?>
                <div class="form-text text-danger">
                    <?php echo $IMAGE_MAX_SIZE ?>
                </div>
            <?php elseif (!empty($errors['file_upload'])): ?>
                <div class="form-text text-danger">
                    <?php echo $errors['file_upload'] ?>
                </div>
            <?php endif; ?>
        </div>
        <button style="width: 100%;" class="btn btn-primary btn-medium" name="submit" type="submit">
            Submit
        </button>
    </form>
</div>