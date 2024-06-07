<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, Initial-scale=1.0">
    <title>Reports Page</title>
    <link rel="shortcut icon" href="https://csdb01.cs.edinboro.edu/~e873428d/style/car.ico">
    <link rel="stylesheet" href="https://csdb01.cs.edinboro.edu/~e873428d/style/css/styles.css">
</head>

<body>
    <h3>Reports Page</h3>
    <?php
            $db_location = "localhost";
            $db_username = "e873428d";
            $db_password = "temppass";
            $db_database = "e873428d_RepairShop";
            
            $db_connection = mysqli_connect($db_location, $db_username, $db_password, $db_database) or die("Couldn't connect to the database.");
            
            $repair_jobTable = mysqli_query($db_connection, "SELECT * FROM `Repair_Job` ORDER BY `Repair_Job`.`jobID` ASC
            ") or die("Display query didn't work.");
            

            echo "
            <table border='1'>
                <tr>
                <th>Job ID</th>
                <th>Repair ID</th>
                <th>Job Description</th>
                <th>Part</th>
                <th>Car</th>
                <th>Customer</th>
                <th>Date Assigned</th>
                <th>Date Completed</th>
                </tr>
                ";
            
                while ($repair_jobTble = mysqli_fetch_array($repair_jobTable)) {
                    $jobTable = mysqli_query($db_connection, "SELECT * FROM Job WHERE jobID = '".$repair_jobTble["jobID"]."'") or die("Display query didn't work.");
                    $jobTble = mysqli_fetch_array($jobTable);
                    echo "<tr>";
                //JOBID & REPAIRID
                    echo "<td>".$repair_jobTble["jobID"]."</td>";
                    echo "<td>".$repair_jobTble["repairID"]."</td>";
                //REPAIR DESCRIPTION
                    $jobDescription = mysqli_query($db_connection, "SELECT * FROM Repair WHERE repairID = '".$repair_jobTble["repairID"]."'") or die("Display query didn't work.");
                    $jobDesc = mysqli_fetch_array($jobDescription);
                        echo "<td>".$jobDesc["description"]."</td>";
                //PART REQUIREMENTS
                    $part_RepairTable = mysqli_query($db_connection, "SELECT * FROM `Part_Repair` WHERE repairID = '".$repair_jobTble["repairID"]."'
                    ") or die("Display query didn't work.");
                    $part_repair = mysqli_fetch_array($part_RepairTable);
                    $part_Table = mysqli_query($db_connection, "SELECT * FROM `Part` WHERE partID = '".$part_repair["partID"]."'
                    ") or die("Display query didn't work.");
                    $part_desc = mysqli_fetch_array($part_Table);
                    IF ($part_repair["partID"]){
                        IF ($part_desc["part_Price"]){
                            echo "<td>".$part_repair["partID"]." ".$part_repair["quanity"]." ".$part_desc["part_Name"]." $".$part_desc["part_Price"]."</td>";
                        } else {
                            echo "<td>".$part_repair["partID"]." ".$part_repair["quanity"]."</td>";
                        }
                    } ELSE {
                        echo "<td>No parts used</td>";
                    }
                //CAR INFO
                    $carinfoformation = mysqli_query($db_connection, "SELECT * FROM Automobile WHERE carID = '".$jobTble["carID"]."'") or die("Display query didn't work.");
                    $carinfo = mysqli_fetch_array($carinfoformation);
                    echo "<td>".$carinfo["carID"]." ".$carinfo["YEAR"]." ".$carinfo["make"]." ".$carinfo["model"]."</td>";
                //CUSTOMER INFORMATION
                    $customerinfoformation = mysqli_query($db_connection, "SELECT * FROM Customer WHERE customerID = '".$carinfo["customerID"]."'") or die("Display query didn't work.");
                    $customerinfo = mysqli_fetch_array($customerinfoformation);
                    echo "<td>".$customerinfo["customerID"]." ".$customerinfo["fName"]." ".$customerinfo["lName"]." ".$customerinfo["model"]."</td>";
                //DATE INFO
                    echo "<td>".$jobTble["date"]."</td>";
                    IF ($jobTble["date_completed"]){
                        echo "<td>".$jobTble["date_completed"]."</td>";
                    } ELSE {
                        echo "<td>TDB</td>";
                    }
                    echo "</tr>";
                }
            echo "</table>"
            
            ?>
    <br>
    <a href="../">Back to the body shop page</a><br>
    <a href="https://csdb01.cs.edinboro.edu/~e873428d/">Back to my home page</a>
</body>

</html>