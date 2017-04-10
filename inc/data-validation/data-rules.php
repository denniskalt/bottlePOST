<?php
/**
 *
 * Check for minimal length
 *
 * @param string $input         Input-String
 * @param int $length           minimal length of the string
 * @return boolean
 *
 */
function MinLength($input, $length) {
    if(strlen($input)<$length) {
        return false;
    }
    else {
        return true;
    }
}

/**
 *
 * Check for maximal length
 *
 * @param string $input         Input-String
 * @param int $length           maximal length of the string
 * @return boolean
 *
 */
function MaxLength($input, $length) {
    if(strlen($input)>$length) {
        return false;
    }
    else {
        return true;
    }
}

/**
 *
 * Check for exact length
 *
 * @param string $input         Input-String
 * @param int $length           exact length of the string
 * @return boolean
 *
 */
function ExactLength($input, $length) {
    if(!strlen($input)=$length) {
        return false;
    }
    else {
        return true;
    }
}

/**
 *
 * Check for min length
 *
 * @param string $input         Input-String
 * @param int $length           minimal length of the string
 * @return boolean
 *
 */
function LengthRange($input, $lengthMin, $lengthMax) {
    if (strlen($input) < $lengthMin || strlen($input) > $lengthMax) {
        return false;
    }
    else {
        return true;
    }
}

/**
 *
 * Check if input is numeric
 *
 * @param int $input         Input-String
 * @return boolean
 *
 */
function IsNum($input) {
    if (!is_numeric($input)) {
        return false;
    }
    else {
        return true;
    }
}

/**
 *
 * Check if input is a date string
 *
 * @param date $input         Input-String
 * @return boolean
 *
 */
$date = 0;
$date = split('\.',$datum);


if (!checkdate($date[1], $date[0], $date[2])) {
        return false;
    }
    else {
        return true;
    }

?>
