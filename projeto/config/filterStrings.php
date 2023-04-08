<?php

function filterString($string){
    $stringFiltered = filter_var(trim($string), FILTER_SANITIZE_STRING);
    
    return $stringFiltered;
}
