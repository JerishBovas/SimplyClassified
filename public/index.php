<?php
    session_start();
    defined("APPLICATION_PATH") || define("APPLICATION_PATH" , realpath(dirname(__FILE__) . "/../app"));
    const DS = DIRECTORY_SEPARATOR;

    require APPLICATION_PATH . DS . "config" . DS . "config.php";

    if(isset($_SESSION['loggedin']) && $_SESSION['loggedin'])
    {
        $page = get("page", "dashboard");
        $model = $set_path["MODEL_PATH"] . $page . ".php";
        $view = $set_path["VIEW_PATH"] . $page . ".phtml";
        $layout = $set_path["SHARED_PATH"]."admin_layout.phtml";

        if(file_exists($model)){
            require $model;
        }
        if(file_exists($view)){
            $content =  $view;
        }
        else{
            $content = $set_path["VIEW_PATH"]."404.phtml";
        }

        require $layout;
    }
    else
    {
        $page = get("page" , "home");
        $model = $set_path["MODEL_PATH"] . $page . ".php";
        $view = $set_path["VIEW_PATH"] . $page . ".phtml";
        $layout = $set_path["SHARED_PATH"]."user_layout.phtml";

        if(file_exists($model)){
            require $model;
        }
        if(file_exists($view)){
            $content =  $view;
        }
        else{
            $content = $set_path["VIEW_PATH"]."404.phtml";
        }
        
        require $layout;
    }