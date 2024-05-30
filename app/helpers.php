<?php

function setActiveRoute($routeName)
{
    return request()->routeIs($routeName) ? 'active' : '';
}

function numberFormat($number) {
    return number_format($number, 2, ',', '.');
}



function optimizeImage ($image) {
    if ($image->width() > 1920 || $image->height() > 1080) {
        $image->scale(width: 1080); 
    }

    $image = $image->toWebp(80);
    return $image;
}