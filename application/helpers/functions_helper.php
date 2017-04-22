<?php
function uuid() {
    return sprintf( '%04x%04x-%04x-%04x-%04x-%04x%04x%04x',
        mt_rand( 0, 0xffff ), mt_rand( 0, 0xffff ),
        mt_rand( 0, 0xffff ),
        mt_rand( 0, 0x0fff ) | 0x4000,
        mt_rand( 0, 0x3fff ) | 0x8000,
        mt_rand( 0, 0xffff ), mt_rand( 0, 0xffff ), mt_rand( 0, 0xffff )
    );
}


function dateTimeSplit($dateTime, &$date, &$time) {
    $matches = null;
    $result = preg_match('/(([0-9]+\\/){2}[0-9]{4}) ([0-9]{2}:[0-9]{2})/', $dateTime, $matches);
    if($result == 1) {
        $preDate = $matches[1];
        $preDateSplit = explode("/", $preDate);

        $date = implode("-", array_reverse($preDateSplit));
        $time = $matches[3];
    }
}
?>