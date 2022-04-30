<?php
    $title = "Items | Simply Classified";
    $homeActive = $itemActive = $searchActive = $dashActive = $categoryActive = "";
    $itemActive = "active";
    defined("PUBLIC_PATH") || define("PUBLIC_PATH" , realpath(dirname(__FILE__) . "/../../public"));

    $this_view = $set_path["VIEW_PATH"] . "items" . DS;

    switch (get("action", "items")){
        case "items":{
            if(isset($_SESSION['loggedin']) && $_SESSION['loggedin'])
            {
                $categoryContent = category_output_generate();
                $productContent = '<a href="?page=items&action=add" style="margin-bottom: 10px" role="button" class="btn btn-success float-right"><i class="fas fa-plus-circle"></i> Add</a>';
                $productContent .= product_list("admin");
            }
            else
            {
                $categoryContent = category_output_generate();
                $productContent = product_list("user");
            }
            $view = $this_view . "items.phtml";
            break;
        }
        case "delete":{
            if(isset($_SESSION['loggedin']) && $_SESSION['loggedin']){
                $id = get("id");
                
                $sql = "DELETE FROM Items WHERE Id = $id";

                require APPLICATION_PATH . DS . "model" . DS . "database.php";
                header('location: ?page=items');
            }else{
                header("Location: ?page=no-access");
            }
            break;
        }
        case "update":{
            if(isset($_SESSION['loggedin']) && $_SESSION['loggedin']){
                if ($_SERVER["REQUEST_METHOD"] == "POST") 
                {
                    $id = get("id");
                    $image_dir = PUBLIC_PATH . DS . 'assets' . DS . 'img'.DS;
                    
                    if(isset($_FILES['image'])){
                        $errors= array();
                        $file_size =$_FILES['image']['size'];
                        $file_tmp =$_FILES['image']['tmp_name'];
                        $file_type=$_FILES['image']['type'];
                        $file_ext=strtolower(end(explode('.',$_FILES['image']['name'])));
                        $file_name = $_POST['title'].$file_size.'.'.$file_ext;
                        
                        $extensions= array("jpeg","jpg","png");
                        
                        if(in_array($file_ext,$extensions)=== false){
                        $errors[]="extension not allowed, please choose a JPEG or PNG file.";
                        }
                        
                        if(empty($errors)==true){
                            move_uploaded_file($file_tmp, $image_dir.$file_name);
                            $sql = "UPDATE Items SET Title = '".$_POST['title']."', Description = '".$_POST['description']."', Price = '".$_POST['price']."', ImageName = '".$file_name."', CategoryId = '".$_POST['category']."' WHERE Id = $id";
                        }
                        else{
                            $sql = "UPDATE Items SET Title = '".$_POST['title']."', Description = '".$_POST['description']."', Price = '".$_POST['price']."', CategoryId = '".$_POST['category']."' WHERE Id = $id";
                        }
                    }
                    else{
                        $sql = "UPDATE Items SET Title = '".$_POST['title']."', Description = '".$_POST['description']."', Price = '".$_POST['price']."', CategoryId = '".$_POST['category']."' WHERE Id = $id";
                    }

                    require APPLICATION_PATH . DS . "model" . DS . "database.php";
                    header("location: ?page=items");
                }
                else
                {
                    $id = get("id");
                    $action = "?page=items&action=update&id=". $id;
                    $cate_file = "";
                    $categoryContent = category_output_generate();

                    $sql = "SELECT * FROM Category";

                    require APPLICATION_PATH . DS . "model" . DS . "database.php";

                    //category selector
                    if($result->num_rows > 0){
                        while($row = $result->fetch_assoc()){
                            $cate_file .= '<option value="'.$row['Id'].'">'.$row['Name'].'</option>';
                        }
                    }
                    $sql = "SELECT * FROM Items WHERE Id = $id";
                    require APPLICATION_PATH . DS . "model" . DS . "database.php";
                    if($result->num_rows > 0){
                        $row = $result->fetch_assoc();
                        $pdtname = $row['Title'];
                        $pdtdesc = $row['Description'];
                        $pdtprice = $row['Price'];
                    }
                    
                    $view = $this_view . "update.phtml";
                }
            }
            else{
                header("Location: ?page=no-access");
            }
            break;
        }

        case "add":{
            if(isset($_SESSION['loggedin']) && $_SESSION['loggedin'])
            {
                if ($_SERVER["REQUEST_METHOD"] == "POST") 
                {
                    $image_dir = PUBLIC_PATH .DS.'assets' . DS . 'img' . DS;
                    $title = $_POST['title'];
                    $desc = $_POST['description'];
                    $price = $_POST['price'];
                    $cate = $_POST['category'];

                    
                    if(isset($_FILES['image'])){
                        $errors= array();
                        $file_size =$_FILES['image']['size'];
                        $file_tmp =$_FILES['image']['tmp_name'];
                        $file_type=$_FILES['image']['type'];
                        $file_ext=strtolower(end(explode('.',$_FILES['image']['name'])));
                        $file_name = $_POST['title'].$file_size.'.'.$file_ext;
                        
                        $extensions= array("jpeg","jpg","png");
                        
                        if(in_array($file_ext,$extensions)=== false){
                        $errors[]="extension not allowed, please choose a JPEG or PNG file.";
                        }
                        
                        if($file_size > 2097152){
                        $errors[]='File size must be exactly 2 MB';
                        }
                        
                        if(empty($errors)==true){
                            move_uploaded_file($file_tmp, $image_dir.$file_name);
                            //add sql
                            $sql = "INSERT INTO Items(Title, Description, Price, ImageName, CategoryId, Status, FrontPage) VALUE ('".$title."', '".$desc."', '".$price."', '".$file_name."', '".$cate."', '".SHOW."', '".NO."')";
                        }
                        else{
                            $sql = "INSERT INTO Items(Title, Description, Price, ImageName, CategoryId, Status, FrontPage) VALUE ('".$title."', '".$desc."', '".$price."', 'no-image-available.jpg', '".$cate."', '".SHOW."', '".NO."')";
                        }
                    }
                    else{
                        $sql = "INSERT INTO Items(Title, Description, Price, ImageName, CategoryId, Status, FrontPage) VALUE ('".$title."', '".$desc."', '".$price."', 'no-image-available.jpg', '".$cate."', '".SHOW."', '".NO."')";
                    }

                    require APPLICATION_PATH . DS . "model" . DS . "database.php";

                    header("location: ?page=items");
                    
                }
                else
                {
                    $action = "?page=items&action=add";
                    $cate_file = "";
                    $categoryContent = category_output_generate();

                    $sql = "SELECT * FROM Category";

                    require APPLICATION_PATH . DS . "model" . DS . "database.php";

                    //category selector
                    if($result->num_rows > 0){
                        while($row = $result->fetch_assoc()){
                            $cate_file .= '<option value="'.$row['Id'].'">'.$row['Name'].'</option>';
                        }
                    }
                    $view = $this_view . "add.phtml";
                }
            }
            else{
                header("Location: ?page=no-access");
            }
            break;
        }
    }
?>