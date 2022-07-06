<?php
    if(isset($_SESSION['timestamp']) && (date("YmdHis") - $_SESSION['timestamp'] >= 1190)) { //subtract new timestamp from the old one
        session_destroy();
        echo "<script>logout();</script>";
    } else {
        echo "<script>console.log('". date("YmdHis") . "', '". $_SESSION['timestamp'] . "', '". (date("YmdHis") - $_SESSION['timestamp']) . "');</script>";
        $_SESSION['timestamp'] = date("YmdHis"); //set new timestamp
    }  
?>