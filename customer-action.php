<?php
include 'connection.php';

if (isset($_GET['rentId'])) {
    $rentId = $_GET['rentId'];
    $sql = "DELETE FROM availablecars WHERE id = $rentId";
    mysqli_query($con, $sql);
}
?>
