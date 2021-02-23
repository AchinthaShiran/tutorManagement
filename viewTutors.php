<?php
include "php/config.php";
include "php/functions.php";

$role = $_SESSION['user']['role'];


$con = connect();

$subject = '%';
if (isset($_GET['subjectSelect'])) {
    $subject = $_GET['subjectSelect'];
}

$query = $con->prepare("SELECT * FROM Tutors WHERE subject LIKE ?");
$query->bind_param("s", $subject);
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
        echo "<td><button onclick=\"location.href = 'viewTutorDetails.php?id=$id'\"  class=\"btn btn-primary\">View</button></td>";

        if (strcmp($role, "ADMIN") == 0) {
            echo "<td><button onclick=\"location.href = 'updateTutor.php?id=$id'\"  class=\"btn btn-primary\">Edit</button></td>";
        }

        echo "</tr>";
    }
}

?>
<html>

<head lang="en">
    <title>View Tutors</title>
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
        <div class="col-md-10">
            <br>
            <div class="card">
                <div class="card-header">
                    <div class="row">
                        <div class="col-md-9">
                            <h4>Browse Tutors</h4>
                        </div>
                        <div class="col-md-3 float-right">
                            <form name="search" id="search" method="GET">
                                <div class="input-group input-group-sm">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text" id="inputGroup-sizing-sm">Subject : </span>
                                    </div>
                                    <select class="form-control" name="subjectSelect" id="subjectSelect" onchange="this.form.submit()">
                                        <option value="%" <?php dropDownValue($subject, "") ?>>All</option>
                                        <option <?php dropDownValue($subject, "Subject1") ?>>Subject1</option>
                                        <option <?php dropDownValue($subject, "Subject2") ?>>Subject2</option>
                                        <option <?php dropDownValue($subject, "Subject3") ?>>Subject3</option>
                                        <option <?php dropDownValue($subject, "Subject4") ?>>Subject4</option>
                                        <option <?php dropDownValue($subject, "Subject5") ?>>Subject5</option>
                                    </select>
                                </div>


                            </form>
                        </div>
                    </div>
                    </form>
                </div>
                <div class="card-body table-responsive p-0" style="height: 600px;">
                    <table class="table table-hover table-head-fixed text-nowrap">
                        <colgroup>
                            <col span="1" style="width: 40%;">
                            <col span="1" style="width: 15%;">
                            <col span="1" style="width: 20%;">
                            <col span="1" style="width: 15%;">
                            <col span="1" style="width: 5%;">
                            <col span="1" style="width: 5%;">
                        </colgroup>
                        <thead>
                            <tr>
                                <th scope="col">Name</th>
                                <th scope="col">Subject</th>
                                <th scope="col">Email</th>
                                <th scope="col">Phone</th>
                                <th scope="col"></th>
                                <?php
                                if (strcmp($role, "ADMIN") == 0) {
                                    echo "<th></th>";
                                }
                                ?>
                            </tr>
                        </thead>
                        <tbody>
                            <?php get($tutors) ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>

    </div>
</div>

</html>