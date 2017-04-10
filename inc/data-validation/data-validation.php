<?php
/**
 *
 * Strips HTML tags
 * 
 * @param string $input         Input-Eingabezeichenkette
 * @param string $allowedTags   Optional string containing all allowed tags
 * @return string $output;
 * 
 */
function filterHtml($input, $allowable_tags) {
    $output = strip_tags($input, $allowable_tags);
    return $output;
}

/**
 * 
 * Replace of potencial dangerous characters
 *
 *
 */
function filterUrlPart($input) {
    preg_replace(
}
?>