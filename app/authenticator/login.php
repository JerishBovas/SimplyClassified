<?php
    
    if(isset($_POST['username']))
    {
        $sql = "SELECT Password from Passwords WHERE Username = '".$_POST['username']."'";
        require APPLICATION_PATH . DS . "model" . DS . "database.php";
        if($result->num_rows > 0){
            $row = $result->fetch_assoc();
            if($row['Password'] == $_POST['password'])
            {
                $passwordErr = "";
                $_SESSION['loggedin'] = true;
                $_SESSION['admin'] = $_POST['username'];
    
                header('Location: '.$_SERVER['PHP_SELF']);
            }
            else
            {
                $passwordErr = "Please enter the correct Credentials";
            }
        }
        else
        {
            $passwordErr = "Please enter the correct Credentials";
        }
    }
    else
    {
        $passwordErr = "Please enter the correct Credentials";
    }