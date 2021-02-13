<?php
include "php/config.php";
session_unset();

$con = connect();

if (isset($_POST['submit'])) {
    $logged = false;
    $email = $_POST['email'];
    $pass = $_POST['password'];
    echo $email;
    $query = $con->prepare("SELECT * FROM Users WHERE email=? AND password=?");
    $query->bind_param("ss", $email, $pass);
    $query->execute();
    $result = $query->get_result();
    $res = $result->fetch_assoc();

    if ($res) {
        $logged = true;
        $query = $con->prepare("SELECT * FROM Users LEFT JOIN Roles USING (role_id)  WHERE email=? AND password=?");
        $query->bind_param("ss", $email, $pass);
        $query->execute();
        $result = $query->get_result();
        $user = $result->fetch_assoc();

        $_SESSION["user"] =  $user;
        $_SESSION["user"]["permissions"] = [];
        unset($_SESSION['user']['password']);

        $role_id = $user['role_id'];
        $query = $con->prepare("SELECT * FROM Role_Permissions WHERE role_id=?");
        $query->bind_param("i", $role_id);
        $query->execute();
        $res = $query->get_result();

        while ($row = $res->fetch_assoc()) {
            if (!isset($_SESSION["user"]["permissions"][$row["perm_mod"]])) {
                $_SESSION["user"]["permissions"][$row["perm_mod"]] = [];
            }
            $_SESSION['user']['permissions'][$row['perm_mod']][] = $row['perm_id'];
        }
    }
    $con->close();

    if ($logged)
        if ($user['status'] == "Disabled") {
            print_r("User disabled");
            session_reset();
        } else
            header("Location: index.php");
    else
        print_r($email);
}

?>

<html lang="en">

<head>
    <title>Login</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="bootstrap/css/bootstrap.min.css" />
    <link rel="stylesheet" href="css/styles.css" />
    <script src="https://code.jquery.com/jquery-3.1.0.min.js"></script>
    <script src="bootstrap/js/bootstrap.min.js"></script>
</head>

<body>
    <div class="container login">
        <div class="d-flex align-items-center justify-content-center">
            <div class="col-md-5">
                <form method="POST">
                    <div class="form-group">
                        <h2>Login</h2>
                    </div>
                    <div class="form-group">
                        <label for="email" class="form-label">Email</label>
                        <input type="email" class="form-control" id="email" placeholder="Enter email" name="email">
                    </div>
                    <div class="form-group">
                        <label for="password" class="form-label">Password</label>
                        <input type="password" class="form-control" id="password" placeholder="Enter password" name="password">
                    </div>
                    <div class="form-group">
                        <div>
                            <button type="submit" name="submit" class="btn btn-primary">Submit</button>
                        </div>
                    </div>
                </form>
            </div>

        </div>
    </div>

</body>

</html>