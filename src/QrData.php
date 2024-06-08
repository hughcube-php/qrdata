<?php
/**
 * Created by PhpStorm.
 * User: hugh.li
 * Date: 2021/6/23
 * Time: 19:31
 */

namespace HughCube\QrData;

use Exception;
use HughCube\QrData\Enum\Encoding;
use HughCube\QrData\Enum\LabelAlignment;
use HughCube\QrData\Enum\Level;
use HughCube\QrData\Enum\RoundBlockSizeMode;
use HughCube\QrData\Enum\Type;

class QrData
{
    const USER_KEY = "a";
    const USER_SECRET = "b";
    const SIGNATURE = "c";
    const CREATED_AT = "d";
    const NONCE = "e";
    const DATA = "f";
    const LEVEL = "g";
    const LOGO = "h";
    const LOGO_SIZE = "i";
    const TYPE = "j";
    const SIZE = "k";
    const ENCODING = "l";
    const MARGIN = "m";
    const ROUND_BLOCK_SIZE_MODE = "n";
    const FOREGROUND_COLOR = "o";
    const BACKGROUND_COLOR = "p";
    const LABEL_TEXT = "q";
    const LABEL_FONT = "r";
    const LABEL_ALIGNMENT = "s";
    const LABEL_TEXT_COLOR = "t";

    protected $attributes = [];

    /**
     * @return static
     */
    public static function instance(): QrData
    {
        $class = static::class;
        return new $class;
    }

    /**
     * QrData constructor.
     * @throws Exception
     */
    public function __construct()
    {
        $this->setCreatedAt(time())->setNonce($this->randomNonce());
    }

    /**
     * @param  string  $key
     * @return bool
     */
    public function hasAttribute(string $key): bool
    {
        return array_key_exists($key, $this->attributes);
    }

    /**
     * @param  string  $key
     * @param null|integer|string $default
     * @return mixed
     */
    public function getAttribute(string $key, $default = null)
    {
        return $this->hasAttribute($key) ? $this->attributes[$key] : $default;
    }

    /**
     * @param  string  $key
     * @param  string|int  $value
     * @return $this
     */
    public function setAttribute(string $key, $value): QrData
    {
        $this->attributes[$key] = $value;

        return $this;
    }

    /**
     * @return array
     */
    public function getAttributes(): array
    {
        return $this->attributes;
    }

    /**
     * @return mixed
     */
    public function getUserKey()
    {
        return $this->getAttribute(static::USER_KEY);
    }

    /**
     * @param  string  $userKey
     * @return $this
     */
    public function setUserKey(string $userKey): QrData
    {
        return $this->setAttribute(static::USER_KEY, $userKey);
    }

    /**
     * @return mixed
     */
    public function getUserSecret()
    {
        return $this->getAttribute(static::USER_SECRET);
    }

    /**
     * @param  string  $userSecret
     * @return $this
     */
    public function setUserSecret(string $userSecret): QrData
    {
        return $this->setAttribute(static::USER_SECRET, $userSecret);
    }

    /**
     * @return string|null
     */
    public function getSignature()
    {
        return $this->getAttribute(static::SIGNATURE);
    }

    /**
     * @param  string  $signature
     * @return $this
     */
    public function setSignature(string $signature): QrData
    {
        return $this->setAttribute(static::SIGNATURE, $signature);
    }

    /**
     * @return int
     */
    public function getCreatedAt()
    {
        return $this->getAttribute(static::CREATED_AT);
    }

    /**
     * @param  int  $createdAt
     * @return $this
     */
    public function setCreatedAt(int $createdAt): QrData
    {
        return $this->setAttribute(static::CREATED_AT, $createdAt);
    }

    /**
     * @return mixed
     */
    public function getNonce()
    {
        return $this->getAttribute(static::NONCE);
    }

    /**
     * @param  string  $nonce
     * @return $this
     */
    public function setNonce(string $nonce): QrData
    {
        return $this->setAttribute(static::NONCE, $nonce);
    }

    /**
     * @return string
     * @throws Exception
     */
    public function randomNonce(): string
    {
        return substr(md5(random_bytes(100)), 0, 5);
    }

    /**
     * @return mixed
     */
    public function getData()
    {
        return $this->getAttribute(static::DATA);
    }

    /**
     * @param  string  $data
     * @return $this
     */
    public function setData(string $data): QrData
    {
        return $this->setAttribute(static::DATA, $data);
    }

    /**
     * @return string|null
     */
    public function getLevel()
    {
        return $this->getAttribute(static::LEVEL, Level::getDefault());
    }

    /**
     * @param  string  $level
     * @return $this
     */
    public function setLevel(string $level): QrData
    {
        return $this->setAttribute(static::LEVEL, $level);
    }

    /**
     * @return string|null
     */
    public function getLogo()
    {
        return $this->getAttribute(static::LOGO);
    }

    /**
     * @param  string  $logo
     * @return $this
     */
    public function setLogo(string $logo): QrData
    {
        return $this->setAttribute(static::LOGO, $logo);
    }

    /**
     * @return int|null
     */
    public function getLogoSize()
    {
        return $this->getAttribute(static::LOGO_SIZE);
    }

    /**
     * @param  int  $logoSize
     * @return $this
     */
    public function setLogoSize(int $logoSize): QrData
    {
        return $this->setAttribute(static::LOGO_SIZE, $logoSize);
    }

    /**
     * @return string
     */
    public function getType()
    {
        return $this->getAttribute(static::TYPE, Type::getDefault());
    }

    /**
     * @param  string  $type
     * @return $this
     */
    public function setType(string $type): QrData
    {
        return $this->setAttribute(static::TYPE, $type);
    }

    /**
     * @return int|null
     */
    public function getSize()
    {
        return $this->getAttribute(static::SIZE, 300);
    }

    /**
     * @param  int  $size
     * @return $this
     */
    public function setSize(int $size): QrData
    {
        return $this->setAttribute(static::SIZE, $size);
    }

    /**
     * @return string|null
     */
    public function getEncoding()
    {
        return $this->getAttribute(static::ENCODING, Encoding::getDefault());
    }

    /**
     * @param  string  $encoding
     * @return $this
     */
    public function setEncoding(string $encoding): QrData
    {
        return $this->setAttribute(static::ENCODING, $encoding);
    }

    /**
     * @return int
     */
    public function getMargin()
    {
        return $this->getAttribute(static::MARGIN, 1);
    }

    /**
     * @param  int  $margin
     * @return $this
     */
    public function setMargin(int $margin): QrData
    {
        return $this->setAttribute(static::MARGIN, $margin);
    }

    /**
     * @return string|null
     */
    public function getRoundBlockSizeMode()
    {
        return $this->getAttribute(static::ROUND_BLOCK_SIZE_MODE, RoundBlockSizeMode::getDefault());
    }

    /**
     * @param  string  $model
     * @return $this
     */
    public function setRoundBlockSizeMode(string $model): QrData
    {
        return $this->setAttribute(static::ROUND_BLOCK_SIZE_MODE, $model);
    }

    /**
     * @return string|null
     */
    public function getForegroundColor()
    {
        return $this->getAttribute(static::FOREGROUND_COLOR);
    }

    /**
     * @param  string  $color
     * @return $this
     */
    public function setForegroundColor(string $color): QrData
    {
        return $this->setAttribute(static::FOREGROUND_COLOR, $color);
    }

    /**
     * @return string|null
     */
    public function getBackgroundColor()
    {
        return $this->getAttribute(static::BACKGROUND_COLOR);
    }

    /**
     * @param  string  $color
     * @return $this
     */
    public function setBackgroundColor(string $color): QrData
    {
        return $this->setAttribute(static::BACKGROUND_COLOR, $color);
    }

    /**
     * @return mixed
     */
    public function getLabelText()
    {
        return $this->getAttribute(static::LABEL_TEXT);
    }

    /**
     * @param  string  $text
     * @return $this
     */
    public function setLabelText(string $text): QrData
    {
        return $this->setAttribute(static::LABEL_TEXT, $text);
    }

    /**
     * @return mixed
     */
    public function getLabelFont()
    {
        return $this->getAttribute(static::LABEL_FONT);
    }

    /**
     * @param  string  $labelFont
     * @return $this
     */
    public function setLabelFont(string $labelFont): QrData
    {
        return $this->setAttribute(static::LABEL_FONT, $labelFont);
    }

    /**
     * @return string|null
     */
    public function getLabelAlignment()
    {
        return $this->getAttribute(static::LABEL_ALIGNMENT);
    }

    /**
     * @param  string  $alignment
     * @return $this
     */
    public function setLabelAlignment(string $alignment): QrData
    {
        return $this->setAttribute(static::LABEL_ALIGNMENT, $alignment);
    }

    /**
     * @return string|null
     */
    public function getLabelTextColor()
    {
        return $this->getAttribute(static::LABEL_TEXT_COLOR);
    }

    /**
     * @param  string  $color
     * @return $this
     */
    public function setLabelTextColor(string $color): QrData
    {
        return $this->setAttribute(static::LABEL_TEXT_COLOR, $color);
    }

    /**
     * @return string
     */
    public function makeSignature(): string
    {
        $attributes = $this->getAttributes();
        if (array_key_exists(static::SIGNATURE, $attributes)) {
            unset($attributes[static::SIGNATURE]);
        }

        /** null or empty string */
        foreach ($attributes as $name => $value) {
            if (null === $value || '' === $value) {
                unset($attributes[$name]);
            }
        }

        ksort($attributes, SORT_STRING);
        return strval(crc32(implode(',', $attributes)));
    }

    /**
     * @param  mixed  $signature
     * @return bool
     */
    public function validateSignature($signature): bool
    {
        if (empty($signature)) {
            return false;
        }

        return $signature === $this->makeSignature();
    }

    public function validate(): bool
    {
        if (empty($this->getUserKey()) || !is_string($this->getUserKey())) {
            return false;
        }

        if (empty($this->getUserSecret()) || !is_string($this->getUserSecret())) {
            return false;
        }

        if (empty($this->getCreatedAt()) || !$this->isDigit($this->getCreatedAt(), 1)) {
            return false;
        }

        if (empty($this->getNonce()) || !is_string($this->getNonce())) {
            return false;
        }

        if (empty($this->getData()) || !is_string($this->getData())) {
            return false;
        }

        if (!empty($this->getLevel()) && !Level::has($this->getLevel())) {
            return false;
        }

        if (!empty($this->getLogo()) && !$this->isUrl($this->getLogo())) {
            return false;
        }

        if (!empty($this->getLogoSize()) && !$this->isDigit($this->getLogoSize(), 0)) {
            return false;
        }

        if (!empty($this->getType()) && !Type::has($this->getType())) {
            return false;
        }

        if (!empty($this->getSize()) && !$this->isDigit($this->getSize(), 0)) {
            return false;
        }

        if (!empty($this->getEncoding()) && !Encoding::has($this->getEncoding())) {
            return false;
        }

        if (!empty($this->getMargin()) && !$this->isDigit($this->getMargin())) {
            return false;
        }

        if (!empty($this->getRoundBlockSizeMode()) && !RoundBlockSizeMode::has($this->getRoundBlockSizeMode())) {
            return false;
        }

        if (!empty($this->getForegroundColor()) && !$this->isColor($this->getForegroundColor())) {
            return false;
        }

        if (!empty($this->getBackgroundColor()) && !$this->isColor($this->getBackgroundColor())) {
            return false;
        }

        if (!empty($this->getLabelText()) && !is_string($this->getLabelText())) {
            return false;
        }

        if (!empty($this->getLabelFont()) && !is_string($this->getLabelFont())) {
            return false;
        }

        /** @todo */
        if (!empty($this->getLabelAlignment()) && !LabelAlignment::has($this->getLabelAlignment())) {
            return false;
        }

        if (!empty($this->getLabelTextColor()) && !$this->isColor($this->getLabelTextColor())) {
            return false;
        }

        return true;
    }

    /**
     * @return string
     */
    public function encode(): string
    {
        $attributes = $this->setSignature($this->makeSignature())->getAttributes();
        if (array_key_exists(static::USER_SECRET, $attributes)) {
            unset($attributes[static::USER_SECRET]);
        }

        $json = json_encode($attributes);
        $gzBin = gzcompress($json, 9);
        return Base::binToBase62($gzBin);
    }

    /**
     * @param  string  $data
     * @return static
     */
    public static function decode(string $data): QrData
    {
        $gzBin = Base::base62ToBin($data);
        $json = gzuncompress($gzBin);
        $data = json_decode($json, true);

        $qrData = static::instance();
        $qrData->attributes = $data;
        return $qrData;
    }

    /**
     * @param  mixed  $digit
     * @param  null|int|float  $min
     * @param  null|int|float  $max
     * @return bool
     */
    protected function isDigit($digit, $min = null, $max = null): bool
    {
        return
            is_numeric($digit)
            && ctype_digit(strval($digit))
            && ($min === null || $min <= $digit)
            && ($max === null || $max >= $digit);
    }

    /**
     * @param  mixed  $color
     * @return bool
     */
    protected function isColor($color): bool
    {
        if (!is_string($color)) {
            return false;
        }

        $color = explode(',', $color);
        if (!is_array($color) || 3 !== count($color)) {
            return false;
        }

        foreach ($color as $value) {
            if (!$this->isDigit($value, 0, 255)) {
                return false;
            }
        }

        return true;
    }

    /**
     * @param  mixed  $value
     * @return bool
     */
    protected function isUrl($value): bool
    {
        return false !== filter_var($value, FILTER_VALIDATE_URL);
    }
}
