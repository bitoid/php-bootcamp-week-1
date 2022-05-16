<html>
    <head>
        <!-- link style here -->
        <link rel="stylesheet" href="./index.css">
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.1/css/all.min.css" integrity="sha512-KfkfwYDsLkIlwQp6LFnl8zNdLGxu9YAA1QvwINks4PhcElQSvqcyVLLD9aMhXd13uQjoXtEKNosOWaZqXgel0g==" crossorigin="anonymous" referrerpolicy="no-referrer" />
        <link rel="preconnect" href="https://fonts.googleapis.com">
        <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
        <link href="https://fonts.googleapis.com/css2?family=Poppins:ital,wght@0,400;0,500;0,600;0,700;0,800;1,400;1,500;1,600;1,700&family=Radio+Canada:wght@300&family=Ubuntu:wght@300&display=swap" rel="stylesheet">
    </head>

    <body>
        <form action="userinfo.php" method="post">
            <div class="form-container">
                <i class="fa-brands fa-github"></i>
                <p>Hello. You can enter a github username here:</p>
                <input type="text" name="username">
                <div class="btn-container">
                    <input id="repo" type="submit" name="submit" value="repositories">
                    <input id="fol" type="submit" name="submit" value="followers">
                </div>
            </div>
        </form>
    </body>
</html>
