<?php
include "php/config.php";
include "php/functions.php";


if (isset($_POST['submit'])) {
    $firstName = $_POST['firstName'];
    $lastName = $_POST['lastName'];
    $email = $_POST['email'];
    $phone = $_POST['phone'];
    $password = $_POST['password'];
    $confirmPassword = $_POST['confirmPassword'];

    if (strcmp($password, $confirmPassword) != 0) {
        echo "<script>alert('Passwords Do Not Match')</script>";
    } else {
        try {
            $con = connect();
            $password = md5($password);
            $query = $con->prepare("INSERT INTO Users (firstName, lastName, email,phone,password,role_id,status) VALUES (?,?,?,?,?,2,'Active')");
            $query->bind_param("sssss", $firstName, $lastName, $email, $phone, $password);
            $query->execute();
            $result = $query->get_result();
            $con->close();
            echo "<script>alert('Successfully Registered')</script>";
        } catch (Exception $ex) {
            echo "<script>alert('Failed to Register')</script>";
        } finally {
            header("refresh:0;url=login.php");
        }
    }
}
?>

<html>

<head lang="en">
    <title>Register</title>
    <link rel="icon" href="images/logo.jpeg" type="image/x-icon">
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="bootstrap/css/bootstrap.min.css" />
    <link rel="stylesheet" href="css/styles.css" />
    <script src="https://code.jquery.com/jquery-3.1.0.min.js"></script>
    <script src="bootstrap/js/bootstrap.min.js"></script>
</head>

<div class="container-fluid sidebar">
    <br />
    <div class="row">
        <div class="col-md-4">
        </div>
        <div class="col-md-4">
            <div class="card">
                <div class="card-header">
                    <h4>Register</h4>
                </div>
                <div class="card-body">
                    <form method="POST">
                        <div class="form-group">
                            <div class="row">
                                <div class="col-md-12">
                                    <label for="firstName">First Name</label>
                                    <input type="text" class="form-control" id="firstName" name="firstName" aria-describedby="firstName" placeholder="First Name" />
                                </div>
                            </div>
                        </div>
                        <div class="form-group">
                            <div class="row">
                                <div class="col-md-12">
                                    <label for="lastName">Last Name</label>
                                    <input type="text" class="form-control" id="lastName" name="lastName" aria-describedby="lastName" placeholder="Last Name" />
                                </div>
                            </div>
                        </div>
                        <div class="form-group">
                            <div class="row">
                                <div class="col-md-12">
                                    <label for="email">Email</label>
                                    <input type="email" class="form-control" id="email" name="email" aria-describedby="email" placeholder="Email" />
                                </div>
                            </div>
                        </div>
                        <div class="form-group">
                            <div class="row">
                                <div class="col-md-12">
                                    <label for="phone">Phone</label>
                                    <input type="phone" class="form-control" id="phone" name="phone" aria-describedby="phone" placeholder="Phone" />
                                </div>
                            </div>
                        </div>
                        <div class="form-group">
                            <div class="row">
                                <div class="col-md-12">
                                    <label for="password">Password</label>
                                    <input type="password" class="form-control" id="password" name="password" aria-describedby="password" placeholder="Password" />
                                </div>
                            </div>
                        </div>
                        <div class="form-group">
                            <div class="row">
                                <div class="col-md-12">
                                    <label for="confirmPassword">Confirm Password</label>
                                    <input type="password" class="form-control" id="confirmPassword" name="confirmPassword" aria-describedby="confirmPassword" placeholder="Confirm Password" />
                                </div>
                            </div>
                        </div>
                        <button type="submit" name="submit" class="btn btn-primary">Register</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

</html>