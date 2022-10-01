<?php

if (!function_exists('getImages')) {
    function getImageAt($array, $position)
    {
        return json_decode(str_replace('\\','',$array))[$position];
    }
}