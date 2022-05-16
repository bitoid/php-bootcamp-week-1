<?php include "classes.php"; ?>


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
        <h1>PHP Submition Form for Oto Zakalashvili</h1>
    </div>

    <form action="" method="post" class="form" enctype="multipart/form-data">
        <!-- სახელის ველი   Name input -->
        <div class="input-group mb-3 w-25">
            <input type="text" name="name" class="form-control"  id="name" aria-label="Sizing example input" aria-describedby="inputGroup-sizing-default" placeholder="First Name" value="">
        </div>
         <!-- გვარის ველი Surname Input -->
        <div class="input-group mb-3 w-25">
            <input type="text"  name="lastname" class="form-control" id="lastname" aria-label="Sizing example input" aria-describedby="inputGroup-sizing-default" placeholder="Last Name" value="">
        </div>
         <!-- ფოტოს ასატვირთი ველი  Upload photo -->
        <div class="mb-3 w-25">
            <input type="file"  class="form-control"  name="image" id="formFile"  placeholder="Upload profile Picture">
        </div>
        <!-- საბმითის ღილაკი  Submit button -->
        <div class="btn-group" role="group" aria-label="Basic outlined example">
            <button type="submit" class="btn btn-outline-primary">Submit</button>
        </div>
    </form>


    <!-- მიღებული შედეგები სახელისა და გვარის ველებიდან. results from name and lastname field-->
    <div class="conteiner">
        <div class="first-last-name">
            <h1><?php echo $result1 ?></h1><hr>
        </div>
    </div>

    <!-- ატვირთული ფოტო რომელიც უნდა გამოჩნდეს იმავე გვერდზე. uploaded image -->
    <div class="imagecont">
        <img class="img-thumbnail" src="<?php if(isset($_FILES['image'])){ echo 'images/'.$_FILES['image']['name'];  } ?>" alt=""> 
    </div>
    

</body>
</html>