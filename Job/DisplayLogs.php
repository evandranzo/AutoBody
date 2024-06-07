<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, Initial-scale=1.0">
    <title>Display the Logs in the AutoBody Repair Shop database</title>
    <link rel="shortcut icon" href="https://csdb01.cs.edinboro.edu/~e873428d/style/car.ico">
    <link rel="stylesheet" href="https://csdb01.cs.edinboro.edu/~e873428d/style/css/styles.css">
</head>

<body>
    <h3>Display the Logs in the AutoBody Repair Shop database</h3>
    <?php
            $db_location = "localhost";
            $db_username = "e873428d";
            $db_password = "temppass";
            $db_database = "e873428d_RepairShop";
            
            $db_connection = mysqli_connect($db_location, $db_username, $db_password, $db_database) or die("Couldn't connect to the database.");
            
            $logTable = mysqli_query($db_connection, "SELECT * FROM Log") or die("Display query didn't work.");
            
            echo "
            <table border='1'>
                <tr>
                <th>Log ID</th>
                <th>Rec_Changed</th>
                <th>Action</th>
                <th>Date Changed</th>
                </tr>
                ";
            
                while ($row = mysqli_fetch_array($logTable)) {
                    echo "<tr>";
                    echo "<td>" . $row["Log_ID"] . "</td>";
                    echo "<td>" . $row["Rec_Changed"] . "</td>";
                    echo "<td>" . $row["Action"] . "</td>";
                    echo "<td>" . $row["Change_Date"] . "</td>";
                    echo "</tr>";
                }
            echo "</table>"
            
            ?>
    <br>
    <a href="../">Back to the body shop page</a><br>
    <a href="https://csdb01.cs.edinboro.edu/~e873428d/">Back to my home page</a>
</body>

</html>