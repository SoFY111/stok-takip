<?php
/**
 * CheckLastDigit helper
 *
 * @param int  digits
 * @return int
 */

function checkLastDigitEAN($digits)
{
    $digits = (string)$digits;
    $even_sum = (int)$digits[1] + (int)$digits[3] + (int)$digits[5] + (int)$digits[7] + (int)$digits[9] + (int)$digits[11];
    $even_sum_three = $even_sum * 3;
    $odd_sum = (int)$digits[0] + (int)$digits[2] + (int)$digits[4] + (int)$digits[6] + (int)$digits[8] + (int)$digits[10];
    $total_sum = $even_sum_three + $odd_sum;
    $next_ten = (ceil($total_sum / 10)) * 10;
    $check_digit = $next_ten - $total_sum;
    return $check_digit;
}
