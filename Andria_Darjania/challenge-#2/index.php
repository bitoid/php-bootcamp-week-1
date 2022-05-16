<?php
    if (!$_GET) {
        require "main.html";
    } else {
        if ($_GET['user'] && $_GET['require']) { 
            $validation = require "validation.php";
            if ($validation === "VALIDATED") {
                print '<a href="index.php"><h1 class="logo">HOME</h1></a>
            <form action="" method="get">
                <input type="hidden" name="user" value="' .$_GET["user"] . '" required>
                <label> Select: 
                    <select name="require" required>
                        <option value="followers">followers</option>
                        <option value="repositories">repositories</option>
                    </select>
                </label>
                <input type="submit" name="submit">
            </form>';
                require "response.php";
            } else {
                require "main.html";
                print "<div>User does not exist</div>";
            }
            
        } else {
            require "main.html";
            echo '<div>Fill out all field</div>';
        }
    }    
?>