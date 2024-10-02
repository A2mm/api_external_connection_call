<?php


if (!function_exists("paginationSize")) {
    function paginationSize($per_page = 10): int
    {
        return $per_page;
    }
}
