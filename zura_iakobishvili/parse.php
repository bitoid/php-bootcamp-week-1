
 <!DOCTYPE html>
 <html>
    <head>
        <link rel="stylesheet" href="style.css">
        <link rel="stylesheet" href="reset.css">
        <body>
            <div class="form-conteiner"></div>
                <form action="parse.php" method="post">
                    <input class="username" type="text" name = "username" placeholder = "username">
                    <label class="username choose" for="data">Choose parameter-></label>
                    <select class="username" name="data" id="data">
                    <option class="username" value="repositories">Repositories</option>
                    <option class="username" value="followers">Followers</option>
                    <option class="username" value="both_of_them">Repositories & Followers</option>
                    <input class="username submit" type="submit" name = "submit" value = "Send a request"> 
                </form> 
           </div>      
       
           <?php

            include 'curl.php';

            

               if(isset($_POST['submit'])){
        
                
                $userinfo = $_POST['data'];
                $username = $_POST['username'];
                $folowers_url = "https://api.github.com/users/$username/followers?per_page=100&page=1";
                $repositories_url = "https://api.github.com/users/$username/repos?per_page=100&page=1";
                

                if($username=== ""){
                    echo "<span class='error'> Please , enter a username</span>";
                   
                }
                    
                    

                if(($userinfo === "followers")&&($username!=="")){
                    curl_function($folowers_url);
                    foreach_function_followers($data, $username);
                    
                }
                   

                if(($userinfo === "repositories")&&($username!=="")){
                    curl_function($repositories_url);
                    foreach_function_repositories($data,$username);
                } 
                        
                       
                           

                if(($userinfo === "both_of_them")&&($username!=="")){
                    curl_function($folowers_url);
                    foreach_function_followers($data, $username);
                    curl_function($repositories_url);
                    foreach_function_repositories($data,$username);
                }


            }
            
        ?>
            
        </body>
    </head>
</html>
     

          
                
                
            

        
    
           
           
 
 
 




