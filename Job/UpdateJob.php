<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, Initial-scale=1.0">
        <link rel="shortcut icon" href="https://csdb01.cs.edinboro.edu/~e873428d/style/car.ico">
        <link rel="stylesheet" href="https://csdb01.cs.edinboro.edu/~e873428d/style/css/styles.css">
        <!-- TITLE -->
        <title>Update a Job in the AutoBody Repair Shop database</title>
    </head>
    <body>
        <h3>Update a Job in the AutoBody Repair Shop database</h3>
        <?php
            $db_location = "localhost";
            $db_username = "e873428d";
            $db_password = "temppass";
            $db_database = "e873428d_RepairShop";
            
            $db_connection = mysqli_connect($db_location, $db_username, $db_password, $db_database) or die("Couldn't connect to the database.");
            
            
            /** Make a drop down to show all the Jobs ******/
            echo "
            <form id='getdata' method='POST'>";
            $result=mysqli_query($db_connection, "SELECT * FROM Job") or die("Query from the drop down didn't work");
            IF (ISSET($_POST["jobID"])) {
                $result2=mysqli_query($db_connection, "SELECT * FROM Job WHERE jobID='".$_POST["jobID"]."'") or die("Query from the drop down didn't work");
                $result3=mysqli_query($db_connection, "SELECT * FROM Job WHERE jobID<>'".$_POST["jobID"]."'") or die("Query from the drop down didn't work");
            }
            echo"
            <div class='container'>
            <div class='row'>
                <div class='col-25'>
                    <label for='job'>Select an Job to update:</label>
                </div>
            <div class='col-75'>
                <select name='jobID' id='jobID' onchange='this.form.submit()'>";
                IF (ISSET($_POST["estimateID"])) {
                    while($row=mysqli_fetch_array($result3))
                    {
                        while($column=mysqli_fetch_array($result2))
                        {
                        echo "<option value='".$column["jobID"]."'>".$column['jobID']."</option>";
                        }
                        echo "<option value='".$row["jobID"]."'>".$row['jobID']."</option>";
                    }
                } else {
                    echo "<option value='--------'>---------</option>";   
                    while($row=mysqli_fetch_array($result))
                    {
                        echo "<option value='".$row["jobID"]."'>".$row['jobID']."</option>";
                    }
                }

            echo "
                </select>
            </div>
            </div>
            </form>";
            $result=mysqli_query($db_connection,"SELECT * FROM Job WHERE jobID='".$_POST["jobID"]."'") or die ("Query to get the job info didn't work");
            $row=mysqli_fetch_array($result);

            echo "
            <div class='row'>
                <div class='col-25'>
                <label for='carID'>Car ID:</label>
                </div>
                <div class='col-75'>
                <input type='text' id='carID' name='carID' value='".$row['carID']."'>
                </div>
            </div>
            <div class='row'>
                <div class='col-25'>
                <label for='mechanicID'>Mechanic ID:</label>
                </div>
                <div class='col-75'>
                <input type='text' id='mechanicID' name='mechanicID' value='".$row['mechanicID']."'>
                </div>
            </div>
            <div class='row'>
                <div class='col-25'>
                <label for='estimateID'>Estimate ID:</label>
                </div>
                <div class='col-75'>
                <input type='text' id='estimateID' name='estimateID' value='".$row['estimateID']."'>
                </div>
            </div>
            <div class='row'>
                <div class='col-25'>
                <label for='date'>Date Started:</label>
                </div>
                <div class='col-75'>
                <input type='date' id='date' name='date' value='".$row['date']."'>
                </div>
            </div>
            <div class='row'>
                <div class='col-25'>
                <label for='date_completed'>Date Completed:</label>
                </div>
                <div class='col-75'>
                <input type='date' id='date_completed' name='date_completed' value='".$row['date_completed']."'>
                </div>
            </div>
            <br>
            <input type='submit' value='Update Job'>
            </form>
            ";
            ?>
        <?php
            // Do update here using the data from the form above 
            $sql="UPDATE Job SET
            jobID = '".$_POST['jobID']."',
            carID = '".$_POST['carID']."',
            mechanicID = '".$_POST['mechanicID']."',
            estimateID = '".$_POST['estimateID']."',
            date = '".$_POST['date']."',
            date_completed = '".$_POST['date_completed']."'
            WHERE jobID = '".$_POST['jobID']."';"
            ;
            
            //The actual running of the update query
            IF($_POST['date'] != "")
            {
                mysqli_query($db_connection, $sql) or die ("Update did not work");
            }
            
            ?>
        <br>
        <a href="https://csdb01.cs.edinboro.edu/~e873428d/AutoBody Repair/Employee">Back to the body shop page</a><br>
        <a href="https://csdb01.cs.edinboro.edu/~e873428d/">Back to my home page</a>
    </body>
</html>