<?php

function setActiveRoute($routeName)
{
    return request()->routeIs($routeName) ? 'active' : '';
}

function numberFormat($number) {
    return number_format($number, 2, ',', '.');
}
