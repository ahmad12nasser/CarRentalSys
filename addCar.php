<?php
include 'connection.php';

session_start();

if (!isset($_SESSION['admin_id'])) {
    header("Location: admin-login.php");
    exit();
}

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $carModel = $_POST['carModel'];
    $modelYear = $_POST['modelYear'];
    $costPerDay = $_POST['costPerDay'];
    $carImage = $_FILES['carImage']['name'];
    $carImageTmp = $_FILES['carImage']['tmp_name'];
    $carImagePath = 'car_images/' . $carImage;

    if (empty($carModel) || empty($modelYear) || empty($costPerDay) || empty($carImage)) {
        $error = "Please fill in all fields.";
    } else {
        move_uploaded_file($carImageTmp, $carImagePath);

        $stmt = $con->prepare("INSERT INTO existingcars (CarModel, ModelYear, CostPerDay, CarImage) VALUES (?, ?, ?, ?)");
        $stmt->bind_param("ssss", $carModel, $modelYear, $costPerDay, $carImage);
        $stmt->execute();

        $stmt = $con->prepare("INSERT INTO availablecars (CarModel, ModelYear, CostPerDay, CarImage) VALUES (?, ?, ?, ?)");
        $stmt->bind_param("ssss", $carModel, $modelYear, $costPerDay, $carImage);
        $stmt->execute();

        header("Location: admin.php");
        exit();
    }
}
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
            background-color: #b2dfdb;
        }
    </style>
    <title>Add Car</title>
</head>
<body>

    <div class="container mt-5">
        <h1 class="mb-4">Add Car</h1>
        <?php
        if (isset($error)) {
            echo '<div class="alert alert-danger" role="alert">' . $error . '</div>';
        }
        ?>
        <form action="addCar.php" method="post" enctype="multipart/form-data">
            <div class="form-group">
                <label for="carModel">Car Model:</label>
                <input type="text" name="carModel" class="form-control" required>
            </div>
            <div class="form-group">
                <label for="modelYear">Model Year:</label>
                <input type="number" name="modelYear" class="form-control" required>
            </div>
            <div class="form-group">
                <label for="costPerDay">Cost Per Day:</label>
                <input type="number" name="costPerDay" class="form-control" required>
            </div>
            <div class="form-group">
                <label for="carImage">Car Image:</label>
                <input type="file" name="carImage" class="form-control-file" accept="image/*" required>
            </div>
            <button type="submit" class="btn btn-primary">Add Car</button>
        </form>
    </div>

    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.5.2/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>

</body>
</html>
