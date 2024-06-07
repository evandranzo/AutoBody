<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, Initial-scale=1.0">
    <title>Add an automobile to the AutoBody Repair Shop database</title>
    <link rel="shortcut icon" href="https://csdb01.cs.edinboro.edu/~e873428d/style/car.ico">
    <link rel="stylesheet" href="https://csdb01.cs.edinboro.edu/~e873428d/style/css/styles.css">
</head>

<body>
    <h3>Add an automobile to the AutoBody Repair Shop database</h3>
    <?php
            $db_location = "localhost";
            $db_username = "e873428d";
            $db_password = "temppass";
            $db_database = "e873428d_RepairShop";
            
            $db_connection = mysqli_connect($db_location, $db_username, $db_password, $db_database) or die("Couldn't connect to the database.");
            ?>
    <form id="register" name="register" method="POST" action="AddCar.php" onsubmit="return true">
        <div class="container">
            <?php
                    $result2=mysqli_query($db_connection, "SELECT * FROM Customer") or die("Query from the drop down didn't work");
                    
                    echo"
                    <div class='row'>
                        <div class='col-25'>
                            <label for='customer'>Customer:</label>
                        </div>
                        <div class='col-75'>
                            <select id='customerID' name='customerID'>
                                <option value='--------'>---------</option>";
                                    while($row=mysqli_fetch_array($result2))
                                    {
                                        echo "<option value='".$row["customerID"]."'>".$row['customerID']." ".$row['fName']." ".$row['lName']."</option><br>";
                                    }
                    echo "  </select>
                        </div>
                    </div>";
                    ?>
            <div class="row">
                <div class="col-25">
                    <label for="make">Make:</label>
                </div>
                <div class="col-75">
                    <input type="text" id="make" name="make">
                </div>
            </div>
            <div class="row">
                <div class="col-25">
                    <label for="model">Model:</label>
                </div>
                <div class="col-75">
                    <input type="text" id="model" name="model">
                </div>
            </div>
            <div class="row">
                <div class="col-25">
                    <label for="YEAR">Year:</label>
                </div>
                <div class="col-75">
                    <input type="text" id="YEAR" name="YEAR">
                </div>
            </div>
            <br>
            <input type="submit" value="Add Car">
            <br><br>
    </form>
    <?php
            $sql="INSERT INTO Automobile VALUES (NULL,'".
            $_POST['customerID']."', '".
            $_POST['make']."', '".
            $_POST['model']."', '".
            $_POST['YEAR']."')";
            
            echo $sql;
            
            // The actual insert here
            IF($_POST['model'] != "")
            {
                mysqli_query($db_connection, $sql) or die("Insert didn't work!");
            }
            
            // Now display the table with the new Automobiles
            $automobileTable = mysqli_query($db_connection, "SELECT * FROM Automobile");
            
            echo "
                <table border='1'>
                    <tr>
                    <th>Car ID</th>
                    <th>Customer ID</th>
                    <th>Make</th>
                    <th>Model</th>
                    <th>Year</th>
                    </tr>
                    ";
            
                while ($row = mysqli_fetch_array($automobileTable)) {
                    echo "<tr>";
                    echo "<td>" . $row["carID"] . "</td>";
                    echo "<td>" . $row["customerID"] . "</td>";
                    echo "<td>" . $row["make"] . "</td>";
                    echo "<td>" . $row["model"] . "</td>";
                    echo "<td>" . $row["YEAR"] . "</td>";
                    echo "</tr>";
                }
                echo "</table>";
            ?>
    <br>
    <a href="../">Back to the body shop page</a><br>
    <a href="https://csdb01.cs.edinboro.edu/~e873428d/">Back to my home page</a>
    </div>
    <?php
	$opts = array('http' =>
		array(
			'method' => 'GET',
			'content' => $postdata
		)
	);
	$apiURL = "https://vpic.nhtsa.dot.gov/api/vehicles/GetModelsForMakeId/440?format=json";
	$context = stream_context_create($opts);
	$fp = fopen($apiURL, 'rb', false, $context);
	if(!$fp)
	{
		echo "in first if";
	}
	$response = @stream_get_contents($fp);
	if($response == false)
	{
		echo "in second if";
	}
	echo $response;
?>

    <?php
	$postdata = http_build_query(
		array(
				'format' => 'json',
				'data' => 'JF1VA1B63H9801531'
			)
	);
	$opts = array('http' =>
		array(
			'method' => 'POST',
			'content' => $postdata
		)
	);
	$apiURL = "https://vpic.nhtsa.dot.gov/api/vehicles/DecodeVINValuesBatch/";
	$context = stream_context_create($opts);
	$fp = fopen($apiURL, 'rb', false, $context);
	if(!$fp)
	{
		echo "in first if";
	}
	$response = @stream_get_contents($fp);
	if($response == false)
	{
		echo "in second if";
	}
	echo $response;
?>
</body>

</html>