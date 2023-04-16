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
    static function getDbRules() : array
    {
        return [
            "name" => 'required|max:' . self::$maxStringLength,
            "patronymic" => 'required|max:' . self::$maxStringLength,
            "surname" => 'required|max:' . self::$maxStringLength,
            "birthday" => 'required|max:' . self::$maxStringLength . '|date_format:d.m.Y',
            "position" => 'required|max:' . self::$maxStringLength,
            "phone" => 'required|max:' . self::$phoneLength . '|min:' . self::$phoneLength,
            "avatar_url" => 'url|max:' . self::$maxUrlLength,
        ];
    }

    static function getFiltersRules() : array
    {
        return [
            "search" => 'max:' . self::$maxStringLength,
            "page" => 'numeric',
            "perPage" => 'numeric',
            "sortField" => 'in:id,name,patronymic,surname,birthday,position,phone',
            "sortOrder" => 'in:asc,desc'
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