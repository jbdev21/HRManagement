<?php

use Carbon\Carbon;

function toPeso($amount){
    return "Php ".number_format($amount, 2);
}

function getYears(){
    $nowYear = now()->format('Y');
    $numberOfYears = 5;
    $yearArray = array();
    for($i = 0; $i < $numberOfYears; $i++){
        array_push($yearArray, now()->subYear($i)->format('Y'));
    }

    return $yearArray;
}

function toQuarterFormat($number){
    switch($number){
        case 1:
            return "1st Quarter";
            break;
        case 2:
            return "2nd Quarter";
            break;
        case 3:
            return "3rd Quarter";
            break;
        case 4:
            return "4th Quarter";
            break;
    }
}


