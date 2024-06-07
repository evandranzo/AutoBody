<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, Initial-scale=1.0">
    <title>Update an automobile in the AutoBody Repair Shop database</title>
    <link rel="shortcut icon" href="https://csdb01.cs.edinboro.edu/~e873428d/style/car.ico">
    <link rel="stylesheet" href="https://csdb01.cs.edinboro.edu/~e873428d/style/css/styles.css">
</head>

<body>
    <h3>Update an automobile in the AutoBody Repair Shop database</h3>
    <?php
        $db_location = "localhost";
        $db_username = "e873428d";
        $db_password = "temppass";
        $db_database = "e873428d_RepairShop";

        $db_connection = mysqli_connect($db_location, $db_username, $db_password, $db_database) or die("Couldn't connect to the database.");
///////////////////////////////////////////////////////////////////////

echo "
<form id='getdata' method='POST'>";
    $result=mysqli_query($db_connection, "SELECT * FROM Customer") or die("Query from the drop down didn't work");

    echo"
    <div class='container'>
    <div class='row'>
        <div class='col-25'>
            <label for='automobile'>Select a Customer:</label>
        </div>
    <div class='col-75'>
        <select name='customerID' id='customerID' onchange='this.form.submit()'>
        <option value='--------'>---------</option>";    
            while($row=mysqli_fetch_array($result))
            {
                echo "<option value='".$row["customerID"]."'>".$row['customerID']." ".$row['fName']." ".$row['lName']."</option>";
            }
 
        echo "
            </select>
        </div>
        </div>
</form>";

/////////////////////////////////////////////////
    $result=mysqli_query($db_connection,"SELECT * FROM Automobile WHERE customerID='".$_POST["customerID"]."'") or die ("Query to get the automobile info didn't work");
    IF (ISSET($_POST["carID"])) {
        $result2=mysqli_query($db_connection, "SELECT * FROM Automobile WHERE carID='".$_POST["carID"]."'") or die("Query from the drop down didn't work");
    }
    echo "
    <form id='update' name='update' method='POST'>";

    echo"
    <div class='row'>
        <div class='col-25'>
            <label for='automobile'>Select an Automobile to update:</label>
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

////////////////////////////////////////
    $sql="SELECT * FROM Automobile WHERE carID='".$_POST["carID"]."'";
    $result=mysqli_query($db_connection,$sql) or die ("Query to get the automobile info didn't work");
    $row=mysqli_fetch_array($result);
   
    echo "
    <form id='update' name='update' method='POST' action='UpdateCar.php'>
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
        <input type='submit' value='Update Automobile'>
    </form>
    ";

// Do update here using the data from the form above 
$sql="UPDATE Automobile SET
make = '".$_POST['make']."',
model = '".$_POST['model']."',
YEAR = '".$_POST['YEAR']."'
WHERE carID = '".$_POST['carID']."';"
;

echo $sql;

//The actual running of the update query
IF($_POST['make'] != "")
{
    mysqli_query($db_connection, $sql) or die ("Update did not work");
}

?>
    <br>
    <a href="../">Back to the body shop page</a><br>
    <a href="https://csdb01.cs.edinboro.edu/~e873428d/">Back to my home page</a>
</body>

</html>