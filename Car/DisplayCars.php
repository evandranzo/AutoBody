<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, Initial-scale=1.0">
    <title>Display the Automobiles in the AutoBody Repair Shop database</title>
    <link rel="shortcut icon" href="https://csdb01.cs.edinboro.edu/~e873428d/style/car.ico">
    <link rel="stylesheet" href="https://csdb01.cs.edinboro.edu/~e873428d/style/css/styles.css">
</head>

<body>
    <h3>Display the Automobiles in the AutoBody Repair Shop database</h3>
    <?php
            $db_location = "localhost";
            $db_username = "e873428d";
            $db_password = "temppass";
            $db_database = "e873428d_RepairShop";
            
            $db_connection = mysqli_connect($db_location, $db_username, $db_password, $db_database) or die("Couldn't connect to the database.");
            
            $automobileTable = mysqli_query($db_connection, "SELECT * FROM Automobile") or die("Display query didn't work.");
            
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
            
            echo "</table>"
            
            ?>
    <br>
    <a href="../">Back to the body shop page</a><br>
    <a href="https://csdb01.cs.edinboro.edu/~e873428d/">Back to my home page</a>
</body>

</html>