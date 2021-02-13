<?php
include "php/config.php";
include "php/functions.php";

if (!checkPermissions("EBK", 1)) {
    header("location: index.php");
    exit;
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
                    <h4>Add E-Book</h4>
                </div>
                <div class="card-body">
                    <form method="POST" action="php/addEbook.php" enctype="multipart/form-data">
                        <div class="form-group">
                            <div class="row">
                                <div class="col-md-5">
                                    <label for="ebookName">Book Name</label>
                                    <input type="text" class="form-control" id="ebookName" name="ebookName" aria-describedby="ebookName" placeholder="E-Book Name" />
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
                            <div class="col-md-5">
                                <div class="row">
                                    <label for="grade">Grade</label>
                                    <select class="form-control" id="grade" name="grade">
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
                            <div class="col-md-5">
                                <div class="row">

                                    <label for="medium">Medium</label>
                                    <select class="form-control" id="medium" name="medium">
                                        <option value="Sinhala">Sinhala</option>
                                        <option value="English">English</option>
                                        <option value="Tamil">Tamil</option>
                                    </select>
                                </div>
                            </div>
                        </div>
                        <div class="form-group">
                            <div class="row">
                                <div class="col-md-5">
                                    <input type="file" id="ebook" name="ebook" aria-describedby="ebook" />
                                </div>

                            </div>
                        </div>


                        <button type="submit" name="submit" class="btn btn-primary">Add Ebook</button>
                    </form>
                </div>
            </div>
        </div>

    </div>
</div>

</html>