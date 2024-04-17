<?php
$d=0;
    include("header.html");

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
       <title>decathlon</title>

       <style>
            html {scroll-behavior: smooth;}

            body {
                background-color:rgb(13, 17, 23);
                margin: 0%;
                height: 10000PX;
                padding: 0PX; 
                color: rgb(47, 129, 247);
            }

            .hl {
                padding: 10px;
                padding-top: 0%;
                background-color: rgb(0, 19, 50);
                font-family: 'Verdana', Geneva, sans-serif;
                font-size: 15PX;
                border-top-left-radius: 10px;
                border-top-right-radius: 10px;
                color: rgb(206, 29, 255);
                text-shadow: 2PX 2PX 2PX black;
            }

            table {
                color: rgb(47, 129, 247);
            }

            .DECATHLON {
                text-align: center;
                color: #f5f5f5;
                font-family: serif;
                text-shadow: 4PX 4PX 4PX black;
                font-size: 50px;
                height: 70PX;
                padding-bottom: 0%;
                background-color: rgb(11, 14, 19);
            }

            .div2 {
                background-color: rgb(21, 28, 37);
                width: 150px;
                right: 0%; 
                height: 100%;
                border-radius: 5px;
                color: rgb(0, 137, 137);
                position: fixed;
                z-index: 1;
                margin-top: 0%;
                font-size: 19px;
                cursor: POINTER;
                border-color: hsl(322, 100%, 52%);
                margin: 0PX;
            }

            nav {
                border: 2px solid rgb(64, 64, 64);
                border-radius: 10px;
                max-width: 250PX;
                line-height: 200%;   
            }

            .nav {
                padding: 15px;
                background-color: yellow;
                font-family: 'Verdana', Geneva, sans-serif;
                font-size: 15PX;
                text-decoration: underline;
                height: 100%;
                padding-bottom: 25px;
                border-top-left-radius: 10px;
                border-top-right-radius: 10px;
                margin-top: 0px;
                font-family: Arial, Helvetica, sans-serif;
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
            }

            li a,li a:visited {
                text-decoration: none;
                color: rgb(34, 72, 100);
            }

            li a:hover, li a:focus {
                background-color: rgb(91, 97, 97);
                color: whitesmoke;
            }

            .new_cammande {
                background-color: #6e5494;
                text-align: center;
                font-size: 40PX;
                display: inline-block;
                margin-left: 400PX;
                border: 0.5 solid #6e5494;
                border-radius: 10PX;
                width: 500PX;
                height: 50PX;
                padding-top: 7PX; 
            }

            .aa {
                color: #fafafa;
                text-decoration: none;
                background-color: #6e5494;
                border: 1px solid #6e5494;
                border-radius: 5px;
                font-family: sans-serif; 
            }

            .new_cammande:hover {
                background-color: #765b9e;
                box-shadow: 0PX 20PX 50PX white;
            }

            .aa:hover {
                background-color: #765b9e;
            }

            .form-select {
                background-color: rgb(45, 79, 190);
                font-size: 30PX;
                border-radius: 5PX;
            }

            .btn-primary {
                border-color: rgb(109, 150, 175);
                border-radius: 2px;
                color: rgb(45, 79, 190);
                border-style: solid;
                border-width: 1PX;
                margin-right:3px;
                margin-left: 2px;
                padding-left: 18px;
                padding-right: 18px;
                padding-top: 6px;
                padding-block: 6px; 
                margin-top: 20px;  
                cursor: pointer;
                margin-left : 2PX;
                background-color: rgb(255, 255, 255);
                transition :opacity 2s; 
                transition: background-color 0.25s;
                transition: color 0.5s
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
                font-size: 20PX;
                text-decoration: underline;
                margin-left: 200PX;
                border: 0.5 solid blue;
                border-radius: 10PX;
            }

            label {
                background-color: rgb(0, 13, 35);
                border-radius: 14PX;
                border:0px;
                color: rgb(47, 129, 247);
                cursor: pointer;
                padding-top: 4px;
                padding-block: 4px;
                padding-left: 50px;
                padding-right: 50px;
                box-shadow: 2PX 2PX 7PX rgb(255, 0, 217);
                transition: opacity 0.15s;
                transition: box-shadow 1s;
                margin-left: 200PX;
                margin-bottom: 40px;
                font-size: 20px;
                text-align: center;
            }

            #codeArticle, #quantite,#ball_id {
                background-color:rgb(53, 88, 128);
                border: 3px solid rgb(0, 19, 50);
                border-radius: 15PX;
                height: 20px;
            }

            .buy {
                background-color: rgb(0, 39, 103);
                border-radius: 14PX;
                border:0px;
                color: rgb(0, 19, 50);
                cursor: pointer;
                padding-top: 3px;
                padding-block: 3px;
                padding-left: 150px;
                padding-right: 160px;
                box-shadow: 2PX 2PX 7PX rgb(255, 0, 217);
                transition: opacity 0.15s;
                transition: box-shadow 1s;
                margin-left: 300PX;
                margin-bottom: 40px;
                margin-top: 20px;
                font-size: 30px;
                text-align: center;
                transform: 1s;
            }

            .buy:hover {
            box-shadow: 6PX 4PX 7PX rgb(255, 46, 224);
            color: rgb(61, 142, 254);
            background-color: rgb(0, 13, 35);
            }

            h3 {
                color: rgb(38, 0, 70);
            }

            .yas {
                color: whitesmoke;
                background-color: rgb(17, 15, 54);
                width: 50%;
                border: 1px solid rgb(17, 15, 54);   
                border-radius: 5px;      
            }

            h3,h1 {
                color: rgb(61, 142, 254);
            }

            .search-container {
                background-color: #333;
                border: none;
                border-radius: 10PX;
                padding-top: 1PX;
            }

            .search-input {
                background-color: black;
                height: 30PX;
                border: 1px solid black;
                border-radius: 6PX;
            }

            header, footer {
                color: rgb(255, 255, 255);
                font-size: 30PX;
                height: 190PX;
                
            }

            footer {
                bottom: 0%;
                font-size: 20px;
                padding-right: 200px;
            }

            .fot {
                color: aqua;
                padding-left: 50px;
                padding-right: 50PX;
            }

            .fot:visited {
                color: red;
            }

            .paiement {
                background-color: rgb(0, 13, 35);
                border-radius: 14PX;
                border:0px;
                color: #6cc644;
                cursor: pointer;
                padding-top: 4px;
                padding-block: 4px;
                padding-left: 5px;
                padding-right: 5px;
                box-shadow: 2PX 2PX 7PX rgb(255, 0, 217);
                transition: opacity 0.15s;
                transition: box-shadow 1s;
                margin-left: 20PX;
                margin-bottom: 4px;
                font-size: 15px;  
            }

            span {
                font-size: 20px;
                color: greenyellow;
            }

            a {
                color: red;
            }
            .footer-icons {
                color: #333;
                text-decoration: none;

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

            .infodec {
                margin-left: 40PX;               
            }
            
          
       </style>
    </head>



    <body>
        <h1 class="DECATHLON">DECATHLON</h1>

        <div> 
            <div class="div2">
                <nav>
                    <div class="hl">balls list :</div>
                        <ul>
                            <li><div class="search-container">
                                    <input type="text" class="search-input" placeholder="Search...">
                                    <div class="search-icon"></div>
                                    </div>
                                
                            </li>
                            <li><a href="https://www.decathlon.ma/3982-football">football</a></li>
                            <li><a href="https://www.decathlon.ma/4253-mat%C3%A9riel-de-tennis">tennise</a></li>
                            <li><a href="https://www.decathlon.ma/5106-clubs-de-golf">golf</a></li>
                            <li><a href="https://www.decathlon.ma/4523-ballons-basketball">basketball</a></li>
                            <li><a href="https://www.decathlon.ma/5863-ballons-de-volleyball">volley</a></li>
                            <li><a href="https://www.decathlon.ma/4078-mat%C3%A9riels-et-%C3%A9quipements-randonn%C3%A9e-et-camping">trip</a></li>
                            <li><a href="https://www.decathlon.ma/4450-%C3%A9quipements-natation">swimming</a></li>
                            <li><a href="link1.html">About</a></li>
                        </ul>
                    </div>
                </nav>
            </div>
        </div>

        <!--form de selection quele commande pour affiche-->
        <form action="decathlon.php" method="GET">
            <select class="form-select" name="idcommande" id="idcommande" aria-label="Default select example">
                <?php
                    $sql = "SELECT distinct idcommande FROM `sales` ";
                    $listAchat = $conn->query($sql);
                    $somme=0;
                    if ($listAchat->num_rows > 0) {
                        while($row = $listAchat->fetch_assoc()) {
                            echo '<option value="'.$row["idcommande"].'"> Commande :'.$row["idcommande"]+'1'.'</option>';
                        }
                    }
                ?>
            </select>
            <input type="submit" class="btn btn-primary" value="valider" /> 
        </form>

        <p class="new_cammande">
            <a href="decathlon.php?idcommande=<?php echo $idcommande+1; ?>" class="aa" title="click here for anther commande"> Nouvelle commande</a>
            
        </p>

        
        <p class="add">Ajouter une commande:</p>

        <!--form de selection les articles-->
        <form action="#" method="post">
            <label>chose what you want:</label>
            <input type="number" name="ball_id" id="ball_id" placeholder="chose what you want..." aria-describedby="defaultFormControlHelp" required/><br><br>
            <label>chose how many you want: </label>
            <input type="number" name="quantite" id="quantite" placeholder="chose how many you want..." aria-describedby="defaultFormControlHelp" required/><br><br> 
            <input type="submit" value="buy" name="submit"class="buy"/>
        </form>


        
        <div style="display: grid;grid-template-columns: 480PX 540PX 80px;" class="the_big_div">
            <div>
                <?php
                    echo"<h1 class='yas'>sals balls:</h1>";
                    echo"<table border=1>";
                    echo "<tr> <td><h3>delete </h3></td> <td><h3>ball_photo</h3></td> <td><h3>quantite</h3></td>  <td><h3>price</h3></td> </tr>";

                    $sql = "SELECT * FROM `sales` WHERE `idcommande` = ".$idcommande." ";
                    $salesballs = $conn->query($sql);
                    $somme=0;
                    
                    if ($salesballs->num_rows > 0) {
                        while($row = $salesballs->fetch_assoc()) {

                            $somme= $somme + $row["quantite"] * $row["price"];
                        
                            echo "<tr> <td><a  href=decathlon_style.php?idannule=".$row["id"].">annuler</a></td>  <td><img src=imges1/".$row["id"].".png  width=\"250\" hight=\"100\"/></td> <td><h1>".$row["quantite"]."</h1></td> <td><h1>".$row["price"]."</h1></td></tr> ";
                        }
                    }
                    echo "<tr> <td> </td> <td><h2> Prix Total</h2></td> <td>      Q</td> <td><h2>".$somme."</h2></td> </tr> ";

                    echo "</table>";   
                ?>

                <!--form de paiement-->
                <form action="#" method="post">
                    <p lass="pword"> 
                    <span>paiement : </span><input type="number"  class="paiement" name="paiement" id="paiement" /> 
                    <input type="submit" value="valider"  class="btn btn-primary"/> </p>
                </form>

                <!--affichage de change-->
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


            <!--affichage de les articles-->
            <div>
                <?php
                    echo"<h1 class='yas'>balls list:</h1>";

                    echo '<table border=1 class="table">';
                    echo "<tr> <td><h1>balls images</h1></td> <td><h1>ball name</h1></td> <td><h1>price</h1></td> ";

                    $sql = "SELECT * FROM `balls`";
                    $listballs = $conn->query($sql);
                    //echo $sql;
                    if ($listballs->num_rows > 0) {
                
                        while($row = $listballs->fetch_assoc()) {
                    echo '<tr> <td><img src=imges1/'.$row["id"].'.png width="400" hight="150" /></td> <td><h1>'.$row["ball _name"].'</h1></td> <td><h1>'.$row["price"].'</h1></td> </tr> ';
                        }
                    }
                    echo "</table>";
                ?>
                
            </div>

        </div>
      

            <img src="imges1/foot.jpg" alt="decathlon image hahaha." width="999"  margin-top="59">

            <footer class="foochat"> 
                <div>
                    <div class="infodec">
                    <pre>What are the details of the Decathlon? Decathlon (retailer) - Wikipedia Decathlon (French pronunciation: 
[dekatlɔ̃]) is a French sporting goods retailer. With over 2,080 stores in 56 countries and regions (2023), 
it is the largest sporting goods retailer in the world.</pre>
                    <pre>A key differentiator for Decathlon is its business model, which encompasses the entire
product lifecycle. They handle everything from design and testing to manufacturing and retailing of their 
own brands. On average, they introduce around 2,800 products each year.</pre></div>

                    <h3 class="defoot">decathlon</h3><h5 style="font-family: Arial, Helvetica, sans-serif;">discover more on our website</h5><p style="font-size: 14Px;color:rgb(91, 97, 97);;">get the best experience, in searching for what you need, to buy online.</p>
                    <br>
                    
                    
                    <div style="margin: left 100px;text-align: center;">
                        <pre>
                            <div style="display: grid;grid-template-columns: 500PX 500PX;">
                                <div>
                                    <ul>
                                        <li><a href="#" class="footer-icons">decathlon on data scince</a></li>
                                        <li><a href="#" class="footer-icons">decathlon on Facebook</a></li>
                                        <li><a href="#" class="footer-icons">decathlon on LinkedIn</a></li>
                                    </ul>
                                </div>

                                <div>
                                    <ul>
                                        <li><a href="#" class="footer-icons">decathlon  on YouTube</a></li>
                                        <li><a href="#" class="footer-icons">decathlon on Twitch</a></li>
                                        <li><a href="#" class="footer-icons">decathlon on TikTok</a></li>
                                    </ul>
                                </div>
                            </div>

                        </pre>
                    </div>
                
                

                    <br>
                    <span>© 2024 Decthlon, Inc.</span>
                    <br>
                    <a href="#" class="footer-icons">Terms</a><br>
                    <a href="#" class="footer-icons">Privacy (Updated 08/2022)</a><br>
                    <a href="#" class="footer-icons">Sitemap</a><br>
                    <br>
                    <span>What is new?</span>
                </div>
            </footer>


    </body>
</html>