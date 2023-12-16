<?php
include 'connection.php';

session_start();

if (!isset($_SESSION['admin_id'])) {
    header("Location: admin-login.php");
    exit();
}

if (isset($_GET['deleteId'])) {
    $deleteId = $_GET['deleteId'];
    
    $stmt = $con->prepare("DELETE FROM existingcars WHERE id = ?");
    $stmt->bind_param("i", $deleteId);
    $stmt->execute();
    
    $stmt->close();
    
    header("Location: admin.php");
    exit();
}

$sqlExistingCars = "SELECT * FROM existingcars";
$resultExistingCars = mysqli_query($con, $sqlExistingCars);
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
            background-color: #ffd54f;
        }
    </style>
    <title>Admin Page</title>
</head>
<body>

    <div class="container mt-5">
        <h1 class="mb-4">Admin Page</h1>

        <h2>Existing Cars</h2>
        <table class="table">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Car Model</th>
                    <th>Model Year</th>
                    <th>Cost Per Day</th>
                    <th>Car Image</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody>
                <?php
                while ($row = mysqli_fetch_assoc($resultExistingCars)) {
                    echo '<tr>';
                    echo '<td>' . $row['id'] . '</td>';
                    echo '<td>' . $row['CarModel'] . '</td>';
                    echo '<td>' . $row['ModelYear'] . '</td>';
                    echo '<td>' . $row['CostPerDay'] . '</td>';
                    echo '<td>' . $row['CarImage'] . '</td>';
                    echo '<td><a href="admin.php?editId=' . $row['id'] . '" class="btn btn-warning">Edit</a>';
                    echo ' <a href="admin.php?deleteId=' . $row['id'] . '" class="btn btn-danger" onclick="return confirm(\'Are you sure?\')">Delete</a></td>';
                    echo '</tr>';
                }
                ?>
            </tbody>
        </table>

        <a href="addCar.php" class="btn btn-success">Add Car</a>
        <a href="admin-logout.php" class="btn btn-secondary">Logout</a>
    </div>

    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.5.2/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>

</body>
</html>
