<?php

use Carbon\Carbon;

if(!function_exists('_parseDate')){
    function _parseDate($date){
        return Carbon::parse($date);
    }
}