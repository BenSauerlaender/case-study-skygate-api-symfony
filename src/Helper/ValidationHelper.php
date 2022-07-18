<?php

namespace App\Helper;

class ValidationHelper
{
    //Validation RegEx
    public const WORD_REGEX = "[a-zA-ZÄÖÜäöüß]{2,}";
    public const WORDS_REGEX = "/^(" . self::WORD_REGEX . "[ ])*" . self::WORD_REGEX . "$/";
    public const NUMBER_REGEX = "/^[0-9]+$/";
    public const PHONE_NUMBER_REGEX = "/^[0-9 +\-()\/.x]*$/";

    public static function onlyNumbers($s)
    {
        return preg_replace("/[^0-9]/", "", $s);
    }
}
