<?php
include "php/config.php";
include "php/functions.php";


if (!checkPermissions("TTR", 2)) {
    header("HTTP/1.1 401 Unauthorized");
    exit;
}
if (isset($_GET['id'])) {
    $id = $_GET['id'];

    $con = connect();
    $query = $con->prepare("SELECT * FROM Tutors WHERE id=$id");
    $query->execute();
    $result = $query->get_result();
    $tutor = $result->fetch_assoc();

    $con->close();
}
?>

<html>

<head lang="en">
    <title>Update Tutor</title>
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
                    <h4>Edit Tutor</h4>
                </div>
                <div class="card-body">
                    <form method="POST" action="php/updateTutor.php" enctype="multipart/form-data">
                        <div class="form-group">
                            <div class="row">
                                <div class="col-md-5">
                                    <label for="firstName">First Name</label>
                                    <input type="text" class="form-control" id="firstName" name="firstName" aria-describedby="firstName" placeholder="First Name" value="<?php echo $tutor['firstName'] ?>" required>
                                </div>
                                <div class="col-md-5">
                                    <label for="lastName">Last Name</label>
                                    <input type="text" class="form-control" id="lastName" name="lastName" aria-describedby="lastName" placeholder="Last Name" value="<?php echo $tutor['lastName'] ?>" required>
                                </div>
                            </div>
                        </div>
                        <div class="form-group">
                            <div class="row">
                                <div class="col-md-5">
                                    <label for="email">Email</label>
                                    <input type="email" class="form-control" id="email" name="email" aria-describedby="email" placeholder="email" value="<?php echo $tutor['email'] ?>" required>
                                </div>
                                <div class="col-md-5">
                                    <label for="phone">Phone</label>
                                    <input type="text" class="form-control" id="phone" name="phone" aria-describedby="phone" placeholder="Phone" value="<?php echo $tutor['phone'] ?>" required>
                                </div>
                            </div>
                        </div>
                        <div class="form-group">
                            <div class="col-md-5">
                                <div class="row">

                                    <label for="subject">Subject</label>
                                    <select class="form-control" id="subject" name="subject" required>
                                     
                                        <option <?php dropDownValue("Sinhala", $tutor['subject']) ?>>Sinhala</option>
                                        <option <?php dropDownValue("English", $tutor['subject']) ?>>English</option>
                                        <option <?php dropDownValue("Tamil", $tutor['subject']) ?>>Tamil</option>
                                        <option <?php dropDownValue("Maths", $tutor['subject']) ?>>Maths</option>
                                        <option <?php dropDownValue("Science", $tutor['subject']) ?>>Science</option>
                                        <option <?php dropDownValue("History", $tutor['subject']) ?>>History</option>
                                        <option <?php dropDownValue("Geography", $tutor['subject']) ?>>Geography</option>
                                        <option <?php dropDownValue("IT", $tutor['subject']) ?>>IT</option>
                                        <option <?php dropDownValue("Health Science", $tutor['subject']) ?>>Health Science</option>
                                        <option <?php dropDownValue("Physics", $tutor['subject']) ?>>Physics</option>
                                        <option <?php dropDownValue("Chemistry", $tutor['subject']) ?>>Chemistry</option>
                                        <option <?php dropDownValue("Biology", $tutor['subject']) ?>>Biology</option>
                                    </select>
                                </div>
                            </div>
                        </div>
                        <div class="form-group">
                            <div class="col-md-10">
                                <div class="row">
                                    <label for="grades">Grades</label>
                                    <select multiple class="form-control" id="grades[]" name="grades[]" required>
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
                                    <select multiple class="form-control" id="mediums[]" name="mediums[]" size="3" required>
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
                                    <textarea class="form-control" id="about" name="about" aria-describedby="about" placeholder="About" required></textarea>
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
                                    <button type="submit" name="submit" class="btn btn-primary">Update Tutor</button>
                                </div>
                            </div>
                        </div>
                        <input name="id" id="id" type="hidden" value="<?php echo $id ?>" />
                        <input name="oldDp" id="oldDp" type="hidden" value="<?php echo $tutor['dp'] ?>" />
                    </form>
                </div>
            </div>
        </div>

    </div>
</div>

</html>