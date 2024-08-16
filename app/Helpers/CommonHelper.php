<?php

if (!function_exists('formatIndianCurrency')) {
    function formatIndianCurrency($number)
    {
        $number_parts = explode('.', $number); // Separate the number into the whole and decimal parts
        $whole_part = $number_parts[0]; // The integer part
        $decimal_part = isset($number_parts[1]) ? $number_parts[1] : '00'; // The decimal part

        // If the number is greater than 999, start adding commas
        if(strlen($whole_part) > 3) {
            $last_three = substr($whole_part, -3);
            $remaining_units = substr($whole_part, 0, -3);
            $remaining_units = preg_replace("/\B(?=(\d{2})+(?!\d))/", ",", $remaining_units);
            $whole_part = $remaining_units . ',' . $last_three;
        }

        // Combine the whole part and the decimal part
        $formatted_number = $whole_part . '.' . $decimal_part;

        return $formatted_number;
    }
}

