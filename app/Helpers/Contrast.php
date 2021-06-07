<?php

/**
 * Contrast helper
 *
 * @param hexcolor
 *
 * @return int
 */
function hexColorContrast($hexcolor)
{
    $newHexColor = explode("#", $hexcolor)[1];
    $r = hexdec(substr($newHexColor, 0,2));
    $g = hexdec(substr($newHexColor, 2,2));
    $b = hexdec(substr($newHexColor, 4,2));
    $yiq = (($r*299)+($g*587)+($b*114))/1000;
    return ($yiq >= 128) ? 0 : 1;
}
