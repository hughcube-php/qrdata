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
 * @method static boolean isNone(string $type)
 * @method static boolean isEnlarge(string $type)
 * @method static boolean isMargin(string $type)
 * @method static boolean isShrink(string $type)
 */
class RoundBlockSizeMode extends Enum
{
    const NONE = 'n';
    const ENLARGE = 'e';
    const MARGIN = 'm';
    const SHRINK = 's';

    /**
     * @inheritDoc
     */
    public static function labels(): array
    {
        return [
            static::NONE => ['title' => 'None', 'name' => 'None', 'is_default' => true],
            static::ENLARGE => ['title' => 'Enlarge', 'name' => 'Enlarge'],
            static::MARGIN => ['title' => 'Margin', 'name' => 'Margin'],
            static::SHRINK => ['title' => 'Shrink', 'name' => 'Shrink'],
        ];
    }
}
