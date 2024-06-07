<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, Initial-scale=1.0">
    <title>Add a Customer to the AutoBody Repair Shop database</title>
    <link rel="shortcut icon" href="https://csdb01.cs.edinboro.edu/~e873428d/style/car.ico">
    <link rel="stylesheet" href="https://csdb01.cs.edinboro.edu/~e873428d/style/css/styles.css">

<body>
    <h3>Add a Customer to the AutoBody Repair Shop database</h3>
    <?php
            $db_location = "localhost";
            $db_username = "e873428d";
            $db_password = "temppass";
            $db_database = "e873428d_RepairShop";
            
            $db_connection = mysqli_connect($db_location, $db_username, $db_password, $db_database) or die("Couldn't connect to the database.");
            ?>
    <form id="register" name="register" method="POST" action="AddCustomer.php" onsubmit="return true">
        <div class="container">
            <div class="row">
                <div class="col-25">
                    <label for="fname">First Name:<br></label>
                </div>
                <div class="col-75">
                    <input type="text" id="fName" name="fName"><br>
                </div>
            </div>
            <div class="row">
                <div class="col-25">
                    <label for="lName">Last Name:<br></label>
                </div>
                <div class="col-75">
                    <input type="text" id="lName" name="lName"><br>
                </div>
            </div>
            <div class="row">
                <div class="col-25">
                    <label for="adress">Address:<br></label>
                </div>
                <div class="col-75">
                    <input type="text" id="adress" name="adress"><br>
                </div>
            </div>
            <div class="row">
                <div class="col-25">
                    <label for="phone">Phone number:<br></label>
                </div>
                <div class="col-75">
                    <input type="text" id="phone" name="phone"><br>
                </div>
            </div>
            <br>
            <input type="submit" value="Add Customer">
            <br><br>
    </form>
    <?php
            $sql="INSERT INTO Customer VALUES (NULL, '".
            $_POST['fName']."', '".
            $_POST['lName']."', '".
            $_POST['adress']."', '".
            $_POST['phone']."')";
            
            // The actual insert here
            IF($_POST['lName'] != "")
            {
                mysqli_query($db_connection, $sql) or die("Insert didn't work!");
            }
            
            // Now display the table with the new customers
            $customerTable = mysqli_query($db_connection, "SELECT * FROM Customer");
            
            echo "
                <table border='1'>
                    <tr>
                    <th>Customer ID</th>
                    <th>First Name</th>
                    <th>Last Name</th>
                    <th>Adress</th>
                    <th>Phone</th>
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
                echo "</table>";
            ?>
    <br>
    <a href="../">Back to the body shop page</a><br>
    <a href="https://csdb01.cs.edinboro.edu/~e873428d/">Back to my home page</a>
    </div>
</body>

</html>