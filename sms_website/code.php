<?php
session_start();
$conn = mysqli_connect("localhost","root","1234","sms");

// Student Edit Data
if(isset($_POST['checking_edit_btn']))
{
    $s_id = $_POST['student_id'];
    // echo $return = $s_id;
    $result_array = [];

    $query = "SELECT * FROM device WHERE id='$s_id' ";
    $query_run = mysqli_query($conn, $query);

    if(mysqli_num_rows($query_run) > 0)
    {
        foreach($query_run as $row)
        {
            array_push($result_array, $row);
            header('Content-type: application/json');
            echo json_encode($result_array);
        }
    }
    else
    {
        echo $return = "<h5>No Record Found</h5>";
    }

}


if(isset($_POST['update_student']))
{
    $id = $_POST['edit_id'];
    $fname = $_POST['deviceid'];
    $lname = $_POST['token'];
    $class = $_POST['category'];
    $section = $_POST['sms_count'];

    $query = "UPDATE device SET deviceid='$fname', token='$lname', category='$class', sms_count='$section' WHERE id='$id' ";
    $query_run = mysqli_query($conn, $query);

    if($query_run)
    {
        $_SESSION['status'] = "Successfully Updated";
        header('Location: index.php');
    }
    else
    {
        $_SESSION['status'] = "Something Went Wrong.!";
        header('Location: index.php');
    }
}

?>