<?php
    if(isset($_SESSION['timestamp']) && (strtotime(date("YmdHis")) - $_SESSION['timestamp'] >= 1190)) { //subtract new timestamp from the old one
        session_destroy();
        echo "<script>console.log('". strtotime(date("YmdHis")) . "', '". $_SESSION['timestamp'] . "', '". (strtotime(date("YmdHis")) - $_SESSION['timestamp']) . "');</script>";
        echo "<script>logout();</script>";
    } else {
        echo "<script>console.log('". strtotime(date("YmdHis")) . "', '". $_SESSION['timestamp'] . "', '". (strtotime(date("YmdHis")) - $_SESSION['timestamp']) . "');</script>";
        $_SESSION['timestamp'] = strtotime(date("YmdHis")); //set new timestamp
    }  
?>