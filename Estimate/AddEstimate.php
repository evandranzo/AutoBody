<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, Initial-scale=1.0">
    <title>Add a Estimate to the AutoBody Repair Shop database</title>
    <link rel="shortcut icon" href="https://csdb01.cs.edinboro.edu/~e873428d/style/car.ico">
    <link rel="stylesheet" href="https://csdb01.cs.edinboro.edu/~e873428d/style/css/styles.css">

<body>
    <h3>Add a Estimate to the AutoBody Repair Shop database</h3>
    <?php
            $db_location = "localhost";
            $db_username = "e873428d";
            $db_password = "temppass";
            $db_database = "e873428d_RepairShop";
            
            $db_connection = mysqli_connect($db_location, $db_username, $db_password, $db_database) or die("Couldn't connect to the database.");

//INITIAL DROP DOWN TO GET ESTIMATES
    echo "
    <form id='register' name='register' method='POST' action='AddEstimate.php' onsubmit='return true'>
        <div class='container'>
            
        <form id='getdata' method='POST'>";
            $result=mysqli_query($db_connection, "SELECT * FROM Customer") or die("Query from the drop down didn't work");
        echo"    
        </form>";
//CUSTOMER DROP DOWN
    echo "
            <div class='row'>
            <div class='col-25'>
                <label for='automobile'>Customer:</label>
            </div>
            <div class='col-75'>
        <select name='customerID' id='customerID' onchange='this.form.submit()'>";
            IF ($_POST["customerID"]){
                echo "<option value='".$_POST["customerID"]."'>".$_POST['customerID']." ".$row['fName']." ".$row['lName']."</option>";

                while($row=mysqli_fetch_array($result))
                {
                    echo "<option value='".$row["customerID"]."'>".$row['customerID']." ".$row['fName']." ".$row['lName']."</option>";
                }
            } else {
                echo "
                <option value='--------'>---------</option>";
                while($row=mysqli_fetch_array($result))
                {
                    echo "<option value='".$row["customerID"]."'>".$row['customerID']." ".$row['fName']." ".$row['lName']."</option>";
                }
            }
            echo "
                </select>
            </div>
            </div>";
            
            $sql="SELECT * FROM Automobile WHERE customerID='".$_POST["customerID"]."'";

            $result=mysqli_query($db_connection,$sql) or die ("Query to get the automobile info didn't work");
            
            echo "
            <form id='update' name='update' method='POST' action='AddEstimate.php'>";
            
            echo"
            <div class='row'>
            <div class='col-25'>
                <label for='automobile'>Car:</label>
            </div>
            <div class='col-75'>
            <select name='carID' id='carID'>
            <option value='--------'>---------</option>";    
                while($row=mysqli_fetch_array($result))
                {
                    echo "<option value='".$row["carID"]."'>".$row['carID']." ".$row['make']." ".$row['model']."</option>";
                }
            
            echo "
                </select>
            </div>
            </div>";

            $result=mysqli_query($db_connection, "SELECT * FROM Mechanic") or die("Query from the drop down didn't work");
                    
            echo"
            <div class='row'>
                <div class='col-25'>
                    <label for='mechanic'>Mechanic:</label>
                </div>
                <div class='col-75'>
                    <select id='mechanicID' name='mechanicID'>
                        <option value='--------'>---------</option>";
                            while($row=mysqli_fetch_array($result))
                            {
                                echo "<option value='".$row["mechanicID"]."'>".$row['mechanicID']." ".$row['name']." ".$row['model']."</option><br>";
                            }
            echo "  </select>
                </div>
            </div>";
        ?>
    <div class="row">
        <div class="col-25">
            <label for="est_cost">Est Cost:</label>
        </div>
        <div class="col-75">
            <input type="text" id="est_cost" name="est_cost">
        </div>
    </div>
    <div class="row">
        <div class="col-25">
            <label for="date">Date:</label>
        </div>
        <div class="col-75">
            <input type="date" id="date" name="date">
        </div>
    </div>
    <br>
    <input type="submit" value="Add Estimate">
    <br><br>
    </form>


    <?php
            $sql="INSERT INTO Estimate VALUES (NULL,'".
            $_POST['mechanicID']."', '".
            $_POST['carID']."', '".
            $_POST['est_cost']."', '".
            $_POST['date']."')";
            
            echo "<br><br>
             $sql
            <br><br>";
            // The actual insert here
            IF($_POST['date'] != "")
            {
                mysqli_query($db_connection, $sql) or die("Insert didn't work!");
            }
            
            // Now display the table with the new estimates
            $estimateTable = mysqli_query($db_connection, "SELECT * FROM Estimate");
            
            echo "
                <table border='1'>
                    <tr>
                    <th>Estimate ID</th>
                    <th>Mechanic ID</th>
                    <th>Car ID</th>
                    <th>Est Cost</th>
                    <th>Date</th>
                    </tr>
                    ";
            
                    while ($row = mysqli_fetch_array($estimateTable)) {
                        echo "<tr>";
                        echo "<td>" . $row["estimateID"] . "</td>";
                        echo "<td>" . $row["mechanicID"] . "</td>";
                        echo "<td>" . $row["carID"] . "</td>";
                        echo "<td>" . $row["est_cost"] . "</td>";
                        echo "<td>" . $row["date"] . "</td>";
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