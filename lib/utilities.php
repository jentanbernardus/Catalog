<?php 
/*
    Catalog Utilities

    01 - word_count
    01 - plural
    02 - get_relative_date
    03 - the_relative_date
*/

/*
    Returns the wordcount.
*/
function word_count(  ) {
    $content = get_the_content();
    return sizeof(explode(" ", $content));
}

/*
    Returns "s" unless $num is "1"
    Used by `relative_date`.
*/
function plural( $num ) {
    if ($num != 1)
        return "s";
}

/*
    Returns relative(more human) date string.
    Uses: `plural`.

    Usage:
    `get_relative_date(get_the_date())`
*/
function get_relative_date( $date ) {
    $diff = time() - strtotime($date);
    if ($diff < 60)
        return $diff." second".plural($diff)." ago";
    $diff = round($diff / 60);
    if ($diff < 60)
        return $diff." minute".plural($diff)." ago";
    $diff = round($diff / 60);
    if ($diff < 24)
        return $diff." hour".plural($diff)." ago";
    $diff = round($diff / 24);
    if ($diff < 7)
        return $diff." day".plural($diff)." ago";
    $diff = round($diff / 7);
    if ($diff < 4)
        return $diff." week".plural($diff)." ago";
    return date("F j, Y", strtotime($date));
}

/*
    Return the post date in relative format.
    Uses: `get_relative_date()`

    Must be used within the loop.
*/
function the_relative_date( $fallback = 'F d, Y' ) {
    if (function_exists('get_relative_date')) {
        echo get_relative_date(get_the_date());
    }
    else {
        echo get_the_date($fallback);
    }
}