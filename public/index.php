<?php

include "../php/config.php";

$con = connect();

if (isset($_POST['submit'])) {
    $logged = false;
    $email = $_POST['email'];
    $pass = $_POST['password'];

    $query = "SELECT * FROM Users WHERE email='$email' AND password='$pass'";
    $result = $con->query($query);

    $res = $result->fetch_assoc();
    if ($res) {
        $logged = true;
        $query = "SELECT * FROM Users LEFT JOIN Roles USING (role_id)  WHERE email='$email' AND password='$pass'";
        $result = $con->query($query);
        $user = $result->fetch_assoc();

        $_SESSION["user"] =  $user;
        $_SESSION["user"]["permissions"] = [];
        unset($_SESSION['user']['password']);

        $role_id = $user['role_id'];
        $query = "SELECT * FROM role_permissions WHERE role_id='$role_id'";
        $res = $con->query($query);

        while ($row = $res->fetch_assoc()) {
            if (!isset($_SESSION["user"]["permissions"][$row["perm_mod"]])) {
                $_SESSION["user"]["permissions"][$row["perm_mod"]] = [];
            }
            $_SESSION['user']['permissions'][$row['perm_mod']][] = $row['perm_id'];
        }




        //   header("Location: index.php");
    }

    if ($logged)
        header("Location: home.php");
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
    <div class="container center_div">
        <div class="col-md-4"></div>
        <div class="col-md-4">
            <div class="row align-items-center">
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
                            <button type="submit" name="submit" class="btn btn-default">Submit</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
        <div class="col-md-4"></div>
    </div>

</body>

</html>