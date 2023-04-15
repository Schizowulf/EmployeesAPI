<?php

namespace App\Utils;

class EmployeeFields
{
    private static $maxStringLength = 30;
    private static $phoneLength = 12;
    private static $maxUrlLength = 200;

    /**
     * Returns array of rules for employee fields validation
     *
     * @return array
     */
    static function getRules() : array
    {
        return [
            "name" => 'required|max:' . self::$maxStringLength,
            "patronymic" => 'required|max:' . self::$maxStringLength,
            "surname" => 'required|max:' . self::$maxStringLength,
            "birthday" => 'required|max:' . self::$maxStringLength,
            "position" => 'required|max:' . self::$maxStringLength,
            "phone" => 'required|max:' . self::$phoneLength . '|min:' . self::$phoneLength,
            "avatar_url" => 'url|max:' . self::$maxUrlLength,
        ];
    }

    static function getRestriction() : array
    {
        return [
            "maxStringLength" => self::$maxStringLength,
            "phoneLength" => self::$phoneLength,
            "maxUrlLength" => self::$maxUrlLength,
        ];
    }
}