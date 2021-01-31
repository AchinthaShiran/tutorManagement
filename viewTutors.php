<?php
include "php/config.php";
include "php/functions.php";

$con = connect();
$query = $con->prepare("SELECT * FROM Tutors");
$query->execute();
$result = $query->get_result();


$tutors = array();

while ($row = $result->fetch_assoc()) {
    array_push($tutors, $row);
}

$con->close();

function get($tutors)
{
    $role = $_SESSION['user']['role'];

    foreach ($tutors as $tutor) {
        $name = $tutor['firstName'] . " " . $tutor['lastName'];
        $subject = $tutor['subject'];
        $email = $tutor['email'];
        $phone = $tutor['phone'];
        $id = $tutor['id'];

        echo "        
        <tr>
        <td>$name</td>
        <td>$subject</td>
        <td>$email</td>
        <td>$phone</td>";

        if (strcmp($role, "ADMIN") == 0) {
            echo "<td><button onclick=\"location.href = 'updateTutor.php?id=$id'\"  class=\"btn btn-primary\">View</button></td>";
        }

        echo "</tr>";
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
            <table class="table table-hover">
                <thead>
                    <tr>
                        <th scope="col">Name</th>
                        <th scope="col">Subject</th>
                        <th scope="col">Email</th>
                        <th scope="col">Phone</th>
                        <th scope="col"></th>
                    </tr>
                </thead>
                <tbody>
                    <?php get($tutors) ?>
                </tbody>
            </table>
        </div>

    </div>
</div>

</html>