<?php
$servername = "localhost";
$username = "root";
$password = "1234";
$dbname = "sms";
$id = $_GET['id'];
// Create connection
$conn = mysqli_connect($servername, $username, $password, $dbname);
// Check connection
if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
}

// sql to delete a record
$sql = "DELETE FROM device WHERE id= $id";

if (mysqli_query($conn, $sql)) {
    echo "Record deleted successfully";
    $_SESSION['status'] = "Successfully Updated";
    header('Location: viewuser.php');
} else {
    echo "Error deleting record: " . mysqli_error($conn);
    $_SESSION['status'] = "Something went wrong.!";
    header('Location: viewuser.php');
}

mysqli_close($conn);
