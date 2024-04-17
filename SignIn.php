<?php
    $conn = new mysqli("localhost", "root", "", "fbdb");
    // Check connection
    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }
?>

<html lang="en">
    <head>

        <title>Sign In page</title>
        <link rel="stylesheet" href="pwcss.css">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
      


    </head>

    <body>

        <div>
            <a href="LogIn.php" class="log">log in</a>
            <a href="#">sign in</a>
        </div>


        <form action="SignIn.php" method="post">
            <label for="username" class="username">username :</label><br>
            <input type="text" placeholder="username" name="username" id="username"><br><br>
            
            <label for="password">passowrd :</label><br>
            <input type="password" placeholder="password" name="password" id="password"><br><br>

            <label for="conpassword">confirm passowrd :</label><br>
            <input type="password" placeholder="confirm password" name="conpassword" id="conpassword"><br><br>

            <input type="submit" value="sign in" class="btn-primary">
        </form>

        <?php
            if(isset($_POST["username"]) and isset($_POST["password"])){
                $username = $_POST["username"];
                $password = $_POST["password"];
                $conpassword = $_POST["conpassword"];
                if($password == $conpassword){
                    $sql="INSERT INTO `userslist`(`username`, `passwordd`) 
                            VALUES ('".$username."', '".$password."');" ; 
                    //echo $sql; 
                    $conn->query($sql);
                    echo "<h1 class='mess'>you have sign in succfuly.</h1>";
                }
                else{
                    echo "<h4 class='error'>please check the password and the confirme password...</h4>";

                }
            }
        ?>
        
        <div class="footer">
            <a href="changepw.php" id="forger">change passowrd</a><br>
            <a href="#" id="forger">forget passowrd</a>
        </div>
        
    </body>
</html>