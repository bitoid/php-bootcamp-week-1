<?php
    /* Globally declared variables */

    // Variables for error texts 
    $firstNameErr = '';
    $lastNameErr = '';
    $fileErr = '';

    // Variables for input data 
    $firstName = '';
    $lastName = '';
    $image = '';

    // Variables for adding styles in html 
    $style = 'border: 2px solid #f00';
    $display = '';

    // At first we check whether submit button clicked or not 
    if(isset($_POST['submit'])) {
        // Assign submitted data values to variables
        $firstName = trim($_POST['firstName']);
        $lastName = trim($_POST['lastName']);
        $image = $_FILES['profImg']['name']; // Here we get image's name

        if(empty($_POST['firstName'])) { // Here we check whether input field for first name filled or not
            $firstNameErr = 'Please enter your first name'; // And then assign error text
        }else if(!preg_match("/^[a-z]+$/i", $_POST['firstName'])) { // Here we check whether input data matches to English alphabet
            $firstNameErr = 'Your first name must contain only English letters'; // And then assign error text
        }

        if(empty($_POST['lastName'])) { // Here we check whether input field for last name filled or not
            $lastNameErr = 'Please enter your last name'; // And then assign error text
        }else if(!preg_match("/^[a-z]+$/i", $_POST['lastName'])) { // Here we check whether input data matches to English alphabet
            $lastNameErr = 'Your last name must contain only English letters'; // And then assign error text
        }
        
        if($_FILES['profImg']['error'] != 0) { // Here we check whether image's error status equals to zero or not
            $fileErr = 'Please upload your profile image'; // And then assign error text
        }
    
        // Here we check whether image file uploaded or not for saving in particular destination 
        if (isset($_FILES['profImg'])) {
            $source_path = $_FILES['profImg']['tmp_name']; // Here we get image's source path
            $destination_path = './images/' . $_FILES['profImg']['name']; // Here we define the path where we will save image
            $upload = move_uploaded_file($source_path, $destination_path); // Here we transfering image to particular destination
            
        }
    }

    
?>