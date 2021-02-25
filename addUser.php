<?php
include "php/config.php";
include "php/functions.php";

if (!checkPermissions("USR", 1)) {
    header("HTTP/1.1 401 Unauthorized");
    exit;
}
?>

<html>

<head lang="en">
    <title>Add User</title>
    <link rel="icon" href="images/logo.jpeg" type="image/x-icon">
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
                        <h4>Add User</h4>
                    </div>
                    <div class="card-body">
                        <form method="POST" action="php/addUser.php">
                            <div class="form-group">
                                <div class="row">
                                    <div class="col-md-5">
                                        <label for="firstName">First Name</label>
                                        <input type="text" class="form-control" id="firstName" name="firstName" aria-describedby="firstName" placeholder="First Name" required/>
                                    </div>
                                    <div class="col-md-5">
                                        <label for="lastName">Last Name</label>
                                        <input type="text" class="form-control" id="lastName" name="lastName" aria-describedby="lastName" placeholder="Last Name" required/>
                                    </div>
                                </div>
                            </div>
                            <div class="form-group">
                                <div class="row">
                                    <div class="col-md-5">
                                        <label for="email">Email</label>
                                        <input type="email" class="form-control" id="email" name="email" aria-describedby="email" placeholder="email" required/>
                                    </div>
                                    <div class="col-md-5">
                                        <label for="phone">Phone</label>
                                        <input type="text" class="form-control" id="phone" name="phone" aria-describedby="phone" placeholder="Phone" required/>
                                    </div>
                                </div>
                            </div>
                            <div class="form-group">
                                <div class="col-md-5">
                                    <div class="row">

                                        <label for="status">Role</label>
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