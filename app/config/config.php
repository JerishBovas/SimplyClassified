<?php
    $set_path = [
        "MODEL_PATH" => APPLICATION_PATH . DS . "model" . DS,
        "VIEW_PATH" => APPLICATION_PATH . DS . "view" . DS,
        "LIB_PATH" => APPLICATION_PATH . DS . "lib" . DS,
        "SHARED_PATH" => APPLICATION_PATH . DS . "shared" . DS,
        "DATABASE_PATH" => APPLICATION_PATH . DS . "database" . DS,
        "AUTHENTICATOR_PATH" => APPLICATION_PATH . DS . "authenticator" . DS
    ];
    require $set_path["LIB_PATH"] . "functions.php";