<?php
    $title = "Login | Simply Classified";
    $homeActive = $itemActive = $searchActive = $dashActive = $categoryActive = "";

    if($_SERVER["REQUEST_METHOD"] == "POST")
    {
        $path = $set_path['AUTHENTICATOR_PATH'].'login.php';
        require $path;
    }

