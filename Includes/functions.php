<?php
function cleanString($value)
{
    return trim(htmlspecialchars($value, ENT_QUOTES));
}
