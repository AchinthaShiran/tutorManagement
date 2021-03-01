<?php
include "php/config.php";
include "php/functions.php";


if (!checkPermissions("USR", 5)) {
    header("location: index.php");
    exit;
}

$id = $_SESSION['user']['id'];

$con = connect();
$query = $con->prepare("SELECT * FROM Users WHERE id=?");
$query->bind_param("i", $id);
$query->execute();
$result = $query->get_result();
$user = $result->fetch_assoc();
$con->close();

$active = "profile";

if (isset($_POST['submit'])) {
    if (checkPermissions("USR", 5)) {
        $firstName =  $_POST['firstName'];
        $lastName =  $_POST['lastName'];
        $phone =  $_POST['phone'];
        $password = $_POST['password'];
        $newPassword = $_POST['newPassword'];
        $confirmPassword = $_POST['confirmPassword'];

        $password = md5($password);
        if ($password == $user['password']) {
            $con = connect();
            $query = '';
            if (strlen($newPassword) > 0) {
                if ($newPassword == $confirmPassword) {
                    $query = $con->prepare("UPDATE Users SET firstName=?, lastName=?,phone=?,password=? WHERE id=?");
                    $query->bind_param("ssssi", $firstName, $lastName, $phone, $password, $id);
                } else {
                    echo "passwords do not match";
                }
            } else {
                $query = $con->prepare("UPDATE Users SET firstName=?, lastName=?,phone=? WHERE id=?");
                $query->bind_param("sssi", $firstName, $lastName, $phone, $id);
            }
            $query->execute();

            $result = $query->get_result();
            $con->close();
            echo "<meta http-equiv='refresh' content='0'>";
            echo "<script>alert('Profile Updated Successfully')</script>";
        } else {
            echo "<script>alert('Please enter your password')</script>";
        }
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
    <title>Profile</title>
    <link rel="icon" href="images/icon.png" type="image/x-icon">
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
        <div class="col-md-9">
            <br>
            <div class="card">
                <div class="card-header">
                    <h5>Edit Profile</h5>
                </div>
                <div class="card-body">
                    <form method="POST">
                       
                        <div class="form-group">
                            <div class="row">
                                <div class="col-md-5">
                                    <label for="firstName">First Name</label>
                                    <input type="text" class="form-control" id="firstName" name="firstName" aria-describedby="firstName" placeholder="First Name" value="<?php echo $user['firstName'] ?>" required>
                                </div>
                                <div class="col-md-5">
                                    <label for="lastName">Last Name</label>
                                    <input type="text" class="form-control" id="lastName" name="lastName" aria-describedby="lastName" placeholder="Last Name" value="<?php echo $user['lastName'] ?>" required>
                                </div>
                            </div>
                        </div>
                        <div class="form-group">
                            <div class="row">
                                <div class="col-md-5">
                                    <label for="phone">Phone</label>
                                    <input type="text" class="form-control" id="phone" name="phone" aria-describedby="phone" placeholder="Phone" value="<?php echo $user['phone'] ?>" required>
                                </div>
                            </div>
                        </div>

                        <div class="form-group">
                            <div class="row">
                                <div class="col-md-5">
                                    <label for="firstName">New Password</label>
                                    <input type="password" class="form-control" id="newPassword" name="newPassword" aria-describedby="newPassword" placeholder="New Password">
                                </div>
                                <div class="col-md-5">
                                    <label for="lastName">Confirm Password</label>
                                    <input type="password" class="form-control" id="confirmPassword" name="confirmPassword" aria-describedby="confirmPassword" placeholder="Confirm Password">
                                </div>
                            </div>
                        </div>
                        <div class="form-group">
                            <div class="row">
                                <div class="col-md-5">
                                    <label for="phone">Password</label>
                                    <input type="password" class="form-control" id="password" name="password" aria-describedby="password" placeholder="Password" required>
                                </div>
                            </div>
                        </div>
                        <button type="submit" name="submit" class="btn btn-primary">Update Profile</button>
                    </form>
                </div>

            </div>
        </div>

    </div>
</div>



</html>