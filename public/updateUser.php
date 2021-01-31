<?php
include "../php/config.php";
include "../php/functions.php";


if (!checkPermissions("USR", 2)) {
    header("location: index.php");
    exit;
}

if (isset($_GET['id'])) {
    $id = $_GET['id'];

    $con = connect();
    $query = $con->prepare("SELECT * FROM Users WHERE id=?");
    $query->bind_param("i",$id);
    $query->execute();
    $result = $query->get_result();
    $user = $result->fetch_assoc();
    $con->close();
}

if (isset($_POST['submit'])) {
    if (checkPermissions("USR", 2)) {
        $firstName =  $_POST['firstName'];
        $lastName =  $_POST['lastName'];
        $email =  $_POST['email'];
        $phone =  $_POST['phone'];
        $status =  $_POST['status'];

        $con = connect();
        $query = $con->prepare("UPDATE Users SET firstName=?, lastName=?, email=?, phone=?, status=? WHERE id=?");
        $query->bind_param("sssssi",$firstName,$lastName,$email,$phone,$status,$id);
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
                            <h2>Edit user</h2>
                        </div>
                    </div>
                </div>
                <div class="form-group">
                    <div class="row">
                        <div class="col-md-5">
                            <label for="firstName">First Name</label>
                            <input type="text" class="form-control" id="firstName" name="firstName" aria-describedby="firstName" placeholder="First Name" value="<?php echo $user['firstName'] ?>">
                        </div>
                        <div class="col-md-5">
                            <label for="lastName">Last Name</label>
                            <input type="text" class="form-control" id="lastName" name="lastName" aria-describedby="lastName" placeholder="Last Name" value="<?php echo $user['lastName'] ?>">
                        </div>
                    </div>
                </div>
                <div class="form-group">
                    <div class="row">
                        <div class="col-md-5">
                            <label for="email">Email</label>
                            <input type="email" class="form-control" id="email" name="email" aria-describedby="email" placeholder="email" value="<?php echo $user['email'] ?>">
                        </div>
                        <div class="col-md-5">
                            <label for="phone">Phone</label>
                            <input type="text" class="form-control" id="phone" name="phone" aria-describedby="phone" placeholder="Phone" value="<?php echo $user['phone'] ?>">
                        </div>
                    </div>
                </div>
                <div class="form-group">
                    <div class="col-md-5">
                        <div class="row">

                            <label for="status">Status</label>
                            <select class="form-control" id="status" name="status">
                                <option <?php status("Active", $user['status']) ?>>Active</option>
                                <option <?php status("Pending", $user['status']) ?>>Pending</option>
                                <option <?php status("Disabled", $user['status']) ?>>Disabled</option>
                            </select>
                        </div>
                    </div>
                </div>

                <button type="submit" name="submit" class="btn btn-primary">Update User</button>
            </form>

        </div>

    </div>
</div>


</div>
</div>

</html>