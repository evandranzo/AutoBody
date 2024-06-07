<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, Initial-scale=1.0">
    <title>Delete a estimate from the AutoBody Repair Shop database</title>
    <link rel="shortcut icon" href="https://csdb01.cs.edinboro.edu/~e873428d/style/car.ico">
    <link rel="stylesheet" href="https://csdb01.cs.edinboro.edu/~e873428d/style/css/styles.css">
</head>

<body>
    <h3>Delete a estimate from the AutoBody Repair Shop database</h3>
    <?php
            $db_location = "localhost";
            $db_username = "e873428d";
            $db_password = "temppass";
            $db_database = "e873428d_RepairShop";
            
            $db_connection = mysqli_connect($db_location, $db_username, $db_password, $db_database) or die("Couldn't connect to the database");
            
            
            /** Make a drop down to show all the estimates ******/
            echo "
            <form id='getdata' method='POST'>";
            $result=mysqli_query($db_connection, "SELECT * FROM Estimate") or die("Query from the drop down didn't work");
            
            echo"
            <div class='container'>
            <div class='row'>
                <div class='col-25'>
                    <label for='estimate'>Select a Estimate to delete:</label>
                </div>
            <div class='col-75'>
            <select name='estimateID' id='estimateID' onchange='this.form.submit()'>
            <option value='--------'>---------</option>";
            
            while($row=mysqli_fetch_array($result))
            {
                echo "<option value='".$row["estimateID"]."'>".$row['estimateID']." ".$row['name']." ".$row['rate']."</option>";
            }
            
            echo "
            </select>
            </div>
            </div>
            </form>";
            
echo "
<form id='update' name='update' method='POST' action='DeleteEstimate.php'>";
            $sql="SELECT * FROM Estimate WHERE estimateID='".$_POST["estimateID"]."'";
            $result=mysqli_query($db_connection,$sql) or die ("Query to get the estimate info didn't work");
            $row=mysqli_fetch_array($result);

            echo "
                <div class='row'>
                    <div class='col-25'>
                    <label for='estimateID'>Estimate ID:</label>
                    </div>
                    <div class='col-75'>
                    <input type='text' id='estimateID' name='estimateID' value='".$row['estimateID']."'>
                    </div>
                </div>
                <div class='row'>
                    <div class='col-25'>
                    <label for='carID'>Car ID:</label>
                    </div>
                    <div class='col-75'>
                    <input type='text' id='carID' name='carID' value='".$row['carID']."'>
                    </div>
                </div>
                <div class='row'>
                    <div class='col-25'>
                    <label for='mechanicID'>Mechanic ID:</label>
                    </div>
                    <div class='col-75'>
                    <input type='text' id='mechanicID' name='mechanicID' value='".$row['mechanicID']."'>
                    </div>
                </div>
                <div class='row'>
                    <div class='col-25'>
                    <label for='estimateID'>Estimate ID:</label>
                    </div>
                    <div class='col-75'>
                    <input type='text' id='estimateID' name='estimateID' value='".$row['estimateID']."'>
                    </div>
                </div>
                <div class='row'>
                    <div class='col-25'>
                        <label for='est_cost'>Est Cost:</label>
                    </div>
                    <div class='col-75'>
                        <input type='text' id='est_cost' name='est_cost' value='".$row['est_cost']."'>
                    </div>
                </div>
                <div class='row'>
                    <div class='col-25'>
                        <label for='date'>Date:</label>
                    </div>
                    <div class='col-75'>
                        <input type='date' id='date' name='date' value='".$row['date']."'>
                    </div>
                </div>
                <br>
                <input type='submit' value='Delete Estimate'>
            </form>
            <br>";
            ?>
    <?php
            // Do delete here using the data from the form above 
            $sql="DELETE FROM Estimate WHERE estimateID = '".$_POST['estimateID']."';";
            
            //The actual running of the delete query
            IF($_POST['mechanicID'] != "")
            {
                mysqli_query($db_connection, $sql) or die ("delete did not work");
            }
            
            ?>
    <a href="../">Back to the body shop page</a><br>
    <a href="https://csdb01.cs.edinboro.edu/~e873428d/">Back to my home page</a>
</body>

</html>