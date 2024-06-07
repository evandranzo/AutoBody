<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, Initial-scale=1.0">
    <title>Add a Mechanic to the AutoBody Repair Shop database</title>
    <link rel="shortcut icon" href="https://csdb01.cs.edinboro.edu/~e873428d/style/car.ico">
    <link rel="stylesheet" href="https://csdb01.cs.edinboro.edu/~e873428d/style/css/styles.css">

<body>
    <h3>Add a Mechanic to the AutoBody Repair Shop database</h3>
    <?php
            $db_location = "localhost";
            $db_username = "e873428d";
            $db_password = "temppass";
            $db_database = "e873428d_RepairShop";
            
            $db_connection = mysqli_connect($db_location, $db_username, $db_password, $db_database) or die("Couldn't connect to the database.");
            ?>
    <form id="register" name="register" method="POST" action="AddMechanic.php" onsubmit="return true">
        <div class="container">
            <div class="row">
                <div class="col-25">
                    <label for="name">Name:<br></label>
                </div>
                <div class="col-75">
                    <input type="text" id="name" name="name"><br>
                </div>
            </div>
            <div class="row">
                <div class="col-25">
                    <label for="rate">Rate:<br></label>
                </div>
                <div class="col-75">
                    <input type="text" id="rate" name="rate"><br>
                </div>
            </div>
            <div class="row">
                <div class="col-25">
                    <label for="Num_of_Jobs_Assigned">Num Of Jobs:<br></label>
                </div>
                <div class="col-75">
                    <input type="text" id="Num_of_Jobs_Assigned" name="Num_of_Jobs_Assigned"><br>
                </div>
            </div>
            <br>
            <input type="submit" value="Add Mechanic">
            <br><br>
    </form>
    <?php
            $sql="INSERT INTO Mechanic VALUES (NULL, '".
            $_POST['name']."', '".
            $_POST['rate']."', '".
            $_POST['Num_of_Jobs_Assigned']."')";
            
            // The actual insert here
            IF($_POST['name'] != "")
            {
                mysqli_query($db_connection, $sql) or die("Insert didn't work!");
            }
            
            // Now display the table with the new mechanics
            $mechanicTable = mysqli_query($db_connection, "SELECT * FROM Mechanic");
            
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
            
                echo "</table>";
            ?>
    <br>
    <a href="../">Back to the body shop page</a><br>
    <a href="https://csdb01.cs.edinboro.edu/~e873428d/">Back to my home page</a>
    </div>
</body>

</html>