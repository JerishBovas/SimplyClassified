<?php
    $title = "Dashboard | Simply Classified";
    $homeActive = $itemActive = $searchActive = $dashActive = $categoryActive = "";
    $dashActive = "active";
    defined("PUBLIC_PATH") || define("PUBLIC_PATH" , realpath(dirname(__FILE__) . "/../../public"));

    $this_view = $set_path["VIEW_PATH"] . "dashboard" . DS;
    

    switch (get("action", "dashboard")){
        case "dashboard":{
            if(isset($_SESSION['loggedin']) && $_SESSION['loggedin'])
            {
                $string = "";
                $sql = "SELECT Id, Title, FrontPage FROM Items";
                require APPLICATION_PATH . DS . "model" . DS . "database.php";
                if($result->num_rows>0){
                    while ($row = $result->fetch_assoc()){
                        if($row['FrontPage'] == 'YES'){
                            $string .= "<div style='margin: 10px' class='container'>
                                            <span class='h3'>".$row['Title']."</span>
                                            <button class='btn btn-danger' style='float: right;clear:both;' onclick='window.location.href=\"?page=dashboard&action=hide&id=".$row['Id']."\"'>Hide</button>
                                        </div>";
                        }
                        else{
                            $string .= "<div style='margin: 10px' class='container'>
                                            <span class='h3'>".$row['Title']."</span>
                                            <button class='btn btn-success' style='float: right;clear:both;' onclick='window.location.href=\"?page=dashboard&action=show&id=".$row['Id']."\" '>Show</button>
                                        </div>";
                        }
                    }
                    $homeItemselect = $string;
                }
                $view = $this_view . "dashboard.phtml";
            }
            else
            {
                header("Location: ?page=no-access");
            }
            break;
        }
        case "show":{
            if(isset($_SESSION['loggedin']) && $_SESSION['loggedin']){
                $id = get('id');
                $sql = "UPDATE Items SET FrontPage = 'YES' WHERE Id = $id";

                require APPLICATION_PATH . DS . "model" . DS . "database.php";
                header("Location: ?page=dashboard");
            }
            else
            {
                header("Location: ?page=no-access");
            }
            break;
        }
        case "hide":{
            if(isset($_SESSION['loggedin']) && $_SESSION['loggedin']){
                $id = get('id');
                $sql = "UPDATE Items SET FrontPage = 'NO' WHERE Id = $id";

                require APPLICATION_PATH . DS . "model" . DS . "database.php";
                header("Location: ?page=dashboard");
            }
            else
            {
                header("Location: ?page=no-access");
            }
            break;
        }
    }