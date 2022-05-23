<?php 
    function validation($firstname, $lastname) {
        if(!ctype_alpha($firstname) && !ctype_alpha($lastname)) {
            return "First and last name must be letters only!";
        } elseif(!ctype_alpha($firstname)) {
            return "First name must be letters only!";
        } elseif (!ctype_alpha($lastname)) {
            return "Last name must be letters only!";
        }
    }

?>
