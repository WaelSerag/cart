<?php

namespace App\Constants;

final class UserTypes
{
   const USER = 0;
   const MERCHANT = 1;

    public static function getList()
    {
        return [
            UserTypes::MERCHANT => trans("merchant"),
            UserTypes::USER  => trans("user"),

        ];
    }

    public static function getOne($index = '')
    {
        $list = self::getList();
        $list_one = '';
        if ($index) {
            $list_one = $list[$index];
        }
        return $list_one;
    }


}
