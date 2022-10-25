
<?php
include 'dbcontroller.php';
$id = $_POST['id'];
$category = $_POST['category'];
$sms_count = $_POST['sms_count'];
$sql = "UPDATE `device` 
	SET category = '$category', sms_count = '$sms_count' WHERE id=$id";
if (mysqli_query($conn, $sql)) {
    echo json_encode(array("statusCode" => 200));
    $_SESSION['status'] = "Successfully Updated";
    header('Location: viewuser.php');
} else {
    echo json_encode(array("statusCode" => 201));
    $_SESSION['status'] = "Something went wrong.!";
    header('Location: viewuser.php');
}
mysqli_close($conn);
?>