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
    <title>Balls List</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f4f4f4;
            margin: 0;
            padding: 20px;
        }
        .container {
            max-width: 800px;
            margin: 0 auto;
            background-color: #fff;
            padding: 20px;
            border-radius: 8px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        }
        .table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 20px;
        }
        .table th, .table td {
            padding: 10px;
            text-align: left;
            border-bottom: 1px solid #ddd;
        }
        .table th {
            background-color: #f2f2f2;
        }
        .table img {
            max-width: 100%;
            height: auto;
        }
    </style>
</head>
<body>
    <div class="container">
        <h1 class='yas'>Balls List:</h1>
        <table class="table">
            <thead>
                <tr>
                    <th>Ball Image</th>
                    <th>Ball Name</th>
                    <th>Price</th>
                </tr>
            </thead>
            <tbody>
                <?php
                $counter = 0;
                // Your PHP code here (fetching and displaying data from the database)
              

        
     
        $sql = "SELECT * FROM `balls`";
        $listballs = $conn->query($sql);
        //echo $sql;
        if ($listballs->num_rows > 0) {
            while($row = $listballs->fetch_assoc()) {
                if ($counter % 3 == 0) {
                    // Start a new row after every third ball
                    echo "<tr>";
                }
                echo '<td><img src="images/'.$row["id"].'.png" width="150" height="150" /></td>';
                echo '<td>'.$row["ball _name"].'</td>';
                echo '<td>'.$row["price"].'</td>';
                $counter++;
                if ($counter % 3 == 0) {
                    // Close the row after every third ball
                    echo "</tr>";
                }
            }
            if ($counter % 3 != 0) {
                echo "</tr>";
            }
        }
      
                ?>
            </tbody>
        </table>
    </div>
</body>
</html>




<!--
<div>
    
    <?php
    /*
        echo"<h1 class='yas'>balls list:</h1>";

        echo '<table border=1 class="table">';
        echo "<tr> <td><h1>balls images</h1></td> <td><h1>ball name</h1></td> <td><h1>price</h1></td> ";

        $sql = "SELECT * FROM `balls`";
        $listballs = $conn->query($sql);
        //echo $sql;
        if ($listballs->num_rows > 0) {
            while($row = $listballs->fetch_assoc()) {
                echo '<tr> <td><img src=imges1/'.$row["id"].'.png width="520" height="130" /></td> <td><h1>'.$row["ball _name"].'</h1></td> <td><h1>'.$row["price"].'</h1></td> </tr> ';
            }
        }
        echo "</table>";*/
    ?>
    
</div>
    -->
