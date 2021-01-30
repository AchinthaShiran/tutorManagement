<?php
include "../php/config.php";

if (isset($_POST['submit'])) {
    $firstName =  $_POST['firstName'];
    $lastName =  $_POST['lastName'];
    $email =  $_POST['email'];
    $phone =  $_POST['phone'];
    $subject =  $_POST['subject'];

    $con = connect();
    $query = "INSERT INTO Tutors (firstName, lastName, email,phone,subject)
    VALUES ('$firstName', '$lastName', '$email','$phone','$subject')";


    $result = $con->query($query);
   
        echo $con->error;
    
    $con->close();
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
        <div class="col-md-10">
            <form method="POST">
                <div class="form-group">
                    <label for="firstName">First Name:</label>
                    <input type="text" name="firstName" id="firstName" />
                </div>
                <div class="form-group">
                    <label for="lastName">Last Name:</label>
                    <input type="text" name="lastName" id="lastName" />
                </div>
                <div class="form-group">
                    <label for="subject">Subject:</label>
                    <input type="text" name="subject" id="subject" />
                </div>
                <div class="form-group">
                    <label for="phone">Phone:</label>
                    <input type="text" name="phone" id="phone" />
                </div>
                <div class="form-group">
                    <label for="email">Email:</label>
                    <input type="text" name="email" id="email" />
                </div>
                <div class="form-group">
                    <input type="submit" name="submit" id="submit" />
                </div>
            </form>

        </div>

    </div>
</div>

</html>