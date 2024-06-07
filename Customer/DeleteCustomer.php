<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, Initial-scale=1.0">
    <title>Delete a customer from the AutoBody Repair Shop database</title>
    <link rel="shortcut icon" href="https://csdb01.cs.edinboro.edu/~e873428d/style/car.ico">
    <link rel="stylesheet" href="https://csdb01.cs.edinboro.edu/~e873428d/style/css/styles.css">
</head>

<body>
    <h3>Delete a customer from the AutoBody Repair Shop database</h3>
    <?php
            $db_location = "localhost";
            $db_username = "e873428d";
            $db_password = "temppass";
            $db_database = "e873428d_RepairShop";
            
            $db_connection = mysqli_connect($db_location, $db_username, $db_password, $db_database) or die("Couldn't connect to the database");
            
            /** Make a drop down to show all the customers ******/
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
                        <label for='customer'>Select a Customer to delete:</label>
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
            </div>";
            
            $sql="SELECT * FROM Customer WHERE customerID='".$_POST["customerID"]."'";
            $result=mysqli_query($db_connection,$sql) or die ("Query to get the customer info didn't work");
            $row=mysqli_fetch_array($result);
            
            echo "
            <form id='update' name='update' method='POST' action='DeleteCustomer.php'>
            <div class='row'>
                <div class='col-25'>
                    <label for='fname'>First Name:<br></label>
                </div>
                <div class='col-75'>
                    <input type='text' id='fName' name='fName' value='".$row['fName']."'><br>
                </div>
            </div>
            <div class='row'>
                <div class='col-25'>
                    <label for='lName'>Last Name:<br></label>
                </div>
                <div class='col-75'>
                    <input type='text' id='lName' name='lName' value='".$row['lName']."'><br>
                </div>
            </div>
            <div class='row'>
                <div class='col-25'>
                    <label for='adress'>Address:<br></label>
                </div>
                <div class='col-75'>
                    <input type='text' id='adress' name='adress' value='".$row['adress']."'><br>
                </div>
            </div>
            <div class='row'>
                <div class='col-25'>
                    <label for='phone'>Phone number:<br></label>
                </div>
                <div class='col-75'>
                    <input type='text' id='phone' name='phone' value='".$row['phone']."'><br>
                </div>
            </div>
            <br>
            <input type='submit' value='Delete Customer'>
            </form>
            <br>";

            // Do delete here using the data from the form above 
            $sql="DELETE FROM Customer WHERE customerID = '".$_POST['customerID']."';";
            
            //The actual running of the delete query
            IF($_POST['lName'] != "")
            {
                mysqli_query($db_connection, $sql) or die ("delete did not work");
            }
            
            ?>
    <a href="../">Back to the body shop page</a><br>
    <a href="https://csdb01.cs.edinboro.edu/~e873428d/">Back to my home page</a>
</body>

</html>