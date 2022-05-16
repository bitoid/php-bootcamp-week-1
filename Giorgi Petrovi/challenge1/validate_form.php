<?php     

    function set_error($value) {
        if (empty($value)) {
            return '*This field is required';
        } else if (preg_match('/[\d | \W]/', $value)) {
            return '*Only Latin alphabet characters  [a-Z]';
        } 
        return false;
    }

    function set_validation_error($data) {
        $validation_errors = [];

        foreach($data as $key => $value) {
            $error = set_error($value);
            if ($error) {
                $validation_errors[$key] = $error;
            }
        }
        
        if ($_FILES['profilePicture']['error'] == 4) {
            $validation_errors['profilePicture'] = '*Upload Image';
        } 
        return $validation_errors;
    }

?>