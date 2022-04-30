<?php
    $title = "Search | Simply Classified";
    $homeActive = $itemActive = $searchActive = $dashActive = $categoryActive = "";
    $searchActive = "active";
    defined("PUBLIC_PATH") || define("PUBLIC_PATH" , realpath(dirname(__FILE__) . "/../../public"));

    $this_view = $set_path["VIEW_PATH"];
    $product = $set_path["DATABASE_PATH"] . "products.txt";
    $category = $set_path["DATABASE_PATH"] . "categories.txt";

    $categoryContent = category_output_generate();
    $view = $this_view.'search.phtml';
?>