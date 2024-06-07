<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, Initial-scale=1.0">
    <title>Add a Job to the AutoBody Repair Shop database</title>
    <link rel="shortcut icon" href="https://csdb01.cs.edinboro.edu/~e873428d/style/car.ico">
    <link rel="stylesheet" href="https://csdb01.cs.edinboro.edu/~e873428d/style/css/styles.css">

<body>
    <h3>Add a Job to the AutoBody Repair Shop database</h3>
    <?php
            $db_location = "localhost";
            $db_username = "e873428d";
            $db_password = "temppass";
            $db_database = "e873428d_RepairShop";
            
            $db_connection = mysqli_connect($db_location, $db_username, $db_password, $db_database) or die("Couldn't connect to the database.");

//CUSTOMER
        echo"
        <form id='register' name='register' method='POST' action='AddJob.php' onsubmit='return true'>
        <div class='container'>
     
        <form id='getdata' method='POST'>";
            $result=mysqli_query($db_connection, "SELECT * FROM Customer") or die("Query from the drop down didn't work");
        echo"    
        </form>";
        IF ($_POST["customerID"]){
            $result2=mysqli_query($db_connection, "SELECT * FROM Customer WHERE customerID='".$_POST["customerID"]."'") or die("Query from the drop down didn't work");
        }
    echo "
            <div class='row'>
            <div class='col-25'>
                <label for='automobile'>Customer:</label>
            </div>
            <div class='col-75'>
        <select name='customerID' id='customerID' onchange='this.form.submit()'>";
            IF ($_POST["customerID"]){
                $column=mysqli_fetch_array($result2);
                    echo "<option value='".$column["customerID"]."'>".$column['customerID']." ".$column['fName']." ".$column['lName']."</option>";
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
////////////////////////////////////////////////////////////////
            $sql="SELECT * FROM Automobile WHERE customerID='".$_POST["customerID"]."'";
            $result6=mysqli_query($db_connection,$sql) or die ("Query to get the automobile info didn't work");
            
            echo "
            <form id='update' name='update' method='POST' action='AddJob.php'>";
            
            echo"
            <div class='row'>
            <div class='col-25'>
                <label for='automobile'>Car:</label>
            </div>
            <div class='col-75'>
            <select name='carID' id='carID'>
            <option value='--------'>---------</option>";    
            //IF $_POST[cust_ID] is not blank
                while($row=mysqli_fetch_array($result6))
                {
                    echo "<option value='".$row["carID"]."'>".$row['carID']." ".$row['make']." ".$row['model']."</option>";
                }
            
            echo "
                </select>
            </div>
            </div>";
//MECHANIC DROP DOWN
            $result4=mysqli_query($db_connection, "SELECT * FROM Mechanic") or die("Query from the drop down didn't work");
            
            echo"
            <div class='row'>
                <div class='col-25'>
                    <label for='mechanic'>Mechanic:</label>
                </div>
                <div class='col-75'>
                    <select id='mechanicID' name='mechanicID'>
                        <option value='--------'>---------</option>";
                            while($row=mysqli_fetch_array($result4))
                            {
                                echo "<option value='".$row["mechanicID"]."'>".$row['mechanicID']." ".$row['name']." ".$row['model']."</option><br>";
                            }
            echo "  </select>
                </div>
            </div>";
//ESTIMATE DROP DOWN
            $result5=mysqli_query($db_connection, "SELECT * FROM Estimate") or die("Query from the drop down didn't work");
            
            echo"
            <div class='row'>
                <div class='col-25'>
                    <label for='estimate'>Estimate:</label>
                </div>
                <div class='col-75'>
                    <select id='estimateID' name='estimateID'>
                        <option value='--------'>---------</option>";
                            while($row=mysqli_fetch_array($result5))
                            {
                                echo "<option value='".$row["estimateID"]."'>".$row['estimateID']." ".$row['name']." ".$row['model']."</option><br>";
                            }
            echo "  </select>
                </div>
            </div>";
//REPAIR DROP DOWN
            $result5=mysqli_query($db_connection, "SELECT * FROM Repair") or die("Query from the drop down didn't work");
            
            echo"
            <div class='row'>
                <div class='col-25'>
                    <label for='repair'>Repair:</label>
                </div>
                <div class='col-75'>
                    <select id='repairID' name='repairID'>
                        <option value='--------'>---------</option>";
                            while($row=mysqli_fetch_array($result5))
                            {
                                echo "<option value='".$row["repairID"]."'>".$row['repairID']." ".$row['description']." ".$row['time_required']." hours,  $".$row['cost']."</option><br>";
                            }
            echo "  </select>
                </div>
            </div>";
        ?>
    <div class="row">
        <div class="col-25">
            <label for="date">Date Started:</label>
        </div>
        <div class="col-75">
            <input type="date" id="date" name="date">
        </div>
    </div>
    <div class="row">
        <div class="col-25">
            <label for="date_completed">Date Completed: [can be null]</label>
        </div>
        <div class="col-75">
            <input type="date" id="date_completed" name="date_completed">
        </div>
    </div>
    <br>
    **to add multiple repairs, leave all fields blank except for Repair then hit submit**[adds to the highest job
    pk]<br>
    <input type="submit" value="Add Job">
    <br><br>
    </form>


    <?php
//FIRST SQL
    IF ($_POST["date_completed"]){
        $tmpNull = $_POST["date_completed"];
        $a = "'";
        $tmpNull = $a.$tmpNull.$a;
    } ELSE {
        $tmpNull = "NULL";
    }
    
    $sql="INSERT INTO Job VALUES (NULL, '".
    $_POST['carID']."', '".
    $_POST['mechanicID']."', '".
    $_POST['estimateID']."', '".
    $_POST['date']."', 
    $tmpNull)";
    echo "<br><br>First SQL<br>
             $sql
            <br><br>";
            // The actual insert here
            IF($_POST['date'] != "")
            {
                mysqli_query($db_connection, $sql) or die("Insert didn't work!");
            }

//SECOND SQL
            $rowSQL = mysqli_query($db_connection, "SELECT MAX( jobID ) AS max FROM `Job`;" );
            $row = mysqli_fetch_array( $rowSQL );
            $largestNumber = $row['max'];

            $sql2="INSERT INTO Repair_Job VALUES ('".
            $_POST['repairID']."','
            $largestNumber')";

            echo "Second Sql<br>
            $sql2
            <br><br>";
            IF($_POST['repairID'] != "")
            {
                mysqli_query($db_connection, $sql2) or die("Insert didn't work!");
            }
// Now display the table with jobs
            $jobTable = mysqli_query($db_connection, "SELECT * FROM Job");
            
            echo "
                <table border='1'>
                    <tr>
                    <th>Job ID</th>
                    <th>Car ID</th>
                    <th>Mechanic ID</th>
                    <th>Estimate ID</th>
                    <th>Date</th>
                    <th>Date Completed</th>
                    </tr>
                    ";
            
                    while ($row = mysqli_fetch_array($jobTable)) {
                        echo "<tr>";
                        echo "<td>" . $row["jobID"] . "</td>";
                        echo "<td>" . $row["carID"] . "</td>";
                        echo "<td>" . $row["mechanicID"] . "</td>";
                        echo "<td>" . $row["estimateID"] . "</td>";
                        echo "<td>" . $row["date"] . "</td>";
                        echo "<td>" . $row["date_completed"] . "</td>";
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