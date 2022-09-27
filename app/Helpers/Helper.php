<?php

use App\Models\Option;

if (!function_exists('format_size_units')) {
    function format_size_units($bytes, $decimals = 2): string
    {
        if ($bytes >= 1073741824) {
            $bytes = number_format($bytes / 1073741824, $decimals) . ' GB';
        } elseif ($bytes >= 1048576) {
            $bytes = number_format($bytes / 1048576, $decimals) . ' MB';
        } elseif ($bytes >= 1024) {
            $bytes = number_format($bytes / 1024, $decimals) . ' KB';
        } elseif ($bytes > 1) {
            $bytes = $bytes . ' bytes';
        } elseif ($bytes == 1) {
            $bytes = $bytes . ' byte';
        } else {
            $bytes = '0 bytes';
        }

        return $bytes;
    }
}

if (!function_exists('get_option')) {
    function get_option($key): string
    {
        $option =Option::where('option_name', $key)->first();
        return (isset($option->option_value))?$option->option_value:"";
    }
}
if (!function_exists('formatMinuteToHour')) {
    function formatMinuteToHour($minute): string
    {
        $hour = (intdiv($minute, 60)>0)?intdiv($minute, 60).'h':"";

        $minute =  (($minute % 60) > 0)?($minute % 60)."min" : "";
        if($hour!="" && $minute !=""){
            $duration =  $hour.": ". $minute;
        }else{
            $duration =  $hour. $minute;
        }
        return $duration;
    }
}
?>