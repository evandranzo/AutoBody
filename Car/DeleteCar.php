<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, Initial-scale=1.0">
    <title>Delete an automobile from the AutoBody Repair Shop database</title>
    <link rel="shortcut icon" href="https://csdb01.cs.edinboro.edu/~e873428d/style/car.ico">
    <link rel="stylesheet" href="https://csdb01.cs.edinboro.edu/~e873428d/style/css/styles.css">
</head>

<body>
    <h3>Delete an automobile from the AutoBody Repair Shop database</h3>
    <?php
            $db_location = "localhost";
            $db_username = "e873428d";
            $db_password = "temppass";
            $db_database = "e873428d_RepairShop";
            
            $db_connection = mysqli_connect($db_location, $db_username, $db_password, $db_database) or die("Couldn't connect to the database");
            
            
            /** Make a drop down to show all the automobiles ******/
            echo "
            <form id='getdata' method='POST'>";

            $result=mysqli_query($db_connection, "SELECT * FROM Customer") or die("Query from the drop down didn't work");
            IF (ISSET($_POST["customerID"])) {
                $result2=mysqli_query($db_connection, "SELECT * FROM Customer WHERE customerID='".$_POST["customerID"]."'") or die("Query from the drop down didn't work");
                $result3=mysqli_query($db_connection, "SELECT * FROM Customer WHERE customerID<>'".$_POST["customerID"]."'") or die("Query from the drop down didn't work");
            }
            
            echo"
            <div class='container'>
            <div class='row'>
            <div class='col-25'>
                <label for='automobile'>Select a Customer:</label>
            </div>
            <div class='col-75'>
            <select name='customerID' id='customerID' onchange='this.form.submit()'>";
                IF (ISSET($_POST["customerID"])) {
                    while($row=mysqli_fetch_array($result3))
                    {
                        while($column=mysqli_fetch_array($result2))
                        {
                        echo "<option value='".$column["customerID"]."'>".$column['customerID']." ".$column['fName']." ".$column['lName']."</option>";
                        }
                        echo "<option value='".$row["customerID"]."'>".$row['customerID']." ".$row['fName']." ".$row['lName']."</option>";
                    }
                } else {
                    echo "<option value='--------'>---------</option>";   
                    while($row=mysqli_fetch_array($result))
                    {
                        echo "<option value='".$row["customerID"]."'>".$row['customerID']." ".$row['fName']." ".$row['lName']."</option>";
                    }
                }
            
            echo "
                </select>
            </div>
            </div>
            </form>";

            echo "
            <form id='update' name='update' method='POST'>";
                $sql="SELECT * FROM Automobile WHERE customerID='".$_POST["customerID"]."'";
                $result=mysqli_query($db_connection,$sql) or die ("Query to get the automobile info didn't work");
                IF (ISSET($_POST["carID"])) {
                    $result2=mysqli_query($db_connection, "SELECT * FROM Automobile WHERE carID='".$_POST["carID"]."'") or die("Query from the drop down didn't work");
                }

                echo"
                <div class='row'>
                    <div class='col-25'>
                        <label for='automobile'>Select an Automobile to delete:</label>
                    </div>
                <div class='col-75'>
                    <select name='carID' id='carID' onchange='this.form.submit()'>";    

                        IF (ISSET($_POST["carID"])) {
                            echo "<option value='".$_POST["carID"]."'>".$_POST['carID']." ".$column['make']." ".$column['model']."</option>";
                            while($row=mysqli_fetch_array($result))
                            {
                                echo "<option value='".$row["carID"]."'>".$row['carID']." ".$row['make']." ".$row['model']."</option>";
                            }
                        } else {
                            echo "<option value='--------'>---------</option>";   
                            while($row=mysqli_fetch_array($result))
                            {
                                echo "<option value='".$row["carID"]."'>".$row['carID']." ".$row['make']." ".$row['model']."</option>";
                            }
                        }
             
                    echo "
                        </select>
                    </div>
                    </div>";
            
            $sql="SELECT * FROM Automobile WHERE carID='".$_POST["carID"]."'";
            $result=mysqli_query($db_connection,$sql) or die ("Query to get the automobile info didn't work");
            $row=mysqli_fetch_array($result);
            
            echo "
            <form id='update' name='update' method='POST' action='DeleteCar.php'>
                    <div class='row'>
                        <div class='col-25'>
                        <label for='make'>Make:</label>
                        </div>
                        <div class='col-75'>
                        <input type='text' id='make' name='make' value='".$row['make']."'>
                        </div>
                    </div>
                    <div class='row'>
                        <div class='col-25'>
                        <label for='model'>Model:</label>
                        </div>
                        <div class='col-75'>
                        <input type='text' id='model' name='model' value='".$row['model']."'>
                        </div>
                    </div>
                    <div class='row'>
                        <div class='col-25'>
                        <label for='YEAR'>Year:</label>
                        </div>
                        <div class='col-75'>
                        <input type='text' id='YEAR' name='YEAR' value='".$row['YEAR']."'>
                        </div>
                    </div>
                <br>
                <input type='submit' value='Delete Automobile'>
            </form>
            <br>";

            // Do delete here using the data from the form above 
            $sql="DELETE FROM Automobile WHERE carID = '".$_POST['carID']."';";
            echo $sql;
            //The actual running of the delete query
            IF($_POST['model'] != "")
            {
                mysqli_query($db_connection, $sql) or die ("delete did not work");
            }
            
            ?>
    <a href="../">Back to the body shop page</a><br>
    <a href="https://csdb01.cs.edinboro.edu/~e873428d/">Back to my home page</a>
</body>

</html>