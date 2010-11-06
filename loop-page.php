<?php
/*
    Page loop.
     Create page specific loops: `loop-<template name>.php`
*/

while ( have_posts() ) {
    the_post();
    
    /*
        Pass on the $name variable to dynamically
        load the specific content template.
    */
    get_template_part('content', $GLOBALS['template_part_name']);
}

?>