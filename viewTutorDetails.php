<?php
include "php/config.php";
include "php/functions.php";


if (!checkPermissions("TTR", 1)) {
    header("HTTP/1.1 401 Unauthorized");
    exit;
}
if (isset($_GET['id'])) {
    $id = $_GET['id'];

    $con = connect();
    $con->begin_transaction();

    $query = $con->prepare("SELECT * FROM Tutors WHERE id=$id");
    $query->execute();
    $result = $query->get_result();
    $tutor = $result->fetch_assoc();

    $query = $con->prepare("SELECT * FROM Mediums WHERE tutor=$id");
    $query->execute();
    $result = $query->get_result();

    $mediums = array();

    while ($row = $result->fetch_assoc()) {
        array_push($mediums, $row);
    }

    $query = $con->prepare("SELECT * FROM Grades WHERE tutor=$id");
    $query->execute();
    $result = $query->get_result();

    $grades = array();

    while ($row = $result->fetch_assoc()) {
        array_push($grades, $row);
    }


    $con->commit();

    $con->close();
}

function printGrades($grades){
    foreach($grades as $grade){
        $grade = $grade['grade'];
        echo "<label>$grade,</label> ";
    }
}

function printMediums($mediums){
    foreach($mediums as $medium){
        $medium = $medium['medium'];
        echo "<label>$medium,</label> ";
    }
}

?>



<html>

<head lang="en">
    <title>Tutor Details</title>
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
                    <h4>Tutor Details</h4>
                </div>
                <div class="card-body">
                    <form>

                        <div class="form-group">
                            <div class="row">
                                <div class="col-md-4">
                                    <img src="tutorDp/<?php echo $tutor['dp'] ?>" width="300" height="300"  >
                                </div>
                                <div class="col-md-8">
                                    <div class="col-md-10">
                                        <label for="firstName"><b>Name : </b></label>
                                        <label><?php echo $tutor['firstName'] . " " . $tutor['lastName'] ?></label>
                                    </div>
                                    <div class="col-md-10">
                                        <label for="email"><b>Email : </b></label>
                                        <label><?php echo $tutor['email'] ?></label>
                                    </div>
                                    <div class="col-md-10">
                                        <label for="phone"><b>Phone : </b></label>
                                        <label><?php echo $tutor['phone'] ?></label>
                                    </div>
                                    <div class="col-md-10">
                                        <label for="phone"><b>Subject : </b></label>
                                        <label><?php echo $tutor['subject'] ?></label>
                                    </div>
                                    <div class="col-md-10">
                                        <label for="grades"><b>Grades : </b></label>
                                        <?php printGrades($grades) ?>
                                    </div>
                                    <div class="col-md-10">
                                        <label for="mediums"><b>Mediums : </b></label>
                                        <?php printMediums($mediums) ?>
                                    </div>
                                    <div class="col-md-5">
                                        <label for="phone"><b>About : </b></label>
                                    </div>
                                    <div class="col-md-10">
                                        <label style="white-space: pre-wrap;"><?php echo $tutor['about'] ?></label>
                                    </div>
                                </div>
                            </div>

                        </div>
                        <div class="form-group">
                            <div class="col-md-5">
                                <button type="button" onclick="location.href='viewTutors.php';" class="btn btn-primary">Go Back</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>

    </div>
</div>

</html>