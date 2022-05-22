<?php

function check_inputs($data, $files){
    $values = true;

    if(empty($data["fname"])) {  
        $GLOBALS['fnameErr'] = "First Name is required"; 
        $values = false; 
    } else {   
        $fname = $data["fname"];
        if (!preg_match("/^[A-Za-z]+$/", $fname)) {  
            $GLOBALS['fnameErr'] = "Only alphabets are allowed";  
        }  
    }  
      
    if(empty($data["lname"])) {  
        $GLOBALS['lnameErr'] = "Last Name is required"; 
        $values = false; 
    } else {  
        $lname = $data["lname"];
        if (!preg_match("/^[A-Za-z]+$/", $lname)) {  
            $GLOBALS['lnameErr'] = "Only alphabets are allowed";  
        }  
    }

    if(empty($files['image']['name'])) {
        $values = false;
    } else {
        $img_name = $files['image']['name'];
        $img_type = $files['image']['type'];
        $img_tmp_name = $files['image']['tmp_name'];
        move_uploaded_file($img_tmp_name, "images/$img_name");
    }

    if($values == true){
        $GLOBALS['show_form'] = false;
    }

}

function show_result($data, $image){
    if($data['fname'] !== "" && $data['lname'] !== "" && $image !== "") { ?> 
    <div class="container">
        <h3>First Name: <?php echo $data['fname']; ?></h3> 
        <h3>Last Name: <?php echo $data['lname']; ?></h3>;
        <img src="images/<?php echo $image ?>" alt="">
    </div>
        <?php
    } else { 
        $GLOBALS['show_form'] = false;
    }
}

?>