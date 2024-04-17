<?php
    $conn = new mysqli("localhost", "root", "", "fbdb");
    // Check connection
    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }

    function getPassword2($conn, $username ) {
        $sql = "SELECT passwordd FROM userslist WHERE username = ?";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("s", $username);
        $stmt->execute();
        $result = $stmt->get_result();
        $row = $result->fetch_assoc();
        $stmt->close();

        if ($row) {
            print("the password is returned");
            return $row["passwordd"];
        } else {
            print("the password didnt finded.");
            return null;
        }
    }

    function changepw($conn, $username, $newpw){
        $sql = "UPDATE `userslist` SET `passwordd`= ? WHERE `username` = ?";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("ss", $newpw, $username);
        $stmt->execute();
        $stmt->close();
    }
    
    
?>

<html lang="en">
    <head>

        <title>change passowrd</title>
        <link rel="stylesheet" href="pwcss.css">
        

    </head>

    <body>

        <div>
            <a href="login.php" class="log">log in</a>
            <a href="SignIn.php">sign in</a>
        </div>

        <form action="changepw.php" method="post">
            <label for="username" class="username">username :</label><br>
            <input type="text" placeholder="username" name="username" id="username"><br><br>
            
            <label for="old_passowrd">old passowrd :</label><br>
            <input type="password" placeholder="old passowrd" name="old_passowrd" id="old_passowrd"><br><br>

            <label for="new_passowrd">new passowrd :</label><br>
            <input type="password" placeholder="new_passowrd" name="new_passowrd" id="new_passowrd"><br><br>

            <input type="submit" value="change passowrd" class="btn-primary">
        </form>

        <?php
            if(isset($_POST["username"]) and isset($_POST["old_passowrd"]) and isset($_POST["new_passowrd"])){

                $username = $_POST["username"];
                $old_password = $_POST["old_passowrd"];
                $new_password = $_POST["new_passowrd"];

                $oldpw = getPassword2($conn,$username);

                if ($oldpw === $old_password) {
                    changepw($conn, $username, $new_password);
                    echo "<h1 class='mess'  style='
                    position: fixed;
                    bottom:100px;
                    '>Password changed succufly.</h1>";
                } else {
                    echo "<h4 class='messero'>username or password wrong...try again.</h4>";

                }  
            }
        ?>
        <a href="#" id="forger">forget passowrd</a> 
    </body>
</html>