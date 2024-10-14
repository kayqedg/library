<?php


function levelVerify($level)
{
    if ($level == 'user') {
        $msg = 'hidden';
    } else {
        $msg = '';
    }

    return $msg;
}
;

?>