<?php
if($_POST['option'] === "repositories" &&  strlen($username) !== 0 ):
                  require_once 'repositories.php';
endif;
if( $_POST['option'] === "followers"  && strlen($username) !== 0 ):
    require_once 'followers.php';
endif;
?>