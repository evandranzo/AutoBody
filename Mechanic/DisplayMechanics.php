<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, Initial-scale=1.0">
    <title>Display the Mechanics in the AutoBody Repair Shop database</title>
    <link rel="shortcut icon" href="https://csdb01.cs.edinboro.edu/~e873428d/style/car.ico">
    <link rel="stylesheet" href="https://csdb01.cs.edinboro.edu/~e873428d/style/css/styles.css">
</head>

<body>
    <h3>Display the Mechanics in the AutoBody Repair Shop database</h3>
    <?php
            $db_location = "localhost";
            $db_username = "e873428d";
            $db_password = "temppass";
            $db_database = "e873428d_RepairShop";
            
            $db_connection = mysqli_connect($db_location, $db_username, $db_password, $db_database) or die("Couldn't connect to the database.");
            
            $mechanicTable = mysqli_query($db_connection, "SELECT * FROM Mechanic") or die("Display query didn't work.");
            
            echo "
            <table border='1'>
                <tr>
                <th>Mechanic ID</th>
                <th>Name</th>
                <th>Rate</th>
                <th>Num of Jobs</th>
                </tr>
                ";
            
                while ($row = mysqli_fetch_array($mechanicTable)) {
                    echo "<tr>";
                    echo "<td>" . $row["mechanicID"] . "</td>";
                    echo "<td>" . $row["name"] . "</td>";
                    echo "<td>" . $row["rate"] . "</td>";
                    echo "<td>" . $row["Num_of_Jobs_Assigned"] . "</td>";
                    echo "</tr>";
                }
            echo "</table>"
            
            ?>
    <br>
    <a href="../">Back to the body shop page</a><br>
    <a href="https://csdb01.cs.edinboro.edu/~e873428d/">Back to my home page</a>
</body>

</html>