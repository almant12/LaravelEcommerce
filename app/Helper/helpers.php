<?php


function setActive(array $route){
    if (array($route)){
        foreach ($route as $r){
            if (request()->routeIs($r)){
                return 'active';
            }
        }
    }
}
