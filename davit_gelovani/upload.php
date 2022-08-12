<?php 
if(isset($_POST['submit']) && isset($_FILES['profile']) && $_POST['name'] && $_POST['surname']){
  print '<h1>' . 'Name:' .'</h1>' . $_POST['name'];
  print '<h1>' . 'Surname:' .'</h1>' . $_POST['surname'];
  print '<h1>Profile Picture:</h1>';  

  $imageData = file_get_contents($_FILES['profile']['tmp_name']); 
  echo sprintf('<img src="data:image/png;base64,%s" />', base64_encode($imageData));

}  else{
  header("Location: index.php");
}
