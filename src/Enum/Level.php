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
 * @method static boolean isHigh(string $type)
 * @method static boolean isQuartile(string $type)
 * @method static boolean isMedium(string $type)
 * @method static boolean isLow(string $type)
 */
class Level extends Enum
{
    const HIGH = 'h';
    const QUARTILE = 'q';
    const MEDIUM = 'm';
    const LOW = 'l';

    /**
     * @inheritDoc
     */
    public static function labels(): array
    {
        return [
            static::HIGH => ['title' => '30%的字码可被修正', 'name' => 'high'],
            static::QUARTILE => ['title' => '25%的字码可被修正', 'name' => 'quartile'],
            static::MEDIUM => ['title' => '15%的字码可被修正', 'name' => 'medium', 'is_default' => true],
            static::LOW => ['title' => '7%的字码可被修正', 'name' => 'low'],
        ];
    }
}
