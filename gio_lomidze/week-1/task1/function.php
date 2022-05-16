<?php
function validator($cond,$msg) {
    if($cond) 
        echo "<p class='error'>$msg</p>";
}