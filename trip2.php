<?php
$d=0;

	$conn = new mysqli("localhost", "root", "", "de");
	if ($conn->connect_error) {
		die("Connection failed: " . $conn->connect_error);
    }

    if (isset($_GET["idannule"])){
        $sql="DELETE FROM `sales` WHERE `sales`.`id` =".$_GET["idannule"].";";
        $conn->query($sql);
    }
    
    function getArticlePrice($id,$conn){
        $sql="SELECT `price` FROM `balls` WHERE `id` = ".$id.";";
        $ball_name = $conn->query($sql);
        if ($ball_name !== false && $ball_name->num_rows > 0) {
            $row = $ball_name->fetch_assoc();
            return $row["price"];
        } else {
            // Handle the case where the query was not successful or no rows were found
            return "N/A the connestion did not succes in this case step";
        }
    }

    function getLastIdcommande($conn){
        $sql="SELECT `idcommande` FROM `sales` ORDER BY `sales`.`idcommande` DESC LIMIT 1;";
        $id = $conn->query($sql);
        $row= $id->fetch_assoc(); 
        return $row["idcommande"];
    }

    function getballname($id,$conn){
        $sql="SELECT `ball _name` FROM `balls` WHERE `id` = ".$id.";";
        $ball_name = $conn->query($sql);
        /*$row= $ball_name->fetch_assoc(); 
        return $row["ball _name"];*/

        if ($ball_name !== false && $ball_name->num_rows > 0) {
            $row = $ball_name->fetch_assoc();
            return $row["ball _name"];
        } else {
            // Handle the case where the query was not successful or no rows were found
            return "N/A the connestion did not succes in this case step";
        }
	}

    if(isset($_GET["idcommande"]))
        $idcommande=$_GET["idcommande"];
    else
        $idcommande= getLastIdcommande($conn);

    if(isset($_POST["ball_id"])){
        $id_ball = $_POST["ball_id"];
        $quantite = $_POST["quantite"];
        $sql="INSERT INTO `sales` ( `idcommande` ,`id_ball`,`ball _name` ,`price`,`quantite`) 
        VALUES ('".$idcommande."', '".$id_ball."',  '".getballname($id_ball,$conn)."', '".getArticlePrice($id_ball,$conn)."', '".$quantite."');" ;  
        $conn->query($sql);

    }
    
?>

<!DOCTYPE html>
<html lang="en">
    <head>
        <title>tripe materiales</title>

        <STYLE>

            .profile_icon {
                height: 40PX;
                width: 40PX;
                border-radius: 20PX;
                cursor: pointer;
            }
            .div2 {
                background-color: rgb(53, 102, 172);
                width: 175px;
                right: 0%; 
                height: 100%;
                border-radius: 5px;
                color: rgb(0, 137, 137);
                position: fixed;
                z-index: 1;
                margin-top: 10PX;
                margin-right: 5PX;
                font-size: 19px;
                cursor: POINTER;
                border-color: hsl(322, 100%, 52%);
             
            }
            .hl {
                padding: 10px;
                padding-top: 0%;
                background-color: rgb(0, 19, 50);
                font-family: 'Verdana', Geneva, sans-serif;
                font-size: 20PX;
                text-decoration: underline;
                border-top-left-radius: 10px;
                border-top-right-radius: 10px;
                color: rgb(250, 255, 103);
                text-shadow: 2PX 2PX 2PX black;
            }
  
            .searchimg {
                height: 25PX;
                margin: 0Px;
                margin-top: 8PX;
                color: white;
            }
      
            ul {
                list-style: none;
                padding-left: 8px;   
            }
            li a {
                display: block;
            }

            li {
                border-top: 1px solid #5e5959;
                height: 40PX;
            }

            li a,li a:visited {
                text-decoration: none;
                color: black;
            }

            li a:hover, li a:focus {
                background-color: rgb(91, 97, 97);
                color: whitesmoke;
            }
            table {
                color: rgb(47, 129, 247);
            }
            .form-select {
                background-color: rgb(45, 79, 190);
                font-size: 25PX;
                margin-left: 70PX;
                border-radius: 5PX;
                margin-bottom: 50px;
            }
            .btn-primary:hover {
                background-color: rgb(45, 79, 190);
                color: rgb(255, 255, 255);
                opacity: 0.8;
            }

            .btn-primary:active {
                opacity: 0.7;
            }
       

            .add {
                color: #f5f5f5;
                font-size: 15PX;
                text-decoration: underline;
                margin-left: 10PX;
                border: 0.5 solid blue;
                border-radius: 10PX;
            }
            label {
                background-color: rgb(0, 13, 35);
                border-radius: 14PX;
                border:0px;
                color: rgb(47, 129, 247);
                cursor: pointer;
                height: 100px;
                box-shadow: 2PX 2PX 7PX rgb(255, 0, 217);
                transition: opacity 0.15s;
                transition: box-shadow 1s;
                margin-left: 15PX;
                margin-right: 15PX;
                margin-bottom: 10px;
                font-size: 17px;
                text-align: center;
                
            }
            .buy {
                background-color: rgb(0, 0, 0);
                border-radius: 14PX;
                border:0px;
                color: red;
                cursor: pointer;
                padding-top: 3px;
                padding-block: 3px;
                padding-left: 100px;
                padding-right: 100px;
                box-shadow: 2PX 2PX 7PX rgb(255, 0, 217);
                transition: opacity 0.15s;
                transition: box-shadow 1s;
                margin-left: 30PX;
                margin-bottom: 40px;
                margin-top: 20px;
                font-size: 20px;
                text-align: center;
                transform: 1s;
                transition: 6s;
            }
            .buy:hover {
            box-shadow: 6PX 4PX 7PX rgb(255, 46, 224);
            color: rgb(61, 142, 254);
            background-color: rgb(0, 13, 35);
            }
            #codeArticle, #quantite,#ball_id {
                background-color:rgb(240, 246, 249);
                border: 0.5px solid rgb(0, 19, 50);
                border-radius: 15PX;
                height: 16px;
            }
            .btn-primary {
                border-color: rgb(109, 150, 175);
                border-radius: 2px;
                color: rgb(45, 79, 190);
                border-style: solid;
                border-width: 1PX;
                margin-right:3px;
                margin-left: 2px;
                padding-top: 6px;
                padding-block: 6px; 
                margin-top: 25px;  
                cursor: pointer;
                margin-left : 2PX;
                background-color: rgb(255, 255, 255);
                transition :opacity 2s; 
                transition: background-color 0.25s;
                transition: color 0.5s
            }
            .paiement {
                background-color: rgb(237, 237, 237);
                border-radius: 14PX;
                border:0px;
                color: #6cc644;
                cursor: pointer;
                padding-top: 4px;
                padding-block: 4px;
                padding-left: 5px;
                padding-right: 5px;
                box-shadow: 2PX 1.5PX 5PX rgb(255, 0, 217);
                transition: opacity 0.15s;
                transition: box-shadow 1s;
                margin-left: 20PX;
                margin-bottom: 4px;
                font-size: 15px;  
                transition: 5S;
            }
            .paiement:hover {
                background-color: rgb(96, 162, 255);
                box-shadow: 4PX 4PX 9PX rgb(255, 0, 217);
            }
            pre {
                font-size: 14px;
                color: rgb(91, 97, 97);
                font-family: 'Arial', sans-serif;
            }
            .defoot {
                color: rgb(250, 250, 250);
                font-family: 'Arial', sans-serif;
                left: 0%;
            }
            .footer-icons {
                color: white;
                text-decoration: none;
            }
            #toggleSidebarButton {
                background-color: rgb(96, 162, 255);
                color: black;
                border: none;
                width: 50PX;
            }
            span {
                font-size: 20px;
                color: greenyellow;
            }
            .anull {
                color: red;
            }
            .left {
        width: 200PX;
        align-items: center;
        display: flex;
    }

    .home_icon {
        height: 37PX;
        width: 37PX;
        cursor: pointer;
        margin-left: 0PX;
        transition: 0.5s;
        margin-right: 10Px;
        opacity: 0.6;
        margin-top: 6PX;
    }
    .home_icon:hover {
        background-color: rgb(255, 238, 52);  
        opacity: 0.9;
        border: 1px solid rgb(255, 238, 52);
        border-radius: 23PX;
        height: 47PX;
        width: 47PX;
        opacity: 0.9;
        margin-top: 15PX;


    }
    .explore_icon {
        height: 37PX;
        transition: 0.5s;
        width: 37PX;
        cursor: pointer;
        margin-left: 10PX;
        margin-right: 20PX;
        opacity: 0.6;
        margin-top: 6PX;
    }
    .explore_icon:hover {
        background-color: rgb(255, 238, 52);  
        opacity: 0.9;
        border: 1px solid rgb(255, 238, 52);
        border-radius: 300PX;
        height: 47PX;
        width: 47PX;
        opacity: 0.9;
        margin-top: 15PX;
    }
    .search_icon {
        width: 70PX;
        height: 33PX;

        background-color: rgb(244, 244, 244);
        border: 1px solid rgb(188, 188, 188);
        border: 100px;
        border-radius: 10PX;
        border-top-right-radius: 0%;
        cursor: pointer;
        border-right-color: rgb(255, 255, 255);
        position: relative;
        border: 1px solid rgb(242, 242, 242);
        border-top-right-radius: 0%;
        border-bottom-right-radius: 0%;
        border-top-left-radius: 6PX;
        border-bottom-left-radius: 6PX;
    }
    .search-container {
        background-color: #acacac;
        border: none;
        border-radius: 10PX;
        display: grid;
        grid-template-columns: 20PX 1fr;
    }
   
    .searchimg {
        height: 25PX;
        margin: 0Px;
        margin-top: 8PX;
        color: white;
    }
    .search_input_list {
        background-color: #acacac;
        height: 30PX;
        border: 1px solid black;
        border-radius: 6PX;
        margin-left: 5PX;
        width: 135PX;
        margin-top: 2PX;
    }
    .right {
        flex-shrink: 0;
        width:50PX;
        display: flex;
        align-items: center;
        justify-content: space-between;
        margin-right: 20PX;
    }
    .buy_icon {
        height: 37PX;
        margin-right: 0PX;
        cursor: pointer;opacity: 0.6;
        margin: 0%;
        transition: 0.5s;
        margin-top: 6px;
        margin-left: 59px;
    }
    .buy_icon:hover {
        background-color: rgb(255, 238, 52);  opacity: 0.9;
        border: 1px solid rgb(255, 238, 52);
        border-radius: 25PX;
        height: 50PX;
        
        opacity: 0.9;
        margin-top: 15PX;
    }
    
    .notification_number {
        position: relative;
    }
    .notification_icon {
        cursor: pointer;
        height: 35PX;opacity: 0.6;
        margin-left: 3px;
        width: 37PX;
        transition: 0.5s;
        margin-left: 5px;
        margin: 0%;
    }
    .notification_icon:hover {
        background-color: rgb(255, 238, 52);  opacity: 0.9;
        border: 1px solid rgb(255, 238, 52);
        border-radius: 19PX;
        height: 47PX;
        width: 47PX;
        opacity: 0.9;
        margin-top: 15PX;
    }
    .number_of_notifications {
        position: absolute;
        top: 4PX;
        right: 2PX;
        background-color: rgb(216, 0, 0);
        color: white;
        font-family: Arial, Helvetica, sans-serif;
        font-size: 16PX;
        padding-left: 4PX;
        padding-right: 4PX;
        border:0px solid rgb(152, 0, 0);
        border-radius: 10PX;
    }
    #toggleSidebarButton {
        background-color: rgb(255, 255, 255);
        color: black;
        border: none;
        width: 50PX;
    }.three_lines {
        height: 37PX;
        margin-right: 0PX;opacity: 0.6;
        cursor: pointer;
        margin-left: 0px;
        margin: 0%;
        transition: 0.5s;
    }
    .three_lines:hover {
        background-color: rgb(255, 238, 52);  opacity: 0.9;
        height: 47PX;
        width: 47PX;
        opacity: 0.9;
        margin-top: 8PX;
        
       
    }
    .search::placeholder {
        font-size: 16px;
    }
    .what_icon {
        width: 34PX;
        height: auto;
        transition: 0.5S;
        cursor: pointer;
        margin-left: 10px;
        margin: 0%;
    }
    .what_icon:hover {
        width: 46PX;
        margin-top: 8px;

    }
    .con {
        text-decoration: none;
        text-shadow: none;
        font-size: 18px;
        transition: 0.5s;
        margin-left: 30px;
    }
    .con:hover {
        font-size: 20PX;
      
        
    }
    .f_icon {
        width: 34PX;
        height: auto;
        cursor: pointer;
        transition: 0.5s;
        margin-right: 20PX;
        margin-left: 10px;
    
    }
    .f_icon:hover {
        width: 46PX;
        margin-top: 8px;

    }
    table {
        border-color: rgb(230, 230, 234);
        box-shadow: 5PX -5PX 5PX rgb(32, 83, 142);
    }
    a title {
        color: red;
    }
    .photo {
        margin-left: 250PX;
    }
    .liv {
        background-color: rgb(255, 203, 34);
        color: black;
        text-align: center;
        padding-top: 5PX;
        height: 30PX;
        margin-top: 0%;
        margin-bottom: 20PX;
        width: 100%;
    }
    .nav {
        display: flex;
        margin-left: 200px;
        margin-top: 40px;
    }
    .nav li {
        margin-right: 50px;
        margin-left: 50PX;
        text-decoration: underline;
        border: none;
        color: rgb(91, 97, 97);
        font-size: 18PX;transition: 0.5s;
        font-family: sans-serif;
    }
    .nav a {
        text-decoration: none;
        
    }
    .nav li:hover {
        font-size: 25px;
        text-decoration: none;
        color: rgb(40, 140, 140);
        
    }
   
                
        </STYLE>
    </head>

    <body style="
        height:40000PX;
        padding-top: 50PX;
        
        background-color:white;
        color: rgb(47, 129, 247);">
  


<header style="
    color: #f5f5f5;
    font-family: serif;
    height: 55PX;
    padding-top:10px;
    width: 100%;
    text-align: center;
    font-size: 35PX ;
    position: fixed;
    top:0%;
    left:0%;
    right:0%;
    text-shadow: 4PX 4PX 4PX black;
    background-color: rgb(255, 255, 255);
    display:flex;
    flex-direction: row;
    justify-content: space-between;
    
    z-index: 100;
    ">

    <img src="icons_for_css\logo-decathlon-blue.svg" alt="" style="margin-right: 30PX;width:180px;margin-left: 30PX;height:35px;padding-top:10px;">

            <div class="left" style="flex:3;">



            
                
                <a href="final_porjet.php?idcommande=0" title="home">
                    <img class="home_icon" src="icons_for_css/home.svg" alt=""></a>   


                <a href="explor.php" title="explor">           
                <img class="explore_icon" src="icons_for_css/explore.svg" alt=""></a> 




                <img class="search_icon" src="icons_for_css/search.svg" alt="icon_search">
                <input  type="search" 
                        name="search" 
                        class="search" 
                        style="
                                height: 35PX;
                                top:1%;
                                width: 380PX;
                                transition:0.5s;
                                
                                border-radius: 6px;
                                border-bottom-left-radius: 0%;
                                
                                border-top-left-radius: 0%;
                                background-color: rgb(244, 244, 244);
                                border: 1px solid rgb(245, 245, 245);
                                
                                "
                        id="ser" 
                        placeholder="Rechercher un produit, un sport, ou une référence">
                </input>
                
            </div>

    
        <div class="right" style="flex:2;"  style="flex:2;font-size:20PX;margin-top:5PX;font-family:Arial Narrow, sans-serif;">
            <a href="#" style="color:#3f3d3d;margin-right:5PX;" class="con">conecte us</a>
            <img class="what_icon" src="icons_for_css/w.png" alt="">
            <img class="f_icon" src="icons_for_css/f.png" alt="">


            <a href="final_porjet.php?idcommande=<?php echo 	$idcommande+1; ?>" title="new damende">
                <img class="buy_icon" src="icons_for_css\buy.png" alt=""></a>
        
    
       

            <div class="notification_number">
                <img class="notification_icon" src="icons_for_css/notifications.svg" alt="">
                <div class="number_of_notifications">3</div>
            </div>

        
        <button id="toggleSidebarButton"><img class="three_lines" src="icons_for_css/hamburger-menu.svg" alt="three_lines.png"></button>
        
        
    </div>
</header>

<ul class="nav">
    <a href="#"><li>men</li></a>
    
    <a href="#"><li>woman</li></a>
    
    <a href="#"><li>children</li></a>

    <a href="balls_page.php"> <li>balls</li></a>
    
    <a href="#"> <li>trip</li></a>
   
    <a href="#"> <li>sport</li></a>
  
</ul> <hr>



<h3 class="liv">livraison fabbor.</h3>

<img src="imges1/cc.jpg" alt="walo" width=100% height="400">


































<div style="display: grid;grid-template-columns: 800PX 450PX;" class="the_big_div">
            

            <div>
                <?php
                 
                 
                    echo "<pre><h1>                   trip materiales</h1></pre>";
                    echo '<table border=1 class="table2">';
                    echo "<tr> <td><h1>trip materiales</h1></td> <td><h1>name</h1></td> <td><h1>price</h1></td> ";

                    $sql = "SELECT * FROM `trip`";
                    $listballs = $conn->query($sql);
                    //echo $sql;
                    if ($listballs->num_rows > 0) {
                
                        while($row = $listballs->fetch_assoc()) {
                            echo '<tr> <td><img src=trip/'.$row["id"].'.png width="520" hight="130" /></td> <td><h1>'.$row["nome_materail"].'</h1></td> <td><h1>'.$row["price"].'</h1></td> </tr> ';
                        }
                    }
                    echo "</table>";
                ?>
            </div>



            <div>
                <?php
                    echo"<h1 class='yas'>sals balls:".$idcommande."</h1>";
                    echo"<table border=1>";
                    echo "<tr> <td><h3>delete </h3></td> <td><h3>ball_photo</h3></td> <td><h3>quantite</h3></td>  <td><h3>price</h3></td> </tr>";

                    $sql = "SELECT * FROM `sales` WHERE `idcommande` = ".$idcommande." ";
                    $salesballs = $conn->query($sql);
                    $somme=0;
                    
                    if ($salesballs->num_rows > 0) {
                        while($row = $salesballs->fetch_assoc()) {

                            $somme= $somme + $row["quantite"] * $row["price"];
                        
                            echo "<tr> <td><a style='color: red;' href=final_porjet.php?idannule=".$row["id"].">annuler</a></td>  <td><img src=imges1/".$row["id"].".png  width=\"200\" hight=\"100\"/></td> <td><h1>".$row["quantite"]."</h1></td> <td><h1>".$row["price"]."</h1></td></tr> ";
                        }
                    }
                    echo "<tr> <td> </td> <td><h2> Prix Total</h2></td> <td>      Q</td> <td><h2>".$somme."</h2></td> </tr> ";

                    echo "</table>";   
                ?>





<form action="final_porjet.php" method="GET">
            <select class="form-select" name="idcommande" id="idcommande" aria-label="Default select example">
                <?php
                    $sql = "SELECT distinct idcommande FROM `sales` ";
                    $listAchat = $conn->query($sql);
                    if ($listAchat->num_rows > 0) {
                        while($row = $listAchat->fetch_assoc()) {
                            echo '<option value="'.$row["idcommande"].'"> Commande :'.$row["idcommande"]+'1'.'</option>';
                        }
                    }
                ?>
            </select>
            <input type="submit" class="btn btn-primary" value="valider" /> 
        </form>








                <p class="add">Ajouter une commande:</p>

                <form action="#" method="post">
                    <label>chose what you want:</label>
                    <input type="number" name="ball_id" id="ball_id" placeholder="chose what you want..." aria-describedby="defaultFormControlHelp" required/><br><br>
                    <label>chose how many you want: </label>
                    <input type="number" name="quantite" id="quantite" placeholder="chose how many you want..." aria-describedby="defaultFormControlHelp" required/><br><br> 
                    <input type="submit" value="buy" name="submit"class="buy"/>
                </form>













                <form action="#" method="post">
                    <p class="pword"> 
                    <span>paiement : </span><input type="number"  class="paiement" name="paiement" id="paiement" /> 
                    <input type="submit" value="valider"  class="btn btn-primary"/> </p>
                </form>








                <?php
                    $pieces = array(200, 100, 50, 20,10,5,2,1);
                    $paiement=0;
                    if(isset($_POST["paiement"]))
                    $paiement=$_POST["paiement"];
                    {
                        if($paiement<$somme)
                            echo "could you polease add some change.";
                        else{
                            $rest=$paiement-$somme;
                            echo $rest."Dh =";
                            for ($j=0 ; $j<count($pieces) ; $j++){
                                if($pieces[$j]<=$rest){
                                    $rest=$rest-$pieces[$j];
                                    echo $pieces[$j]."Dh -";
                                    $j=$j-1;
                                }  
                            }
                        }
                    }
                ?>
            </div>

        </div>










































<img src="imges1/foot.jpg" alt="decathlon image hahaha." width="1100"  margin-top="59">

<footer class="foochat"> 
    <div>
        <div class="infodec">
        <pre>What are the details of the Decathlon? Decathlon (retailer) - Wikipedia Decathlon (French pronunciation: 
[dekatlɔ̃]) is a French sporting goods retailer. With over 2,080 stores in 56 countries and regions (2023), 
it is the largest sporting goods retailer in the world.</pre>
        <pre>A key differentiator for Decathlon is its business model, which encompasses the entire
product lifecycle. They handle everything from design and testing to manufacturing and retailing of their 
own brands. On average, they introduce around 2,800 products each year.</pre></div>

        <h3 class="defoot">decathlon</h3><h5 style="font-family: Arial, Helvetica, sans-serif;color:lightgreen;">discover more on our website</h5><p style="font-size: 14Px;color:rgb(91, 97, 97);;">get the best experience, in searching for what you need, to buy online.</p>
        <br>
        
        
        <div style="margin: left 100px;text-align: center;">
            <pre>
                <div style="display: grid;grid-template-columns: 500PX 500PX;">
                    <div>
                        <ul>
                            <li><a href="#" class="footer-icons" style="color:rgb(94, 68, 68);">decathlon on data scince</a></li>
                            <li><a href="#" class="footer-icons" style="color:rgb(94, 68, 68);">decathlon on Facebook</a></li>
                            <li><a href="#" class="footer-icons" style="color:rgb(94, 68, 68);">decathlon on LinkedIn</a></li>
                        </ul>
                    </div>

                    <div>
                        <ul>
                            <li><a href="#" class="footer-icons" style="color:rgb(94, 68, 68);">decathlon  on YouTube</a></li>
                            <li><a href="#" class="footer-icons" style="color:rgb(94, 68, 68);">decathlon on Twitch</a></li>
                            <li><a href="#" class="footer-icons" style="color:rgb(94, 68, 68);">decathlon on TikTok</a></li>
                        </ul>
                    </div>
                </div>

            </pre>
        </div>
    
    

        <br>
        <span style="color:rgb(75, 185, 75);">© 2024 Decthlon, Inc.</span>
        <br>
        <a href="#" class="footer-icons" style="color:#333;">Terms</a><br>
        <a href="#" class="footer-icons" style="color:#333;">Privacy (Updated 08/2022)</a><br>
        <a href="#" class="footer-icons" style="color:#333;">Sitemap</a><br>
        <br>
        <span style="color:rgb(75, 185, 75);">What is new?</span>
    </div>
</footer>

</body>

</html>