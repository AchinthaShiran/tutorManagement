<?php
include "php/functions.php";
include "php/config.php";

if (!checkPermissions("USR", 4)) {
    header("HTTP/1.1 401 Unauthorized");
    exit;
}

$con = connect();

$stts = '%';
if (isset($_GET['searchByStatus'])) {
    $stts = $_GET['searchByStatus'];
}

$query = $con->prepare("SELECT * FROM Users WHERE role_id=2 AND status LIKE ?");
$query->bind_param("s", $stts);
$query->execute();
$result = $query->get_result();

$users = array();

while ($row = $result->fetch_assoc()) {
    array_push($users, $row);
}

$con->close();

function get($users)
{
    foreach ($users as $user) {
        $name = $user['firstName'] . " " . $user['lastName'];
        $email = $user['email'];
        $status = $user['status'];
        $phone = $user['phone'];
        $id = $user['id'];
        echo "        
        <tr>
        <td>$name</td>
        <td>$email</td>
        <td>$phone</td>
        <td>$status</td>
        <td><button onclick=\"location.href = 'updateUser.php?id=$id';\"  class=\"btn btn-primary\">View</button></td>
        </tr>
        ";
    }
}
?>
<html>

<head lang="en">
    <title>Login</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="bootstrap/css/bootstrap.min.css" />
    <link rel="stylesheet" href="css/styles.css" />
    <script src="https://code.jquery.com/jquery-3.1.0.min.js"></script>
    <script src="bootstrap/js/bootstrap.min.js"></script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
</head>

<div class="container-fluid sidebar">
    <div class="row">
        <?php include "sideBar.php" ?>
        <div class="col-md-10">
            <br>
            <div class="card">
                <div class="card-header">
                    <div class="row">
                        <div class="col-md-9">
                            <h4>Browse Users</h4>
                        </div>
                        <div class="col-md-3">
                            <form name="search" id="search" method="GET">
                                <div class="input-group input-group-sm">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text" id="inputGroup-sizing-sm">Status : </span>
                                    </div>
                                    <select class="form-control" name="searchByStatus" id="searchByStatus" onchange="this.form.submit()">
                                        <option value="%" <?php dropDownValue($stts, "") ?>>All</option>
                                        <option <?php dropDownValue($stts, "Active") ?>>Active</option>
                                        <option <?php dropDownValue($stts, "Pending") ?>>Pending</option>
                                        <option <?php dropDownValue($stts, "Disabled") ?>>Disabled</option>
                                    </select>
                                </div>


                            </form>
                        </div>

                    </div>
                    </form>
                </div>

                <div class="card-body table-responsive p-0" style="height: 600px;">
                    <table class="table table-hover table-head-fixed text-nowrap">
                        <thead>
                            <tr>
                                <th scope="col">Name</th>
                                <th scope="col">Email</th>
                                <th scope="col">Phone</th>
                                <th scope="col">Status</th>
                                <th scope="col"></th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php get($users) ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>

</html>