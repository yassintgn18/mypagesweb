<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <style>
   
        .log {
            position: fixed;
            top: 250PX;
            border: 1PX solid blueviolet;
            width: 200PX;
            height: 40PX;
            left: 550PX;
            padding-top: 15px;
            font-size: 20PX;
            border-radius: 4PX;
            text-align: center;
            text-decoration: none;
            background-color: #a681de;
            color: rgb(0, 0, 0);
            transition :opacity 2s; 
            transition: background-color 0.25s;
            transition: color 0.5s;
        }
        .log:hover {
            background-color: rgb(40, 40, 255);
            color: white;
            border-color: #a681de;
            box-shadow: none;
            opacity: 0.8;
        }

        .log:active {
            opacity: 0.7;
        }



        .sign {
            position: fixed;
            top: 320PX;
            border: 1PX solid blueviolet;
            width: 200PX;
            height: 40PX;
            left: 550PX;
            padding-top: 15px;
            font-size: 20PX;
            border-radius: 4PX;
            text-align: center;
            text-decoration: none;
            background-color: #a681de;
            color: rgb(0, 0, 0);
            transition :opacity 2s; 
            transition: background-color 0.25s;
            transition: color 0.5s;
        }
        .sign:hover {
            background-color: rgb(40, 40, 255);
            color: white;
            border-color: #a681de;
            box-shadow: none;
            opacity: 0.8;
        }

        .sign:active {
            opacity: 0.7;
        }


    </style>
  
</head>
<body
style=" padding-left: 615px;
    padding-top: 540PX;
    background: url(bg.jpg) no-repeat center;
    background-size: 400Px;
    position: relative;
    background-color: rgb(33, 37, 41);
    ">

 
        <a href="LogIn.php" class="log">log in</a>
        <a href="SignIn.php" class="sign">sign in</a>
    </div>

    
</body>
</html>