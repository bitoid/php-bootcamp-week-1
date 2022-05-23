<?php function chekingalphabet($firstname, $lastname){
    if(ctype_alpha($firstname)&&ctype_alpha($lastname)){
        return $firstname;
        return $lastname;            
    } else{
        return die("wrong format use A-Z");
    }  
}




