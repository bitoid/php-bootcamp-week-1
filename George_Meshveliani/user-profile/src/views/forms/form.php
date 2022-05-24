<head>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.3.1/dist/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
</head>
<?php if (empty($_POST)): ?>
<form method="post" action="/" enctype="multipart/form-data">
    <div class="mb-3 row">
        <label>First name</label>
        <input type="text" name="name" class="form-control" id="exampleFormControlInput1" placeholder="Enter user first name" />
    </div>
    <div class="mb-3 row">
        <label>Last name</label>
        <input type="text" name="lastName" class="form-control" id="exampleFormControlInput1" placeholder="Enter user last name" />
    </div>
    <input  type="file" name="fileToUpload" id="fileToUpload">
    <br />
    <br />
    <input type="submit" value="Add user" name="submit">
</form>
<?php else: ?>

<h4>User is added, you can add more users <a href="/">here</a> </h4>

<?php endif; ?>
