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

       <title>decathlon</title>


    </head>

    <body>

        <h1 class="DECATHLON">DECATHLON</h1>

        <div> 
            <div class="div2">
                <nav>
                    <div class="hl">balls list :</div>
                        <ul>
                            <li><div class="search-container">
                                  
                                    <div class="search-icon"><img src="icons_for_css/search.svg" class="searchimg" alt=""></div>

                                    <div class="inputword">
                                        <input type="text" class="search-input" placeholder="Search...">
                                    </div>
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

        <form action="decathlon_style.php" method="GET">
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



        
        <p class="new_cammande">
            <a href="decathlon_style.php?idcommande=<?php echo 	$idcommande+1; ?>" class="aa" title="click here for anther commande"> Nouvelle commande</a>
        </p>

        
        <p class="add">Ajouter une commande:</p>

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
                    echo"<h1 class='yas'>sals balls:".$idcommande."</h1>";
                    echo"<table border=1>";
                    echo "<tr> <td><h3>delete </h3></td> <td><h3>ball_photo</h3></td> <td><h3>quantite</h3></td>  <td><h3>price</h3></td> </tr>";

                    $sql = "SELECT * FROM `sales` WHERE `idcommande` = ".$idcommande." ";
                    $salesballs = $conn->query($sql);
                    $somme=0;
                    
                    if ($salesballs->num_rows > 0) {
                        while($row = $salesballs->fetch_assoc()) {

                            $somme= $somme + $row["quantite"] * $row["price"];
                        
                            echo "<tr> <td><a   class='anull' href=decathlon_style.php?idannule=".$row["id"].">annuler</a></td>  <td><img src=imges1/".$row["id"].".png  width=\"250\" hight=\"100\"/></td> <td><h1>".$row["quantite"]."</h1></td> <td><h1>".$row["price"]."</h1></td></tr> ";
                        }
                    }
                    echo "<tr> <td> </td> <td><h2> Prix Total</h2></td> <td>      Q</td> <td><h2>".$somme."</h2></td> </tr> ";

                    echo "</table>";   
                ?>

                <form action="#" method="post">
                    <p lass="pword"> 
                    <span>paiement : </span><input type="number"  class="paiement" name="paiement" id="paiement" /> 
                    <input type="submit" value="valider"  class="btn btn-primary"/> </p>
                </form>

                <?php
                    $pieces = array(200, 100, 50, 20,10,5,2,1);
                    $paiement=0;
                    if(isset($_POST["paiement"])){
                        $paiement=$_POST["paiement"];
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