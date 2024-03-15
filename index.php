<?php include './connect.php'; ?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="./css/Display.css">
    <title>Pending</title>
    <style>
        .table {
            width: 100%; /* Make the table take up the entire width */
            background-color: white;
            border: 1px solid black;
            border-radius: 10px;
            padding: 20px;
            margin: 10px;
        }

        .table h2 {
            text-align: center; /* Center the title */
            background: -webkit-linear-gradient(black, orange);
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
        }
        th, td {
         border: 1px solid black;
          padding: 10px;
          text-align: left;
             font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
             width: 30%; /* Adjust the width as needed */
             height: 50px; /* Adjust the height as needed */
        }

  

      
    </style>
</head>
<body>

<header class="header">
    <div class="header_photo1">
        <img class="CEATlogo" src="./images/ceat_logo.png" alt="">
    </div>
    <h3 style="color: white;">CEA QUEUEING APPOINTMENT SYSTEM</h3>
    <div class="header_photo2">
        <img class="RTUlogo" src="./images/rtu_logo.png" alt="">
    </div>
</header>

<div class="table">
    <!-- Table Content Goes Here -->
    <h2>APPOINTMENT</h2>
    <?php
        // Include your database connection file
        include './connect.php';

        // Example PDO code to fetch data from the database and display it in the table
        $sql = "SELECT uid, professor, name, course, section FROM fillup";
        $result = $conn->query($sql);

        if ($result->rowCount() > 0) {
            echo "<table>";
            echo "<tr><th>ID</th><th>Professor</th><th>Student Name</th><th>Course</th><th>Section</th></tr>";
            while($row = $result->fetch(PDO::FETCH_ASSOC)) {
                echo "<tr><td>" . $row["uid"] . "</td><td>" . $row["professor"] . "</td><td>" . $row["name"] . "</td><td>" . $row["course"] . "</td><td>" . $row["section"] . "</td></tr>";
            }
            echo "</table>";
        } else {
            echo "No Pending";
        }
    ?>
</div>

<footer class="footer"></footer>

<script>
    setTimeout(function() {
        location.reload();
    }, 5000); // 2 minutes in milliseconds
</script>

</body>
</html>
