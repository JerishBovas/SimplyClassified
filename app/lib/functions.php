<?php
    function get($name , $def = ""){
        return isset($_REQUEST[$name]) ? $_REQUEST[$name] : $def;
    }
    function category_output_generate()
    {
        $string = "";
        $sql = "SELECT * FROM Category WHERE Status='SHOW'";

        require APPLICATION_PATH . DS . "model" . DS . "database.php";

        if($result->num_rows > 0){
            while($row = $result->fetch_assoc()){
                $actStat = $row['Id'] == get("category", "")? 'active bg-info':'';
                $string .= '<li class="nav-item">
                    <a  style="text-align: center;" class="nav-link" href="?page=items&category=' . $row['Id'] . '"><button style="width:15vw" type="button" class="btn btn-primary '.$actStat.'">' . $row['Name'] . '</button></a>
                </li>';
            }
        }
        return $string;
    }
    function product_list($user)
    {
        $string = "";
        $categoryId = get('category', '');

        $sql = "SELECT * FROM Items";

        require APPLICATION_PATH . DS . "model" . DS . "database.php";

        if($result->num_rows > 0){
            while($row = $result->fetch_assoc()){
                if($categoryId == "" || $categoryId == $row['CategoryId']){
                    $string .= '<div style="margin:20px;padding:1vw;border-radius:5px;height:200px;clear:both" class="row bg-light">
                                    <div class="col-sm-3"><img src="assets/img/'.$row['ImageName'].'" alt="" style="width:150px"></div>
                                    <div class="col-sm-9">
                                    <h2>'.$row['Title'].'</h2>
                                    <p>'.$row['Description'].'</p>
                                    <p style="float:left">Price: $'.$row['Price'].'</p>';
                    if($user == "admin"){
                        $string .= '<button onclick="bootcon(\'?page=items&action=delete&id='.$row['Id'].'\')"  class="btn btn-danger float-right m-1" role="button">Delete</button>'.
                            '<a href="?page=items&action=update&id='.$row['Id'].'"  class="btn btn-warning float-right m-1" role="button">Update</a>';
                    }
                    $string .= '</div></div>';
                }
            }
        }
        return $string;
        
    }
    function dashForm()
    {
        $string = "";
        $file = file($GLOBALS['product']);
        foreach($file as $data)
        {
            $array = explode('|', $data);
            $string .= "<div class='form-check'>
                            <label class='form-check-label'>
                            <input type='checkbox' class='form-check-input' name='check' id='check' value='{$array[0]}'>
                            {$array[1]}
                            </label>
                        </div>";
        }
        return $string;
    }
    function categoryTable()
    {
        $string = "";
        $sql = "SELECT * FROM Category";

        require APPLICATION_PATH . DS . "model" . DS . "database.php";

        if($result->num_rows > 0){
            while($row = $result->fetch_assoc()){
                $string .= "<tr>
                        <td>{$row['Id']}</td>
                        <td>{$row['Name']}</td>
                        <td>{$row['Description']}</td>
                        <td><a href='?page=category&action=modify&id={$row['Id']}' class='btn btn-primary' role='button'>Modify</a></td>
                    </tr>";
            }
        }
        return $string;
    }