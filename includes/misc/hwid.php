<?php

namespace misc\hwid;

use misc\etc;
use misc\cache;
use misc\blacklist;
use misc\mysql;
use misc\token;



function add($hwid)
{
        $hid = etc\sanitize($hwid);
        $query = mysql\query("SELECT 1 FROM `hwids` WHERE `hwid` = ?", [$hid]);

        if ($query->num_rows > 0) {
                return 'already_exist';
        }

        $query = mysql\query("INSERT INTO `hwids` (`hwid`) VALUES (?)", [$hid]);
        if ($query->affected_rows > 0) {
                return 'success';
        } else {
                return 'failure';
        }
}
function deleteAll($secret = null)
{
        $query = mysql\query("DELETE FROM `hwids`");

        if ($query->affected_rows > 0) {
                return 'success';
        } else {
                return 'failure';
        }
}

function deleteSingular($hwid, $secret = null)
{
    $hid = etc\sanitize($hwid);


    $query = mysql\query("DELETE FROM `hwids` WHERE hwid = '$hid'");

    if ($query->affected_rows > 0) {
        return 'success';
    } else {
        return 'failure';
    }
}







