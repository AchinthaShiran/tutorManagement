<?php
include "php/config.php";
include "php/functions.php";


if (!checkPermissions("USR", 1)) {
    header("location: index.php");
    exit;
}

if (isset($_POST['submit'])) {
    if (checkPermissions("USR", 1)) {
        $firstName =  $_POST['firstName'];
        $lastName =  $_POST['lastName'];
        $email =  $_POST['email'];
        $phone =  $_POST['phone'];
        $role =  $_POST['role'];

        $con = connect();
        $query = $con->prepare("INSERT INTO Users (firstName, lastName, email,phone,password,role_id,status)
        VALUES (?, ?, ?,?,'123123123',?,'Active')");
        $query->bind_param("ssssi",$firstName,$lastName,$email,$phone,$role);
        $query->execute();
        $result = $query->get_result();
        $con->close();
        echo "<meta http-equiv='refresh' content='0'>";
    } else {
        header("HTTP/1.1 401 Unauthorized");
        exit;
    }
}
function status($option, $status)
{
    if (strcmp($status, $option) == 0) {
        echo "selected";
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
</head>

<div class="container-fluid sidebar">
    <div class="row">
        <?php include "sideBar.php" ?>
        <div class="col-md-10">
            <form method="POST">
                <div class="form-group">
                    <div class="row">
                        <div class="col-md-5">
                            <h2>Add user</h2>
                        </div>
                    </div>
                </div>
                <div class="form-group">
                    <div class="row">
                        <div class="col-md-5">
                            <label for="firstName">First Name</label>
                            <input type="text" class="form-control" id="firstName" name="firstName" aria-describedby="firstName" placeholder="First Name">
                        </div>
                        <div class="col-md-5">
                            <label for="lastName">Last Name</label>
                            <input type="text" class="form-control" id="lastName" name="lastName" aria-describedby="lastName" placeholder="Last Name">
                        </div>
                    </div>
                </div>
                <div class="form-group">
                    <div class="row">
                        <div class="col-md-5">
                            <label for="email">Email</label>
                            <input type="email" class="form-control" id="email" name="email" aria-describedby="email" placeholder="email">
                        </div>
                        <div class="col-md-5">
                            <label for="phone">Phone</label>
                            <input type="text" class="form-control" id="phone" name="phone" aria-describedby="phone" placeholder="Phone">
                        </div>
                    </div>
                </div>
                <div class="form-group">
                    <div class="col-md-5">
                        <div class="row">

                            <label for="role">Role</label>
                            <select class="form-control" id="role" name="role">
                                <option value="1">Admin</option>
                                <option value="2">User</option>
                            </select>
                        </div>
                    </div>
                </div>

                <button type="submit" name="submit" class="btn btn-primary">Add User</button>
            </form>

        </div>

    </div>
</div>


</div>
</div>

</html>