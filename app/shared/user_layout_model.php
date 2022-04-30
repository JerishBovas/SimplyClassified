<?php
    $string = "";
    $sql = "SELECT * FROM Category WHERE Status='SHOW'";

    require APPLICATION_PATH . DS . "model" . DS . "database.php";
    if($result->num_rows > 0) {
        while ($row = $result->fetch_assoc()) {
            echo '<a class="dropdown-item" href="?page=items&category=' . $row['Id'] . '">' . $row['Name'] . '</a>';
        }
    }