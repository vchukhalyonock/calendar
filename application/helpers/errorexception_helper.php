<?php
function exception_error_handler($errno, $errstr) {
    throw new Exception($errstr, $errno);
}

set_error_handler("exception_error_handler");