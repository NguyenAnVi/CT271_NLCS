<?php

if (!function_exists('getImages')) {
    function getImageAt($array, $position)
    {
        if($array)
        return json_decode(str_replace('\\','',$array))[$position];
        return NULL;
    }
}