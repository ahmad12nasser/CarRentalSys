<?php
include 'connection.php';

$sqlAvailableCars = "SELECT * FROM availablecars";
$resultAvailableCars = mysqli_query($con, $sqlAvailableCars);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <style>
        body {
            background-color: #d1c4e9;
        }
    </style>
    <title>Customer Page</title>
</head>
<body>

    <div class="container mt-5">
        <h1 class="mb-4">Customer Page</h1>

        <h2>Available Cars</h2>
        <table class="table">
            <thead>
                <tr>
                    <th>Car Model</th>
                    <th>Model Year</th>
                    <th>Cost Per Day</th>
                    <th>Car Image</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody>
                <?php
                while ($row = mysqli_fetch_assoc($resultAvailableCars)) {
                    echo '<tr>';
                    echo '<td>' . $row['CarModel'] . '</td>';
                    echo '<td>' . $row['ModelYear'] . '</td>';
                    echo '<td>' . $row['CostPerDay'] . '</td>';
                    echo '<td>' . $row['CarImage'] . '</td>';
                    echo '<td><a href="customer-action.php?rentId=' . $row['id'] . '" class="btn btn-success">Rent</a></td>';
                    echo '</tr>';
                }
                ?>
            </tbody>
        </table>
        <a href="index.php" class="btn btn-info">Back to Home</a>   
    </div>

    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.5.2/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>

</body>
</html>
