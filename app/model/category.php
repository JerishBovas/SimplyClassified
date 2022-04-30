<?php
    $title = "Categories | Simply Classified";
    $homeActive = $itemActive = $searchActive = $dashActive = $categoryActive = "";
    $categoryActive = "active";
    defined("PUBLIC_PATH") || define("PUBLIC_PATH" , realpath(dirname(__FILE__) . "/../../public"));

    $this_view = $set_path["VIEW_PATH"] . "category" . DS;

    switch (get("action", "categories")){
        case "categories":{
            if(isset($_SESSION['loggedin']) && $_SESSION['loggedin'])
            {
                $categoryContent = categoryTable();
                
                $view = $this_view . "categories.phtml";
            }
            else
            {
                header("Location: ?page=no-access");
            }
            break;
        }
        case "modify":{
            if(isset($_SESSION['loggedin']) && $_SESSION['loggedin']){
                if ($_SERVER["REQUEST_METHOD"] == "POST") 
                {
                    $id = get("id");
                    $name = $_POST['title'];
                    $desc = $_POST['description'];

                    //Modified sql
                    $sql = "UPDATE Category SET Name = '".$name."', Description = '".$desc."' WHERE Id = $id";

                    require APPLICATION_PATH . DS . "model" . DS . "database.php";

                    header("location: ?page=category");
                }
                else
                {
                    $id = get("id");
                    $action = "?page=category&action=modify&id=". $id;
                    $name = $desc = "";
                    //Modify get sql
                    $sql = "SELECT * FROM Category WHERE Id = $id";

                    require APPLICATION_PATH . DS . "model" . DS . "database.php";

                    if($result->num_rows > 0){
                        $row = $result->fetch_assoc();
                        $name = $row['Name'];
                        $desc = $row['Description'];
                    }
                    $view = $this_view . "modify.phtml";
                }
            }else{
                header("Location ?page=no-access");
            }
                
            break;
        }

        case "add":{
            if(isset($_SESSION['loggedin']) && $_SESSION['loggedin']){
                if ($_SERVER["REQUEST_METHOD"] == "POST") 
                {
                    $title = $_POST['title'];
                    $desc = $_POST['description'];
                    //new category sql
                    $sql = "INSERT INTO Category(Name, Description) VALUE ('".$title."', '".$desc."')";
                    require APPLICATION_PATH . DS . "model" . DS . "database.php";
                    header("location: ?page=category");
                }
                else
                {
                    $action = "?page=category&action=add";
                    $cate_file = "";

                    $view = $this_view . "add.phtml";
                }
            }else{
                header("Location ?page=no-access");
            }
            break;
        }
    }
?>