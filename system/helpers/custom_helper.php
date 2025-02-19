<?php
defined('BASEPATH') OR exit('No direct script access allowed');

if (!function_exists('format_date')) {
    function format_date($date, $format = 'd M, Y') {
        return date($format, strtotime($date));
    }
}

if (!function_exists('get_site_name')) {
    function get_site_name() {
        return "My Custom Site";
    }
}

if (!function_exists('pr')) {
    function pr($data, $exit = true, $echoPre = true): void {
        //return "My Custom Site";
        if ($echoPre !== false) {
            echo "<pre>";
        }
        print_r($data);
        if ($exit !== false) {
            exit(0);
        }
    }
}