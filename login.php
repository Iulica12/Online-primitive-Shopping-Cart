<?php
    session_start();
    include("Conectare.php");
    if(isset($_POST['submit']))
    {
        $username = $_POST["user"]; /// se retine in variabila username ceea ce am introdus in input ul cu numele user
        $password = md5($_POST["pass"]);
        $query_admin = "SELECT * FROM userspass WHERE user='".$username."' AND md5(pass)='".$password."' ";
        $query_client = "SELECT * FROM clienti WHERE username='".$username."' AND md5(Parola)='".$password."' ";
        $result_admin = $mysqli->query($query_admin);
        $result_client = $mysqli->query($query_client);
        /*** Testez daca interogarea returneaza vreo linie ***/
        if(mysqli_num_rows($result_admin) != 0) 
        {
            
            $_SESSION["username"]=$username; 
        }
        elseif(mysqli_num_rows($result_client) != 0)
        {
            echo 'client';
            $_SESSION["username"]=$username;
        }
        else 
        {
            $message = "Invalid user/password";
        }
        if(isset($_SESSION["username"]))
        {
            header("location:Produse_Vizualizare.php");
        }
    }
    
    
    $mysqli->close();
?>
<!DOCTYPE html>
<html>
<head>
    <title>Login</title>
</head>
<body>
    <center>
        <h1>LOGIN PAGE<h1>
        <br><br><br><br>
        <div style="background-color: cyan">
            <form action="" method="POST">
                <strong>Username: </strong> <input type="text" name="user" value="" placeholder="username" required />
                <br>
                <strong>Password: </strong> <input type="password" name="pass" value="" placeholder="password" required />
                <br>
                <input type="submit" name="submit" value="Login"/>
            </form>
        </div>
    </center>
</body>
</html>