<?php

namespace Mohsen\User\Services;

class VerifyCodeService
{

    private static $min = 100000;
    private static $max = 999999;
private static $prefix='verify_code_';
    public static function generate()
    {
        return rand(self::$min, self::$max);
    }

    public static function store($id, $value, $time)
    {
        cache()->set(self::$prefix. $id, $value, $time);
    }

    public static function get($id)
    {
        return cache()->get(self::$prefix. $id);
    }
    public static function has($id)
    {
        return cache()->has(self::$prefix. $id);
    }

    public static function delete($id)
    {
        return cache()->delete(self::$prefix. $id);
    }

    public static function verifyRules()
    {
        return  ['required', 'numeric', 'between:' . self::$min . ',' . self::$max];
    }



    public static function Check($id,$requestCode)
    {
        $code = VerifyCodeService::get($id);
        if ($code ==$requestCode) {
            VerifyCodeService::delete($id);
            return true;
        }
        return false;
    }


}
