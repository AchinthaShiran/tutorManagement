<?php


function checkPermissions($module, $id)
{
    return in_array($id, $_SESSION['user']['permissions'][$module]);
}
