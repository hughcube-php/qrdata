<?php
/**
 * Created by PhpStorm.
 * User: hugh.li
 * Date: 2021/6/23
 * Time: 19:31
 */

namespace HughCube\QrData;

class Base extends \HughCube\Base\Base
{
    const BASE16 = '0123456789abcdef';
    const BASE62 = 'mnLyothXBC48VAKMSIewD5pbGxvlqEU1JFfiOa2TH9u076zdWjcgZ3QsrRYkNP';

    public static function binToBase62($input)
    {
        $base16 = strtolower(bin2hex($input));
        return static::conv($base16, static::BASE16, static::BASE62);
    }

    public static function base62ToBin($input)
    {
        $base16 = static::conv($input, static::BASE62, static::BASE16);
        return hex2bin($base16);
    }
}
