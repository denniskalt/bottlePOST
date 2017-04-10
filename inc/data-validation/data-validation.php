<?php
/**
 *
 * Strips HTML tags
 * 
 * @param string $input         Input-String
 * @param string $allowedTags   Optional string containing all allowed tags
 * @return string
 * 
 */
function filterHtml($input, $allowable_tags) {
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
    $output = preg_replace($pattern, $input);
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
    $pattern = "^([a-zA-Z0-9_\-\.]+)@([a-zA-Z0-9_\-\.]+)\.([a-zA-Z]{2,5})$";
    $output = preg_replace($pattern, $input);
    return $output;
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
    $output = preg_replace($pattern, $input);
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
 * Converts predefined characters to HTML entities
 *
 * @param string $input         Input-String
 * @return string
 *
 */
function filterHtml($input) {
    $output = htmlspecialchars($input);
    return $output;
}
?>
