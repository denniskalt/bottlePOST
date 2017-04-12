<?php
/**
 *
 * Strips HTML tags and converts predefined characters to HTML entities
 * 
 * @param string $input         Input-String
 * @param string $allowedTags   Optional string containing all allowed tags
 * @return string
 * 
 */
function filterHtml($input, $allowable_tags) {
    $input = htmlspecialchars($input);
    $output = strip_tags($input, $allowable_tags);
    return $output;
}

/**
 *
 * Removes whitespace from both sides of a string
 *
 * @param string $input         Input-String
 * @return string
 *
 */
function filterTrim($input) {
    $output = trim($input);
    return $output;
}

/**
 * 
 * Replace of potencial dangerous characters
 *
 * @param string $input         Input-String
 * @param string $pattern       Pattern for filter the URL
 * @return string
 *
 */
function filterUrlPart($input) {
    $pattern = "[a-zA-Z0-9\/.\&\?=]";
    $output = preg_replace($pattern, "", $input);
    return $output;
}

/**
 *
 * Replace of potencial dangerous characters
 *
 * @param string $input         Input-String
 * @param string $pattern       Pattern for filter the email adress
 * @return string
 *
 */
function filterEmail($input) {
    $output = filter_var($input, FILTER_SANITIZE_EMAIL);
    $pattern = '/[[A-Z0-9._%+-]+[ ]?[\(]?(@|at)[\)]?[ ]?[A-Z0-9.-]+[ ]?[\(]?(\.|dot)[)]?[ ]?[A-Z]{2,4}/i';
    if(preg_match($pattern, $input)) {
        return $output;
    } else {
        return false;
    }
}

/**
 *
 * Replace of potencial dangerous characters
 *
 * @param string $input         Input-String
 * @param string $pattern       Pattern for filter the phone number
 * @return string
 *
 */
function filterPhone($input) {
    $pattern = '\(?\+[0-9]{1,3}\)? ?-?[0-9]{1,3} ?-?[0-9]{3,5} ?-?[0-9]{4}( ?-?[0-9]{3})? ?(\w{1,10}\s?\d{1,6})?';
    $output = preg_replace($pattern, "", $input);
    return $output;
}

/**
 *
 * Converts a string to lowercase letters
 *
 * @param string $input         Input-String
 * @return string
 *
 */
function filterLowerCase($input) {
    $output = strtolower($input);
    return $output;
}

/**
 *
 * Converts a string to uppercase letters
 *
 * @param string $input         Input-String
 * @return string
 *
 */
function filterUpperCase($input) {
    $output = strtoupper($input);
    return $output;
}

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
    if(!strlen($input)===$length) {
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
function IsDate($input) {
    $date = 0;
    $date = split('\.',$datum);


    if (!checkdate($date[1], $date[0], $date[2])) {
        return false;
    }
    else {
        return true;
    }
}

/**
 *
 * Check if input is an email
 *
 * @param string $input     Input-String
 * @return boolean
 *
 */
function IsEmail($input) {
    if(!filter_var($input, FILTER_VALIDATE_EMAIL) === false) {
        return true;
    }
    else {
        return false;
    }
}

?>
