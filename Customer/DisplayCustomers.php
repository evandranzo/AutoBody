<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, Initial-scale=1.0">
    <title>Display the Customers in the AutoBody Repair Shop database</title>
    <link rel="shortcut icon" href="https://csdb01.cs.edinboro.edu/~e873428d/style/car.ico">
    <link rel="stylesheet" href="https://csdb01.cs.edinboro.edu/~e873428d/style/css/styles.css">
</head>

<body>
    <h3>Display the Customers in the AutoBody Repair Shop database</h3>
    <?php
            $db_location = "localhost";
            $db_username = "e873428d";
            $db_password = "temppass";
            $db_database = "e873428d_RepairShop";
            
            $db_connection = mysqli_connect($db_location, $db_username, $db_password, $db_database) or die("Couldn't connect to the database.");
            
            $customerTable = mysqli_query($db_connection, "SELECT * FROM Customer") or die("Display query didn't work.");
            
            echo "
            <table border='1'>
                <tr>
                <th>Customer ID</th>
                <th>First Name</th>
                <th>Last Name</th>
                <th>adress</th>
                <th>phone</th>
                </tr>
                ";
                while ($row = mysqli_fetch_array($customerTable)) {
                    echo "<tr>";
                    echo "<td>" . $row["customerID"] . "</td>";
                    echo "<td>" . $row["fName"] . "</td>";
                    echo "<td>" . $row["lName"] . "</td>";
                    echo "<td>" . $row["adress"] . "</td>";
                    echo "<td>" . $row["phone"] . "</td>";
                    echo "</tr>";
                }
            echo "</table>"
            ?>
    <br>
    <a href="../">Back to the body shop page</a><br>
    <a href="https://csdb01.cs.edinboro.edu/~e873428d/">Back to my home page</a>
</body>

</html>