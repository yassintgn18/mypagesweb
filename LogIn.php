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
?>

<html lang="en">
    <head>

        <title>Sign In page</title>
        <link rel="stylesheet" href="pwcss.css">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
     


    </head>

    <body>

        <div>
            <a href="#" class="log">log in</a>
            <a href="SignIn.php">sign in</a>
        </div>


        <form action="login.php" method="post">
            <label for="username" class="username">username :</label><br>
            <input type="text" placeholder="username" name="username" id="username"><br><br>
            
            <label for="password">passowrd :</label><br>
            <input type="password" placeholder="password" name="password" id="password"><br><br>


            <input type="submit" value="log in" class="btn-primary">
        </form>

        <?php
            if(isset($_POST["username"]) and isset($_POST["password"])){
                $username = $_POST["username"];
                $password = $_POST["password"];

                $pw = getPassword2($conn,$username);
                if( $password == $pw){
                    echo "<h1 class='mess'>you have log in succfuly.</h1>";
                }
                else {
                    echo "<h4 class='messer'>username or password wrong...try again.</h4>";

                }

            }
        ?>
        
        <div class="footer">
            <a href="changepw.php" id="forger">change passowrd</a><br>
            <a href="#" id="forger">forget passowrd</a>
        </div>
        
        
    </body>
</html>