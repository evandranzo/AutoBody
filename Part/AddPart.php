3
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, Initial-scale=1.0">
    <title>Add a Part to the AutoBody Part Shop database</title>
    <link rel="shortcut icon" href="https://csdb01.cs.edinboro.edu/~e873428d/style/car.ico">
    <link rel="stylesheet" href="https://csdb01.cs.edinboro.edu/~e873428d/style/css/styles.css">

<body>
    <h3>Add a Part to the AutoBody Part Shop database</h3>
    <?php
            $db_location = "localhost";
            $db_username = "e873428d";
            $db_password = "temppass";
            $db_database = "e873428d_RepairShop";
            
            $db_connection = mysqli_connect($db_location, $db_username, $db_password, $db_database) or die("Couldn't connect to the database.");

//INITIAL DROP DOWN TO GET PartS
    echo "
    <form id='register' name='register' method='POST' action='AddPart.php' onsubmit='return true'>
        <div class='container'>";
//CUSTOMER DROP DOWN


    ?>
    <div class="row">
        <div class="col-25">
            <label for="part_Name">Name:</label>
        </div>
        <div class="col-75">
            <input type="text" id="part_Name" name="part_Name">
        </div>
    </div>
    <div class="row">
        <div class="col-25">
            <label for="part_Description">Description:</label>
        </div>
        <div class="col-75">
            <input type="text" id="part_Description" name="part_Description">
        </div>
    </div>
    <div class="row">
        <div class="col-25">
            <label for="part_Price">Price:</label>
        </div>
        <div class="col-75">
            <input type="int" id="part_Price" name="part_Price">
        </div>
    </div>
    <br>
    <input type="submit" value="Add Part">
    </form>


    <?php
            $sql="INSERT INTO Part VALUES (NULL,'".
            $_POST['part_Name']."', '".
            $_POST['part_Description']."', '".
            $_POST['part_Price']."')";
            
            echo "<br><br>
             $sql
            <br><br>";
            // The actual insert here
            IF($_POST['part_Price'] != "")
            {
                mysqli_query($db_connection, $sql) or die("Insert didn't work!");
            }
            
            // Now display the table with the new parts
            $partTable = mysqli_query($db_connection, "SELECT * FROM Part");
            
            echo "
                <table border='1'>
                    <tr>
                    <th>Part ID</th>
                    <th>Name</th>
                    <th>Description</th>
                    <th>Price</th>
                    </tr>
                    ";
            
                    while ($row = mysqli_fetch_array($partTable)) {
                        echo "<tr>";
                        echo "<td>" . $row["partID"] . "</td>";
                        echo "<td>" . $row["part_Name"] . "</td>";
                        echo "<td>" . $row["part_Description"] . "</td>";
                        echo "<td>" . $row["part_Price"] . "</td>";
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