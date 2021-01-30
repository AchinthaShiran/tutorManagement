<?php
include "../php/config.php";
function sideBarContent()
{
    $role = $_SESSION["user"]["role"];
    if (strcmp($role, "ADMIN")==0) {
        return <<<HTML
        
        <li data-toggle="collapse" data-target="#tutorsMenu" class="collapsed active">
            <a href="#"><i class="fa fa-gift fa-lg"></i><span class="arrow">Tutors</span></a>
        </li>
        <ul class="sub-menu collapse" id="tutorsMenu">
            <li class="active"><a href="#">Add Tutors</a></li>
            <li><a href="#">View Tutors</a></li>
        </ul>

        <li data-toggle="collapse" data-target="#ebooksMenu" class="collapsed">
            <a href="#"><i class="fa fa-globe fa-lg"></i>Ebooks<span class="arrow"></span></a>
        </li>
        <ul class="sub-menu collapse" id="ebooksMenu">
            <li class="active"><a href="#">Add Ebooks</a></li>
            <li><a href="#">View Ebooks</a></li>
        </ul>


        <li>
            <a href="#">
                <i class="fa fa-user fa-lg"></i> Users
            </a>
        </li>

        <li>
            <a href="#">
                <i class="fa fa-user fa-lg"></i> Profile
            </a>
        </li>
HTML;
    } else {
        return <<<HTML
        <li>
        <a href="#">
            <i class="fa fa-user fa-lg"></i> Tutors
        </a>
    </li>

    <li>
        <a href="#">
            <i class="fa fa-user fa-lg"></i> Ebooks
        </a>
    </li>


    <li>
        <a href="#">
            <i class="fa fa-user fa-lg"></i> Users
        </a>
    </li>

    <li>
        <a href="#">
            <i class="fa fa-user fa-lg"></i> Profile
        </a>
    </li>
HTML;
    }
}

?>




<link href="//maxcdn.bootstrapcdn.com/font-awesome/4.2.0/css/font-awesome.min.css" rel="stylesheet">


<div class="col-md-2">
    <div class="nav-side-menu">
        <div class="brand">Tutor Management System</div>
        <i class="fa fa-bars fa-2x toggle-btn" data-toggle="collapse" data-target="#menu-content"></i>

        <div class="menu-list">

            <ul id="menu-content" class="menu-content collapse out">
                <li>
                    <a href="#">
                        <i class="fa fa-dashboard fa-lg"></i> Dashboard
                    </a>
                </li>

                <?php echo sideBarContent() ?>

            </ul>
        </div>
    </div>
</div>