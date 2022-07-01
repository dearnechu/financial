<?php
    if(isset($_SESSION['timestamp']) && (time() - $_SESSION['timestamp'] >= 1200)) { //subtract new timestamp from the old one
        session_destroy();
        echo "<script>logout();</script>";
    } else {
        $_SESSION['timestamp'] = time(); //set new timestamp
    }  
?>