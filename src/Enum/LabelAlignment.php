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
 * @method static boolean isCenter(string $type)
 * @method static boolean isLeft(string $type)
 * @method static boolean isRight(string $type)
 */
class LabelAlignment extends Enum
{
    const CENTER = '1';
    const LEFT = '2';
    const RIGHT = '3';

    public static function labels(): array
    {
        return [
            static::CENTER => ['title' => 'center', 'name' => 'center', 'is_default' => true],
            static::LEFT => ['title' => 'left', 'name' => 'left'],
            static::RIGHT => ['title' => 'right', 'name' => 'right'],
        ];
    }
}
