<?php

use Jenssegers\Agent\Facades\Agent;

if(!function_exists('isMobile')) {
    function isMobile() {
        return Agent::isMobile();
    }
}

if(!function_exists('isDesktop')) {
    function isDesktop() {
        return Agent::isDesktop();
    }
}

if(!function_exists('isTablet')) {
    function isTablet() {
        return Agent::isTablet();
    }
}
