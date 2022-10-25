<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>Device List</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
    <script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
    <style>
        .wrapper {
            width: 600px;
            margin: 0 auto;
        }

        table tr td:last-child {
            width: 120px;
        }
    </style>
    <script>
        $(document).ready(function() {
            $('[data-toggle="tooltip"]').tooltip();
        });
    </script>
</head>

<body>
    <?php

    // Import the file where we defined the connection to Database.     
    require_once "dbcontroller.php";

    $per_page_record = 6;  // Number of entries to show in a page.   
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

    <div class="container">
        <br>
        <div>
            <h1>Device List</h1>
            <div class="row">
                <div class="col-md-4">
                    <label>City:</label>
                    <input type="text" name="city" id="search_city" placeholder="Type to search..." class="form-control">
                </div>
            </div>

            <table class="table table-striped table-condensed    
                                          table-bordered">
                <thead>
                    <tr>
                        <th width="10%">ID</th>
                        <th>UID</th>
                        <th>Device ID</th>
                        <th>Token</th>
                        <th>Category</th>
                        <th>SMS Count</th>
                        <th>Last Update</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    while ($row = mysqli_fetch_array($rs_result)) {
                        // Display each field of the records.    
                    ?>
                        <tr>
                            <td><?php echo $row["id"]; ?></td>
                            <td><?php echo $row["uid"]; ?></td>
                            <td><?php echo $row["deviceid"]; ?></td>
                            <td><?php echo $row["token"]; ?></td>
                            <td><?php echo $row["category"]; ?></td>
                            <td><?php echo $row["sms_count"]; ?></td>
                            <td><?php echo $row["lastupdate"]; ?></td>
                            <td><a title="Edit" type="button" class="btn btn-info" data-toggle="modal" data-target="#myModal<?php echo $row['id'] ?>"><span class="fa fa-pencil"></span></a>
                                <button title="Delete" type="button" class="btn btn-warning" data-toggle="modal" data-target="#modaldelete<?php echo $row['id'] ?>"><span class="fa fa-trash"></span></button>
                            </td>
                        </tr>
                        <div id="myModal<?php echo $row['id'] ?>" class="modal fade" role="dialog">
                            <div class="modal-dialog">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h4 class="modal-title">Details</h4>
                                        <button type="button" class="close" data-dismiss="modal">&times;</button>
                                    </div>
                                    <div class="modal-body">
                                        <form name="frmUser" method="post" action="update.php">
                                            <div><?php if (isset($message)) {
                                                        echo $message;
                                                    } ?>
                                            </div>
                                            <h3>Device ID : <?php echo $row['deviceid']; ?></h3>
                                            Category <br>
                                            <input type="hidden" name="id" value="<?php echo $row['id']; ?>" />
                                            <input type="text" name="category" class="txtField" placeholder="<?php echo $row['category']; ?>" required />
                                            <br>
                                            SMS Count :<br>
                                            <input type="text" name="sms_count" class="txtField" placeholder="<?php echo $row['sms_count']; ?>" required />
                                            <br>
                                            <br>
                                            <div class="modal-footer">
                                                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                                                <button type="submit" name="update_student" class="btn btn-primary">Update</button>
                                            </div>


                                        </form>
                                    </div>
                                </div>
                            </div>
                        </div>
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

                    };
                    ?>
                </tbody>
            </table>

            <div class="pagination">
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
                    echo "<a href='viewuser.php?page=" . ($page - 1) . "'>  Prev </a>";
                }

                for ($i = 1; $i <= $total_pages; $i++) {
                    if ($i == $page) {
                        $pagLink .= "<a class = 'active' href='viewuser.php?page="
                            . $i . "'>" . $i . " </a>";
                    } else {
                        $pagLink .= "<a href='viewuser.php?page=" . $i . "'>   
                                                " . $i . " </a>";
                    }
                };
                echo $pagLink;

                if ($page < $total_pages) {
                    echo "<a href='viewuser.php?page=" . ($page + 1) . "'>  Next </a>";
                }

                ?>
            </div>


            <div class="inline">
                <input id="page" type="number" min="1" max="<?php echo $total_pages ?>" placeholder="<?php echo $page . "/" . $total_pages; ?>" required>
                <button onClick="go2Page();">Go</button>
            </div>
        </div>
    </div>
    </center>
    <script>
        function go2Page() {
            var page = document.getElementById("page").value;
            page = ((page > <?php echo $total_pages; ?>) ? <?php echo $total_pages; ?> : ((page < 1) ? 1 : page));
            window.location.href = 'viewuser.php?page=' + page;
        }
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