<?php
    // Page redirect
    function redirect($page){
        header('location: ' . URLROOT . '/' . $page);
    }
?>