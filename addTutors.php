<?php
include "php/config.php";
include "php/functions.php";

if (!checkPermissions("TTR", 3)) {
    header("HTTP/1.1 401 Unauthorized");
    exit;
}
?>

<html>

<head lang="en">
    <title>Add Tutors</title>
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
                    <h4>Add Tutor</h4>
                </div>
                <div class="card-body">
                    <form method="POST" action="php/addTutor.php" enctype="multipart/form-data">
                        <div class="form-group">
                            <div class="row">
                                <div class="col-md-5">
                                    <label for="firstName">First Name</label>
                                    <input type="text" class="form-control" id="firstName" name="firstName" aria-describedby="firstName" placeholder="First Name" required />
                                </div>
                                <div class="col-md-5">
                                    <label for="lastName">Last Name</label>
                                    <input type="text" class="form-control" id="lastName" name="lastName" aria-describedby="lastName" placeholder="Last Name" required />
                                </div>
                            </div>
                        </div>
                        <div class="form-group">
                            <div class="row">
                                <div class="col-md-5">
                                    <label for="email">Email</label>
                                    <input type="email" class="form-control" id="email" name="email" aria-describedby="email" placeholder="email" required />
                                </div>
                                <div class="col-md-5">
                                    <label for="phone">Phone</label>
                                    <input type="text" class="form-control" id="phone" name="phone" aria-describedby="phone" placeholder="Phone" required />
                                </div>
                            </div>
                        </div>
                        <div class="form-group">
                            <div class="col-md-5">
                                <div class="row">

                                    <label for="subject">Subject</label>
                                    <select class="form-control" id="subject" name="subject" required>
                                        <option>Sinhala</option>
                                        <option>English</option>
                                        <option>Tamil</option>
                                        <option>Maths</option>
                                        <option>Science</option>
                                        <option>History</option>
                                        <option>Geography</option>
                                        <option>IT</option>
                                        <option>Health Science</option>
                                        <option>Physics</option>
                                        <option>Chemistry</option>
                                        <option>Biology</option>
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