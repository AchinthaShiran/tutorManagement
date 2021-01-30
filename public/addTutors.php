<?php
include "../php/config.php";
$error='';

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
    $err = $con->error;
    if(strcmp($err,"Duplicate entry '$email' for key 'email'")==0){
        $error = "Email Exist";
    } else if (strcmp($err,"Duplicate entry '$phone' for key 'phone'")==0){
        $error = "Phone Exist";
    }
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
                    <div class="row">
                        <div class="col-md-5">
                            <h2>Edit Tutor</h2>
                        </div>
                    </div>
                </div>
                <div class="form-group">
                    <div class="row">
                        <div class="col-md-5">
                            <label for="firstName">First Name</label>
                            <input type="text" class="form-control" id="firstName" name="firstName" aria-describedby="firstName" placeholder="First Name" >
                        </div>
                        <div class="col-md-5">
                            <label for="lastName">Last Name</label>
                            <input type="text" class="form-control" id="lastName" name="lastName" aria-describedby="lastName" placeholder="Last Name"  >
                        </div>
                    </div>
                </div>
                <div class="form-group">
                    <div class="row">
                        <div class="col-md-5">
                            <label for="email">Email</label>
                            <input type="email" class="form-control" id="email" name="email" aria-describedby="email" placeholder="email" >
                        </div>
                        <div class="col-md-5">
                            <label for="phone">Phone</label>
                            <input type="text" class="form-control" id="phone" name="phone" aria-describedby="phone" placeholder="Phone" >
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

                <button type="submit" name="submit" class="btn btn-primary">Submit</button>
                <small id="error" class="form-text text-muted"><?php echo $error ?></small>

            </form>

        </div>

    </div>
</div>

</html>