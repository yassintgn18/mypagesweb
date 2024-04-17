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
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Document</title>
        <style>
            .aff {
                text-align: center;
            }
            .padd {
                padding-top: 40px;
                padding-bottom: 20px;

            }
        </style>
      
    </head>
    <body>
        <div>
            <h1 class='yas'>balls list:</h1>
            <table>
           
                <?php
                    $count = 0;
                    $sql = "SELECT * FROM `balls`";
                    $listballs = $conn->query($sql);

                    if ($listballs->num_rows > 0) {
                        while($row = $listballs->fetch_assoc()) {
                            if ($count % 4 == 0) {
                                // Start a new row for every third ball
                                echo '<tr>';
                            }
                            /*
                            echo '<td><img src="imges1/' . $row["id"] . '.png" width="130" height="100" /></td>';
                            echo '<td><h1>' . $row["ball _name"] . '</h1></td>';
                            echo '<td class="p"><h1>' . $row["price"] . '</h1></td>';*/


                            echo '<td>';
                                echo '<img src="imges1/' . $row["id"] . '.png" width="240" height="240" class="padd"/><br>';
                                echo '<h2 class="aff">' . $row["ball _name"] . '</h2>';
                                echo '<h3 class="aff">' . $row["price"] . '</h3>';
                            echo '</td>';

                              // Add empty space between td elements
                            echo '<td>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                            &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                            &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                            &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</td>';
                
                            $count++;
                
                            if ($count % 4 == 0) {
                                // End the row after every third ball
                                echo '</tr>';
                            }
                        }
                
                        // If the last row is not complete (i.e., not containing three balls), close the row
                        if ($count % 4 != 0) {
                            echo str_repeat('<td></td>', 3 - ($count % 3)); // Fill remaining cells if not a complete row
                            echo '</tr>';
                        }

                    }

                ?>
            </table>
        </div>
                
        
    </body>
</html>