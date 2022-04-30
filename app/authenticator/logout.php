<?php
    $_SESSION['loggedin'] = false;
    $_SESSION['admin'] = "";

    header('Location: '.$_SERVER['PHP_SELF']);