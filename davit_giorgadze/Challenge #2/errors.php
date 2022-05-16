<html>
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet"
          integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
    <link href="//maxcdn.bootstrapcdn.com/bootstrap/4.1.1/css/bootstrap.min.css" rel="stylesheet" id="bootstrap-css">
    <script src="//maxcdn.bootstrapcdn.com/bootstrap/4.1.1/js/bootstrap.min.js"></script>
    <script src="//cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
    <title>Git</title>
</head>
<body>
<div class="d-flex justify-content-center align-items-center" id="main" style="height: 100vh">
    <h1 class="mr-3 pr-3 align-top border-right inline-block align-content-center"><?= $code ?? null?></h1>
    <div class="inline-block align-middle">
        <h2 class="font-weight-normal lead" id="desc"><?= $error ?? 'Something Is Wrong' ?></h2>
        <a href="index.php">Go to home</a>
    </div>
</div>
</body>
</html>