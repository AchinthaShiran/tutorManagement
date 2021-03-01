<?php

if (!checkPermissions("ATH", 1)) {
    echo "<script>window.location.replace('login.php'); </script>";
    exit;
}


function sideBarContent()
{
    $role = $_SESSION["user"]["role"];
    if (strcmp($role, "ADMIN") == 0) {
        return <<<HTML
        
        <li data-toggle="collapse" data-target="#tutorsMenu">
            <a href="#"><i class="fa fa-graduation-cap fa-lg"></i><span class="arrow"> Tutors</span></a>
        </li>
        <ul class="sub-menu collapse" id="tutorsMenu">
            <li><a href="viewTutors.php">View Tutors</a></li>
            <li><a href="addTutors.php">Add Tutors</a></li>
        </ul>

        <li data-toggle="collapse" data-target="#ebooksMenu" class="collapsed">
            <a href="#"><i class="fa fa-globe fa-lg"></i>Ebooks<span class="arrow"></span></a>
        </li>
        <ul class="sub-menu collapse" id="ebooksMenu">
            <li><a href="viewEbooks.php">View Ebooks</a></li>
            <li><a href="addEbook.php">Add Ebooks</a></li>
        </ul>
        
        <li data-toggle="collapse" data-target="#usersMenu" class="collapsed">
            <a href="#"><i class="fa fa-users fa-lg"></i> Users<span class="arrow"></span></a>
        </li>
        <ul class="sub-menu collapse" id="usersMenu">
            <li><a href="viewUsers.php">View Users </a> </li>
            <li><a href="addUser.php">Add User</a></li>
        </ul>


        <li>
            <a href="profile.php">
                <i class="fa fa-user fa-lg"></i> Profile
            </a>
        </li>
HTML;
    } else {
        return <<<HTML
        <li>
        <a href="viewTutors.php">
            <i class="fa fa-graduation-cap fa-lg"> </i> Tutors
        </a>
    </li>

    <li>
        <a href="viewEbooks.php">
            <i class="fa fa-user fa-lg"></i> Ebooks
        </a>
    </li>
    <li>
        <a href="profile.php">
            <i class="fa fa-user fa-lg"></i> Profile
        </a>
    </li>
HTML;
    }
}

?>

<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">

<div class="col-md-2">
    <div class="nav-side-menu">
        <div class="brand">Tutors For You</div>
        <i class="fa fa-bars fa-2x toggle-btn" data-toggle="collapse" data-target="#menu-content"></i>

        <div class="menu-list">


            <ul id="menu-content" class="menu-content collapse out">
                <li>
                    <a href="index.php">
                        <i class="fa fa-home fa-lg"></i> Home
                    </a>
                </li>

                <?php echo sideBarContent() ?>
                <li>
                    <a href="login.php">
                        <i class="fa fa-sign-out fa-lg"></i> Logout
                    </a>
                </li>
            </ul>
        </div>
    </div>
</div>