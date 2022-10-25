<?php session_start(); ?>
<!doctype html>
<html lang="en">

<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <!-- <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css"> -->
    <style>
        /* Dropdown Button */
        .dropbtn {
            background-color: #04AA6D;
            color: white;
            padding: 16px;
            font-size: 16px;
            border: none;
        }

        /* The container <div> - needed to position the dropdown content */
        .dropdown {
            float: right;
            /* display: inline-block; */
        }

        /* Dropdown Content (Hidden by Default) */
        .dropdown-content {
            display: none;
            position: absolute;
            background-color: #f1f1f1;
            min-width: 160px;
            box-shadow: 0px 8px 16px 0px rgba(0, 0, 0, 0.2);
            z-index: 1;
        }

        /* Links inside the dropdown */
        .dropdown-content a {
            color: black;
            padding: 12px 16px;
            text-decoration: none;
            display: block;
        }

        /* Change color of dropdown links on hover */
        .dropdown-content a:hover {
            background-color: #ddd;
        }

        /* Show the dropdown menu on hover */
        .dropdown:hover .dropdown-content {
            display: block;
        }

        /* Change the background color of the dropdown button when the dropdown content is shown */
        .dropdown:hover .dropbtn {
            background-color: #3e8e41;
        }

        .inline {
            /* display: inline-block; */
            float: right;
            text-align: right;
            /* margin: 20px 0px; */
        }

        #input {
            padding-bottom: 4px;
        }

        .pagination1 {
            display: block;
            position: relative;
        }

        .pagination1 a {
            font-weight: bold;
            /* font-size: 18px; */
            color: black;
            float: left;
            padding: 8px 16px;
            text-decoration: none;
            border: 1px solid black;
        }

        .pagination1 a.active {
            background-color: pink;
        }

        .pagination1 a:hover:not(.active) {
            background-color: skyblue;
        }
    </style>
    <!-- jQuery -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>

    <!-- jQuery UI -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/jqueryui/1.12.1/jquery-ui.css" />
    <script src="https://code.jquery.com/ui/1.12.1/jquery-ui.min.js"></script>
    <!-- Bootstrap CSS -->
    <!-- <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/css/bootstrap.min.css" integrity="sha384-9aIt2nRpC12Uk9gS9baDl411NQApFmC26EwAOH8WgZl5MYYxFfc+NcPb1dKGj7Sk" crossorigin="anonymous"> -->
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" rel="stylesheet">

    <title>PHP CRUD - Bootstrap Modal (POP UP)</title>
</head>

<body>

    <!-- Student Edit Modal -->
    <div class="modal fade" id="editStudentModal" tabindex="-1" role="dialog" aria-labelledby="editStudentModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="editStudentModalLabel">Device Edit Data</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <form action="code.php" method="POST">
                    <div class="modal-body">
                        <input type="hidden" name="edit_id" id="edit_id">
                        <div class="form-group">
                            <label for="">Device ID</label>
                            <input type="text" name="deviceid" id="edit_deviceid" class="form-control" placeholder="Enter Device ID">
                        </div>
                        <div class="form-group">
                            <label for="">Token</label>
                            <input type="text" name="token" id="edit_token" class="form-control" placeholder="Enter Token">
                        </div>
                        <div class="form-group">
                            <label for="">Category</label>
                            <input type="text" name="category" id="edit_category" class="form-control" placeholder="Enter Category">
                        </div>
                        <div class="form-group">
                            <label for="">SMS Count</label>
                            <input type="text" name="sms_count" id="edit_sms_count" class="form-control" placeholder="Enter SMS Count">
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                        <button type="submit" name="update_student" class="btn btn-primary">Update</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
    <!-- Student Edit Modal -->

    <?php

    // Import the file where we defined the connection to Database.     
    require_once "dbcontroller.php";

    $per_page_record = 5;  // Number of entries to show in a page.   
    // Look for a GET variable page if not found default is 1.        
    if (isset($_GET["page"])) {
        $page  = $_GET["page"];
    } else {
        $page = 1;
    }

    $start_from = ($page - 1) * $per_page_record;

    $query = "SELECT * FROM device LIMIT $start_from, $per_page_record";
    $rs_result = mysqli_query($conn, $query);
    ?>

    <div class="container mt-5">
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <?php
                    if (isset($_SESSION['status']) && $_SESSION['status'] != '') {
                    ?>

                        <div class="alert alert-warning alert-dismissible fade show" role="alert">
                            <strong>Hey!</strong> <?php echo $_SESSION['status']; ?>
                            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                    <?php
                        unset($_SESSION['status']);
                    }
                    ?>
                    <div class="card-header">
                        <h5>
                            PHP CRUD - Bootstrap Modal (POP UP)
                            <!-- Button trigger modal -->
                            <button type="button" class="btn btn-primary float-right" data-toggle="modal" data-target="#studentModal">
                                Add Device ID
                            </button>
                        </h5>
                        <div class="row">
                            <div class="col-md-4">
                                <label>Category:</label>
                                <input type="text" name="city" id="search_city" placeholder="Type to search..." class="form-control">
                            </div>
                        </div>
                        <div class="dropdown">
                            <button class="dropbtn">Action</button>
                            <div class="dropdown-content">
                                <a href="#">Add Device ID</a>
                                <a href="#">Edit</a>
                                <a href="#">Delete</a>
                            </div>
                        </div>

                    </div>
                    <div class="card-body">

                        <table class="table">
                            <thead>
                                <tr>
                                    <th scope="col">#ID</th>
                                    <th scope="col">Device ID</th>
                                    <th scope="col">Token</th>
                                    <th scope="col">Category</th>
                                    <th scope="col">SMS Count</th>
                                    <th scope="col">Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                $conn = mysqli_connect("localhost", "root", "1234", "sms");
                                $query = "SELECT * FROM device";
                                $query_run = mysqli_query($conn, $query);

                                if (mysqli_num_rows($query_run) > 0) {
                                    while ($row = mysqli_fetch_array($rs_result)) {
                                ?>
                                        <tr>
                                            <td class="stud_id"><?php echo $row['id']; ?></td>
                                            <td><?php echo $row['deviceid']; ?></td>
                                            <td><?php echo $row['token']; ?></td>
                                            <td><?php echo $row['category']; ?></td>
                                            <td><?php echo $row['sms_count']; ?></td>
                                            <td>
                                                <button href="#" title="view" class="badge badge-primary view_btn">VIEW</button>
                                                <button title="Edit" class="badge badge-info edit_btn">EDIT</button>
                                                <button title=" Delete" class="badge badge-danger" data-toggle="modal" data-target="#modaldelete<?php echo $row['id'] ?>"><span class="fa fa-trash"></span>DELETE</button>
                                            </td>
                                        </tr>
                                        <div id="modaldelete<?php echo $row['id'] ?>" class="modal fade" role="dialog">
                                            <div class="modal-dialog">
                                                <div class="modal-content">
                                                    <div class="modal-header">
                                                        <h4 class="modal-title">Details</h4>
                                                        <button type="button" class="close" data-dismiss="modal">&times;</button>
                                                    </div>
                                                    <div class="modal-body">
                                                        <form name="frmUser" method="post" action="delete.php">
                                                            <h3>ID : <?php echo $row['id']; ?></h3>
                                                            <h3>UID : <?php echo $row['uid']; ?></h3>
                                                            <h3>Device ID : <?php echo $row['deviceid']; ?></h3>
                                                            <h3>Token : <?php echo $row['token']; ?></h3>
                                                            <h3>Category : <?php echo $row['category']; ?></h3>
                                                            <h3>SMS Count : <?php echo $row['sms_count']; ?></h3>
                                                            <div class="modal-footer">
                                                                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                                                                <button type="submit" onClick=location.href="delete.php?id=<?php echo $row['id'] ?>" class="btn btn-warning">Delete</button>
                                                            </div>
                                                        </form>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                <?php
                                    }
                                } else {
                                    echo "<h5>No Record Found</h5>";
                                }
                                ?>
                            </tbody>
                        </table>
                        <div class="pagination1">
                            <?php
                            $query = "SELECT COUNT(*) FROM device";
                            $rs_result = mysqli_query($conn, $query);
                            $row = mysqli_fetch_row($rs_result);
                            $total_records = $row[0];

                            echo "</br>";
                            // Number of pages required.   
                            $total_pages = ceil($total_records / $per_page_record);
                            $pagLink = "";

                            if ($page >= 2) {
                                echo "<a href='index.php?page=" . ($page - 1) . "'>  Prev </a>";
                            }

                            for ($i = 1; $i <= $total_pages; $i++) {
                                if ($i == $page) {
                                    $pagLink .= "<a class = 'active' href='index.php?page="
                                        . $i . "'>" . $i . " </a>";
                                } else {
                                    $pagLink .= "<a href='index.php?page=" . $i . "'>   
                                                " . $i . " </a>";
                                }
                            };
                            echo $pagLink;

                            if ($page < $total_pages) {
                                echo " <a href='index.php?page=" . ($page + 1) . "'> Next </a>";
                            }

                            ?>
                            <div class="inline">
                                <input id="page" type="number" min="1" max="<?php echo $total_pages ?>" placeholder="<?php echo $page . "/" . $total_pages; ?>" required>
                                <button class="btn btn-dark btn-sm" onClick="go2Page();">Go</button>
                            </div>
                        </div>



                    </div>
                </div>
                </center>
                <script>
                    function go2Page() {
                        var page = document.getElementById("page").value;
                        page = ((page > <?php echo $total_pages; ?>) ? <?php echo $total_pages; ?> : ((page < 1) ? 1 : page));
                        window.location.href = 'index.php?page=' + page;
                    }
                </script>
            </div>
        </div>
    </div>
    </div>
    </div>



   
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js" integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/js/bootstrap.min.js" integrity="sha384-OgVRvuATP1z7JjHLkuOU7Xw704+h835Lr+6QL9UvYjZE3Ipu6Tp75j7Bh/kR0JKI" crossorigin="anonymous"></script>

    <script>
        $(document).ready(function() {

            $('.edit_btn').click(function(e) {
                e.preventDefault();

                var stud_id = $(this).closest('tr').find('.stud_id').text();
                // console.log(stud_id);

                $.ajax({
                    type: "POST",
                    url: "code.php",
                    data: {
                        'checking_edit_btn': true,
                        'student_id': stud_id,
                    },
                    success: function(response) {
                        console.log(response);
                        $.each(response, function(key, value) {
                            console.log(value['deviceid']);
                            $('#edit_id').val(value['id']);
                            $('#edit_deviceid').val(value['deviceid']);
                            $('#edit_token').val(value['token']);
                            $('#edit_category').val(value['category']);
                            $('#edit_sms_count').val(value['sms_count']);
                        });

                        $('#editStudentModal').modal('show');
                    }
                });

            });

        });
    </script>
    <script type="text/javascript">
        $(function() {
            $("#search_city").autocomplete({
                source: 'ajax-city-search.php',
            });
        });
    </script>

</body>

</html>