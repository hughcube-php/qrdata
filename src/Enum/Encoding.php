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
 * @method static boolean isUtf8(string $type)
 */
class Encoding extends Enum
{
    const UTF8 = 'utf8';

    /**
     * @inheritDoc
     */
    public static function labels(): array
    {
        return [
            static::UTF8 => ['title' => 'utf-8', 'name' => 'utf8', 'is_default' => true],
        ];
    }
}
