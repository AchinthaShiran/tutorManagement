<?php
include "php/config.php";
include "php/functions.php";

if (!checkPermissions("EBK", 2)) {
    header("HTTP/1.1 401 Unauthorized");
    exit;
}


$role = $_SESSION['user']['role'];


$subject = '%';
if (isset($_GET['subjectSelect'])) {
    $subject = $_GET['subjectSelect'];
}

$con = connect();
$query = $con->prepare("SELECT * FROM Ebooks WHERE subject LIKE ?");
$query->bind_param("s", $subject);
$query->execute();
$result = $query->get_result();

$ebooks = array();

while ($row = $result->fetch_assoc()) {
    array_push($ebooks, $row);
}

function get($ebooks)
{

    $role = $_SESSION['user']['role'];
    foreach ($ebooks as $ebook) {
        $bookName = $ebook['ebookName'];
        $subject = $ebook['subject'];
        $fileName = $ebook['fileName'];
        $bookId = $ebook['bookId'];
        $grade = $ebook['grade'];
        $medium = $ebook['medium'];
        echo "        
        <tr>
        <td>$bookName</td>
        <td>$subject</td>
        <td>$grade</td>
        <td>$medium</td>
        <td><button onclick=\"location.href = 'ebooks/$fileName'\"  class=\"btn btn-primary\">View</button></td>";

        if (strcmp($role, "ADMIN") == 0) {
            echo "<td><button onclick=\"location.href = 'php/deleteEbook.php?book_id=$bookId&file_name=$fileName'\" class=\"btn btn-danger\">Delete</button></td>";
        }

        echo "</tr>";
    }
}


?>

<html>

<head lang="en">
    <title>View Tutors</title>
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
                            <h4>Browse Ebooks</h4>
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
                                <col span="1" style="width: 20%;">
                                <col span="1" style="width: 15%;">
                                <col span="1" style="width: 15%;">
                                <col span="1" style="width: 5%;">
                                <col span="1" style="width: 5%;">
                            </colgroup>
                            <thead>
                                <tr>
                                    <th scope="col">E-Book</th>
                                    <th scope="col">Subject</th>
                                    <th scope="col">Grade</th>
                                    <th scope="col">Medium</th>
                                    <th scope="col"></th>
                                    <?php
                                    if (strcmp($role, "ADMIN") == 0) {
                                        echo "<th></th>";
                                    }
                                    ?>
                                </tr>
                            </thead>
                            <tbody>
                                <?php get($ebooks) ?>
                            </tbody>
                        </table>
                </div>
            </div>
        </div>

    </div>
</div>

</html>