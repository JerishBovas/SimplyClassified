<?php
    $title = "Home | Simply Classified";
    $homeActive = $itemActive = $searchActive = $dashActive = $categoryActive = "";
    $homeActive = "active";

    $this_view = $set_path["VIEW_PATH"];

    $string = "";
    $sql = "SELECT * FROM Items WHERE FrontPage = 'YES'";

    require APPLICATION_PATH . DS . "model" . DS . "database.php";
    if($result->num_rows > 0){
        while ($row = $result->fetch_assoc()){
            $string .= '<div style="margin:20px;padding:1vw;border-radius:5px;height:200px;clear:both" class="row bg-light">
                            <div class="col-sm-3"><img src="assets/img/'.$row['ImageName'].'" alt="" style="width:150px"></div>
                            <div class="col-sm-9">
                            <h2>'.$row['Title'].'</h2>
                            <p>'.$row['Description'].'</p>
                            <p style="float:left">Price: $'.$row['Price'].'</p></div></div>';
        }
    }

    $homeProductContent = $string;
?>
