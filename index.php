<?php
include "php/config.php";
include "php/functions.php";

?>

<html>

<head lang="en">
    <title>Home</title>
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
            <br />
            <div class="row">
                <div class="col-md-12">
                    <div class="jumbotron">
                        <h1 style="font-weight: 700; " class="display-4">Start Your Lessons This Week!</h1>
                        <p style="font-weight: 500; " class="lead">Discover a new way of learning!!</p>
                        <hr class="my-4">
                        <div class="row">
                            <div class="col-md-4">
                                <div class="card" style="width: 18rem;">
                                    <img class="card-img-top" src="images/1.jpg" alt="Card image cap">
                                    <div class="card-body">
                                        <h6 class="card-text">Select your subjects</h6>
                                        <p class="card-text">Some quick example text to build on the card title and make up the bulk of the card's content.</p>
                                    </div>
                                </div>
                            </div>

                            <div class="col-md-4">
                                <div class="card" style="width: 18rem;">
                                    <img class="card-img-top" src="images/2.png" alt="Card image cap">
                                    <div class="card-body">
                                        <h6 class="card-text">Select your weekly date and time</h6>
                                        <p class="card-text">Some quick example text to build on the card title and make up the bulk of the card's content.</p>
                                    </div>
                                </div>
                            </div>

                            <div class="col-md-4">
                                <div class="card" style="width: 18rem;">
                                    <img class="card-img-top" src="images/3.jpg" alt="Card image cap">
                                    <div class="card-body">
                                        <h6 class="card-text">Manage everything online</h6>
                                        <p class="card-text">Some quick example text to build on the card title and make up the bulk of the card's content.</p>
                                    </div>
                                </div>
                            </div>


                        </div>
                    </div>
                </div>

            </div>
        </div>

    </div>
</div>

</html>