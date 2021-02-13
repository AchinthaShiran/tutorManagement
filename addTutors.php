<?php
include "php/config.php";
include "php/functions.php";

if (!checkPermissions("TTR", 3)) {
    header("location: index.php");
    exit;
}

$error = '';
if (isset($_POST['submit'])) {

    if (checkPermissions("TTR", 3)) {
        $firstName =  $_POST['firstName'];
        $lastName =  $_POST['lastName'];
        $email =  $_POST['email'];
        $phone =  $_POST['phone'];
        $subject =  $_POST['subject'];
        $about =  $_POST['about'];
        $grades = $_POST['grades'];
        $mediums = $_POST['mediums'];

        $fileName = $_FILES["dp"]["name"];
        $tempName = $_FILES["dp"]["tmp_name"];
        $folder = "tutorDp/" . $fileName;

        $con = connect();
        $con->begin_transaction();

        $query = $con->prepare("INSERT INTO Tutors (firstName, lastName, email,phone,subject,about,dp) VALUES (?,?,?,?,?,?,?)");
        $query->bind_param("sssssss", $firstName, $lastName, $email, $phone, $subject, $about, $fileName);
        $query->execute();
        $result = $query->get_result();
        $tutorId = $con->insert_id;

        foreach ($grades as $grade) {
            $query = $con->prepare("INSERT INTO grades (tutor,grade) VALUES (?,?)");
            $query->bind_param("is", $tutorId, $grade);
            $query->execute();
        }

        foreach ($mediums as $medium) {
            $query = $con->prepare("INSERT INTO mediums (tutor,medium) VALUES (?,?)");
            $query->bind_param("is", $tutorId, $medium);
            $query->execute();
        }

        $con->commit();
        $err = $con->error;

        if (strcmp($err, "Duplicate entry '$email' for key 'email'") == 0) {
            $error = "Email Exist";
        } else if (strcmp($err, "Duplicate entry '$phone' for key 'phone'") == 0) {
            $error = "Phone Exist";
        } else {
            if (move_uploaded_file($tempName, $folder)) {
                $stts = "dp uploaded successfully";
            } else {
                $stts = "Failed to upload dp";
            }
        }
        $con->close();
    } else {
        header("HTTP/1.1 401 Unauthorized");
        exit;
    }
}
?>

<html>

<head lang="en">
    <title>Add Tutors</title>
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
                    <h4>Add Tutor</h4>
                </div>
                <div class="card-body">
                    <form method="POST" enctype="multipart/form-data">
                        <div class="form-group">
                            <div class="row">
                                <div class="col-md-5">
                                    <label for="firstName">First Name</label>
                                    <input type="text" class="form-control" id="firstName" name="firstName" aria-describedby="firstName" placeholder="First Name" />
                                </div>
                                <div class="col-md-5">
                                    <label for="lastName">Last Name</label>
                                    <input type="text" class="form-control" id="lastName" name="lastName" aria-describedby="lastName" placeholder="Last Name" />
                                </div>
                            </div>
                        </div>
                        <div class="form-group">
                            <div class="row">
                                <div class="col-md-5">
                                    <label for="email">Email</label>
                                    <input type="email" class="form-control" id="email" name="email" aria-describedby="email" placeholder="email" />
                                </div>
                                <div class="col-md-5">
                                    <label for="phone">Phone</label>
                                    <input type="text" class="form-control" id="phone" name="phone" aria-describedby="phone" placeholder="Phone" />
                                </div>
                            </div>
                        </div>
                        <div class="form-group">
                            <div class="col-md-5">
                                <div class="row">

                                    <label for="subject">Subject</label>
                                    <select class="form-control" id="subject" name="subject">
                                        <option>Subject1</option>
                                        <option>Subject2</option>
                                        <option>Subject3</option>
                                        <option>Subject4</option>
                                        <option>Subject5</option>
                                    </select>
                                </div>
                            </div>
                        </div>
                        <div class="form-group">
                            <div class="col-md-10">
                                <div class="row">
                                    <label for="grades">Grades</label>
                                    <select multiple class="form-control" id="grades[]" name="grades[]">
                                        <option value="Grade 1">Grade 1</option>
                                        <option value="Grade 2">Grade 2</option>
                                        <option value="Grade 3">Grade 3</option>
                                        <option value="Grade 4">Grade 4</option>
                                        <option value="Grade 5">Grade 5</option>
                                        <option value="Grade 6">Grade 6</option>
                                        <option value="Grade 7">Grade 7</option>
                                        <option value="Grade 8">Grade 8</option>
                                        <option value="Grade 9">Grade 9</option>
                                        <option value="Grade 10">Grade 10</option>
                                        <option value="Grade 11">Grade 11</option>
                                        <option value="Grade 12">Grade 12</option>
                                    </select>
                                </div>
                            </div>
                        </div>
                        <div class="form-group">
                            <div class="col-md-10">
                                <div class="row">

                                    <label for="mediums">Mediums</label>
                                    <select multiple class="form-control" id="mediums[]" name="mediums[]" size="3">
                                        <option value="Sinhala">Sinhala</option>
                                        <option value="English">English</option>
                                        <option value="Tamil">Tamil</option>
                                    </select>
                                </div>
                            </div>
                        </div>
                        <div class="form-group">
                            <div class="row">

                                <div class="col-md-10">
                                    <label for="about">About</label>
                                    <textarea class="form-control" id="about" name="about" aria-describedby="about" placeholder="About"></textarea>
                                </div>
                            </div>
                        </div>
                        <div class="form-group">
                            <div class="row">
                                <div class="col-md-5">
                                    <label for="dp">Tutor Photo : </label><br />
                                    <input type="file" id="dp" name="dp" aria-describedby="dp" required />
                                </div>

                            </div>
                        </div>
                        <div class="form-group">
                            <div class="row">
                                <div class="col-md-5">
                                    <button type="submit" name="submit" class="btn btn-primary">Add Tutor</button>
                                </div>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>

    </div>
</div>

</html>