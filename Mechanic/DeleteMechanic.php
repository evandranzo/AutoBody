<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, Initial-scale=1.0">
    <title>Delete a mechanic from the AutoBody Repair Shop database</title>
    <link rel="shortcut icon" href="https://csdb01.cs.edinboro.edu/~e873428d/style/car.ico">
    <link rel="stylesheet" href="https://csdb01.cs.edinboro.edu/~e873428d/style/css/styles.css">
</head>

<body>
    <h3>Delete a mechanic from the AutoBody Repair Shop database</h3>
    <?php
            $db_location = "localhost";
            $db_username = "e873428d";
            $db_password = "temppass";
            $db_database = "e873428d_RepairShop";
            
            $db_connection = mysqli_connect($db_location, $db_username, $db_password, $db_database) or die("Couldn't connect to the database");
            
            
            /** Make a drop down to show all the mechanics ******/
            echo "
            <form id='update' method='POST'>";
            $result=mysqli_query($db_connection, "SELECT * FROM Mechanic") or die("Query from the drop down didn't work");
            IF (ISSET($_POST["mechanicID"])) {
                $result2=mysqli_query($db_connection, "SELECT * FROM Mechanic WHERE mechanicID='".$_POST["mechanicID"]."'") or die("Query from the drop down didn't work");
            }
            echo"
            <div class='container'>
            <div class='row'>
                <div class='col-25'>
                    <label for='mechanic'>Select an Mechanic to update:</label>
                </div>
            <div class='col-75'>
                <select name='mechanicID' id='mechanicID' onchange='this.form.submit()'>";
                IF (ISSET($_POST["mechanicID"])) {
                    while($row=mysqli_fetch_array($result))
                    {
                        while($column=mysqli_fetch_array($result2))
                        {
                        echo "<option value='".$column["mechanicID"]."'>".$column['mechanicID']." ".$column['name']."</option>";
                        }
                        echo "<option value='".$row["mechanicID"]."'>".$row['mechanicID']." ".$row['name']."</option>";
                    }
                } else {
                    echo "<option value='--------'>---------</option>";   
                    while($row=mysqli_fetch_array($result))
                    {
                        echo "<option value='".$row["mechanicID"]."'>".$row['mechanicID']." ".$row['name']."</option>";
                    }
                }
            echo "
                </select>
            </div>
            </div>";
            
            $sql="SELECT * FROM Mechanic WHERE mechanicID='".$_POST["mechanicID"]."'";
            $result=mysqli_query($db_connection,$sql) or die ("Query to get the mechanic info didn't work");
            $row=mysqli_fetch_array($result);
            
            echo "
            <form id='update' name='update' method='POST' action='DeleteMechanic.php'>
                <div class='row'>
                    <div class='col-25'>
                    <label for='name'>Name:<br></label>
                    </div>
                    <div class='col-75'>
                    <input type='text' id='name' name='name' value='".$row['name']."'><br>
                    </div>
                </div>
                <div class='row'>
                    <div class='col-25'>
                    <label for='rate'>Rate:<br></label>
                    </div>
                    <div class='col-75'>
                    <input type='text' id='rate' name='rate' value='".$row['rate']."'><br>
                    </div>
                </div>
                <div class='row'>
                    <div class='col-25'>
                    <label for='Num_of_Jobs_Assigned'>Num of Jobs:<br></label>
                    </div>
                    <div class='col-75'>
                    <input type='text' id='Num_of_Jobs_Assigned' name='Num_of_Jobs_Assigned' value='".$row['Num_of_Jobs_Assigned']."'><br>
                </div>
            </div>
            <br>
            <input type='submit' value='Delete Mechanic'>
            </form>
            <br>";
            ?>
    <?php
            // Do delete here using the data from the form above 
            $sql="DELETE FROM Mechanic WHERE mechanicID = '".$_POST['mechanicID']."';";
            
            
            //The actual running of the delete query
            IF($_POST['name'] != "")
            {
                mysqli_query($db_connection, $sql) or die ("delete did not work");
            }
            
            ?>
    <a href="../">Back to the body shop page</a><br>
    <a href="https://csdb01.cs.edinboro.edu/~e873428d/">Back to my home page</a>
</body>

</html>