<?php

function setActiveRoute($routeName)
{
    return request()->routeIs($routeName) ? 'active' : '';
}