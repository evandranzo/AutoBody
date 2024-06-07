<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, Initial-scale=1.0">
    <title>Add a Repair to the AutoBody Repair Shop database</title>
    <link rel="shortcut icon" href="https://csdb01.cs.edinboro.edu/~e873428d/style/car.ico">
    <link rel="stylesheet" href="https://csdb01.cs.edinboro.edu/~e873428d/style/css/styles.css">

<body>
    <h3>Add a Repair to the AutoBody Repair Shop database</h3>
    <?php
            $db_location = "localhost";
            $db_username = "e873428d";
            $db_password = "temppass";
            $db_database = "e873428d_RepairShop";
            
            $db_connection = mysqli_connect($db_location, $db_username, $db_password, $db_database) or die("Couldn't connect to the database.");

//INITIAL DROP DOWN TO GET RepairS
    echo "
    <form id='register' name='register' method='POST' action='AddRepair.php' onsubmit='return true'>
        <div class='container'>";
//CUSTOMER DROP DOWN


    ?>
    <div class="row">
        <div class="col-25">
            <label for="est_cost">Repair Description:</label>
        </div>
        <div class="col-75">
            <input type="text" id="description" name="description">
        </div>
    </div>
    <div class="row">
        <div class="col-25">
            <label for="time_required">Time Required:</label>
        </div>
        <div class="col-75">
            <input type="int" id="time_required" name="time_required">
        </div>
    </div>
    <div class="row">
        <div class="col-25">
            <label for="cost">Cost:</label>
        </div>
        <div class="col-75">
            <input type="int" id="cost" name="cost">
        </div>
    </div>
    <?php
        $result4=mysqli_query($db_connection, "SELECT * FROM Part") or die("Query from the drop down didn't work");
        
        echo"
        <div class='row'>
            <div class='col-25'>
                <label for='part'>Part: [NOT required, adds to Part_Repair]</label>
            </div>
            <div class='col-75'>
                <select id='partID' name='partID'>
                    <option value='--------'>---------</option>";
                        while($row=mysqli_fetch_array($result4))
                        {
                            echo "<option value='".$row["partID"]."'>".$row['partID']." ".$row['part_Name'].", $".$row['part_Price']."</option><br>";
                        }
        echo "  </select>
            </div>
        </div>";
    ?>
    <div class="row">
        <div class="col-25">
            <label for="quanity">Part Qty:</label>
        </div>
        <div class="col-75">
            <input type="int" id="quanity" name="quanity">
        </div>
    </div>
    <input type="submit" value="Add Repair">
    </form>


    <?php
    //FIRST SQL
        $sql="INSERT INTO Repair VALUES (NULL,'".
        $_POST['description']."', '".
        $_POST['time_required']."', '".
        $_POST['cost']."')";
        
        echo "<br><br>
            $sql
        <br><br>";
        // The actual insert here
        IF($_POST['cost'] != "")
        {
            mysqli_query($db_connection, $sql) or die("Insert didn't work!");
        }
    //SECOND SQL
        $rowSQL = mysqli_query($db_connection, "SELECT MAX( repairID ) AS max FROM `Repair`;" );
        $row = mysqli_fetch_array( $rowSQL );
        $largestNumber = $row['max'];

        $sql2="INSERT INTO Part_Repair VALUES ('".
        $_POST['partID']."','
        $largestNumber', '".
        $_POST['quanity']."')";

        echo "Second Sql<br>
        $sql2
        <br><br>";
        IF($_POST['quanity'] != "")
        {
            mysqli_query($db_connection, $sql2) or die("Insert didn't work!");
        }
    // Now display the table with the new repairs
        $repairTable = mysqli_query($db_connection, "SELECT * FROM Repair");
        
        echo "
            <table border='1'>
                <tr>
                <th>Repair ID</th>
                <th>Repair Description</th>
                <th>Time Required</th>
                <th>Cost</th>
                </tr>
                ";
        
                while ($row = mysqli_fetch_array($repairTable)) {
                    echo "<tr>";
                    echo "<td>" . $row["repairID"] . "</td>";
                    echo "<td>" . $row["description"] . "</td>";
                    echo "<td>" . $row["time_required"] . "</td>";
                    echo "<td>" . $row["cost"] . "</td>";
                    echo "</tr>";
                }
        
            echo "</table>";
        ?>

    <br>
    <a href="../">Back to the body shop page</a><br>
    <a href="https://csdb01.cs.edinboro.edu/~e873428d/">Back to my home page</a>
    </div>
</body>

</html>