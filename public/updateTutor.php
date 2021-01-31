<?php
include "../php/config.php";
include "../php/functions.php";


if (!checkPermissions("TTR",2)) {
    header("location: home.php");
    exit; 
}
if (isset($_GET['id'])) {
    $id = $_GET['id'];

    $con = connect();
    $query = "SELECT * FROM Tutors WHERE id=$id";
    $result = $con->query($query);
    $tutor = $result->fetch_assoc();
    $con->close();
}

if(isset($_POST['submit'])){
    if(checkPermissions("TTR",2)){
        $firstName =  $_POST['firstName'];
        $lastName =  $_POST['lastName'];
        $email =  $_POST['email'];
        $phone =  $_POST['phone'];
        $subject =  $_POST['subject'];
        
        $con = connect();
        $query = $con->prepare("UPDATE Tutors SET firstName=?, lastName=?, email=?, phone=?, subject=? WHERE id=?");
        $query->bind_param("sssssi",$firstName,$lastName,$email,$phone,$subject,$id);
        $query->execute();
        $result = $query->get_result();
        $con->close(); 
        echo "<meta http-equiv='refresh' content='0'>";
    } else {
        header("HTTP/1.1 401 Unauthorized");
        exit;
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
                            <input type="text" class="form-control" id="firstName" name="firstName" aria-describedby="firstName" placeholder="First Name" value="<?php echo $tutor['firstName'] ?>">
                        </div>
                        <div class="col-md-5">
                            <label for="lastName">Last Name</label>
                            <input type="text" class="form-control" id="lastName" name="lastName" aria-describedby="lastName" placeholder="Last Name"  value="<?php echo $tutor['lastName'] ?>">
                        </div>
                    </div>
                </div>
                <div class="form-group">
                    <div class="row">
                        <div class="col-md-5">
                            <label for="email">Email</label>
                            <input type="email" class="form-control" id="email" name="email" aria-describedby="email" placeholder="email"  value="<?php echo $tutor['email'] ?>">
                        </div>
                        <div class="col-md-5">
                            <label for="phone">Phone</label>
                            <input type="text" class="form-control" id="phone" name="phone" aria-describedby="phone" placeholder="Phone"  value="<?php echo $tutor['phone'] ?>">
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

                <button type="submit" name="submit" class="btn btn-primary">Update Tutor</button>
            </form>

        </div>

    </div>
</div>

</html>