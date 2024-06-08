<?php
/**
 * Created by PhpStorm.
 * User: hugh.li
 * Date: 2021/6/23
 * Time: 20:16
 */

namespace HughCube\QrData\Enum;

use HughCube\Enum\Enum;

/**
 * Class Type
 * @package HughCube\QrData\Enum
 *
 * @method static boolean isPng(string $type)
 */
class Type extends Enum
{
    const PNG = '1';

    public static function labels(): array
    {
        return [
            static::PNG => ['title' => 'png', 'name' => 'png', 'is_default' => true],
        ];
    }
}
