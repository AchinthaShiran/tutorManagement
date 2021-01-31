<?php


function checkPermissions($module, $id)
{
    return in_array($id, $_SESSION['user']['permissions'][$module]);
}

function dropDownValue($option, $status)
{
    if (strcmp($status, $option) == 0) {
        echo "selected";
    }
}
