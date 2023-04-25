<div class="new">
<?php
      if($_SERVER['REQUEST_METHOD']=='POST'){

         if(isset($_POST['upload'])){

            $image_name = $_FILES['image']['name'];
            $image_type = $_FILES['image']['type'];
            $image_size = $_FILES['image']['size'];
            $image_tmp_name = $_FILES['image']['tmp_name'];

           move_uploaded_file($image_tmp_name, "photos/$image_name");
           echo "<img src='photos/$image_name' width='220' height='250' >";
         }  
         echo "<br>";
         echo $_POST['username'];
         echo " ";
         echo $_POST['name'];
      }


      
  ?>
</div>

  </body>

  </html>
