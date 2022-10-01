<?php

if (!function_exists('getImages')) {
    function getImages($str)
    {
        return preg_split('/(.),(.)/', str_replace('[',str_replace(']',$str, ''),''));
    }
}