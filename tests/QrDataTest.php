<?php
/**
 * Created by PhpStorm.
 * User: hugh.li
 * Date: 2021/4/20
 * Time: 11:36 下午.
 */

namespace HughCube\QrData\Tests;

use Exception;
use HughCube\QrData\Enum\Encoding;
use HughCube\QrData\Enum\Level;
use HughCube\QrData\Enum\RoundBlockSizeMode;
use HughCube\QrData\Enum\Type;
use HughCube\QrData\QrData;
use ReflectionClass;

class QrDataTest extends TestCase
{
    /**
     * @dataProvider dataProvider
     */
    public function testDecode($qrData)
    {
        $this->assertInstanceOf(QrData::class, $qrData);
    }

    /**
     * @param  QrData  $qrData
     * @dataProvider dataProvider
     */
    public function testMakeSignature(QrData $qrData)
    {
        $this->assertNotEmpty($qrData->makeSignature());
        $this->assertTrue(is_numeric($qrData->makeSignature()));
        $this->assertTrue(is_string($qrData->makeSignature()));
        $this->assertTrue(ctype_digit($qrData->makeSignature()));
    }

    public function testConstruct()
    {
        $qrData = new QrData();

        $this->assertInstanceOf(QrData::class, $qrData);
        $this->assertTrue($qrData->hasAttribute(QrData::CREATED_AT));
        $this->assertTrue($qrData->hasAttribute(QrData::NONCE));
    }

    /**
     * @dataProvider attributeDataProvider
     *
     * @param  string  $name
     * @param  string|int  $value
     * @param  bool  $hasInitialize
     */
    public function testAttribute(string $name, $value, bool $hasInitialize = false)
    {
        $qrData = new QrData();
        $this->assertInstanceOf(QrData::class, $qrData);

        $qrData = new QrData();
        $this->assertSame($qrData->hasAttribute($name), $hasInitialize);
        $this->assertSame($qrData, $qrData->setAttribute($name, null));
        $this->assertNull($qrData->getAttribute($name));

        $qrData = new QrData();
        $this->assertSame($qrData, $qrData->setAttribute($name, $value));
        $this->assertTrue($qrData->hasAttribute($name));
        $this->assertSame($qrData->getAttribute($name), $value);
        $this->assertSame($qrData->getAttributes()[$name], $value);


        $reflection = new ReflectionClass(QrData::class);
        foreach ($reflection->getConstants() as $constantName => $constantValue) {
            if ($name !== $constantValue) {
                continue;
            }

            $getter = strtr("get{$constantName}", ['_' => '']);
            $setter = strtr("set{$constantName}", ['_' => '']);

            $qrData = new QrData();
            $this->assertSame($qrData, $qrData->{$setter}($value));
            $this->assertSame($value, $qrData->{$getter}($name));
            $this->assertSame($qrData->getAttributes()[$name], $value);
        }
    }

    /**
     * @dataProvider dataProvider
     *
     * @param  QrData  $qrData
     */
    public function testValidate(QrData $qrData)
    {
        $decodeQrData = QrData::decode($qrData->encode());

        $this->assertInstanceOf(QrData::class, $decodeQrData);

        $this->assertEmpty($decodeQrData->getUserSecret());
        $this->assertFalse($decodeQrData->validate());
        $this->assertFalse($decodeQrData->validateSignature($decodeQrData->getSignature()));

        $this->assertInstanceOf(QrData::class, $decodeQrData->setUserSecret($qrData->getUserSecret()));
        $this->assertTrue($decodeQrData->validate());
        $this->assertTrue($decodeQrData->validateSignature($decodeQrData->getSignature()));
    }

    /**
     * @return array
     * @throws Exception
     */
    public static function attributeDataProvider(): array
    {
        return [
            [static::randomNonce(), static::randomNonce()],
            [static::randomNonce(), static::randomNonce()],
            [static::randomNonce(), static::randomNonce()],

            [QrData::USER_KEY, static::randomNonce()],
            [QrData::USER_SECRET, static::randomNonce()],
            [QrData::SIGNATURE, static::randomNonce()],
            [QrData::CREATED_AT, random_int(1, 99999999), true],
            [QrData::NONCE, static::randomNonce(), true],
            [QrData::DATA, static::randomNonce()],
            [QrData::LEVEL, static::randomArrayValue(Level::all())],

            [QrData::LOGO, static::randomNonce()],
            [QrData::LOGO_SIZE, random_int(1, 99999999)],
            [QrData::TYPE, static::randomArrayValue(Type::all())],
            [QrData::SIZE, random_int(1, 99999999)],
            [QrData::ENCODING, static::randomArrayValue(Encoding::all())],
            [QrData::MARGIN, random_int(1, 99999999)],
            [QrData::ROUND_BLOCK_SIZE_MODE, static::randomArrayValue(RoundBlockSizeMode::all())],
            [QrData::FOREGROUND_COLOR, static::randomNonce()],
            [QrData::BACKGROUND_COLOR, static::randomNonce()],
            [QrData::LABEL_TEXT, static::randomNonce()],
            [QrData::LABEL_FONT, static::randomNonce()],
            [QrData::LABEL_ALIGNMENT, static::randomNonce()],
            [QrData::LABEL_TEXT_COLOR, static::randomNonce()],
        ];
    }

    /**
     * @return array
     * @throws Exception
     */
    public static function dataProvider(): array
    {
        $qrData = (new QrData())
            ->setUserKey(md5(random_bytes(100)))
            ->setUserSecret(md5(random_bytes(100)))
            ->setNonce(crc32(random_bytes(100)))
            ->setData(base64_encode(random_bytes(100)));

        return [
            [$qrData]
        ];
    }

    /**
     * @throws Exception
     */
    protected static function randomNonce(): string
    {
        return md5(random_bytes(100));
    }

    /**
     * @throws Exception
     */
    protected static function randomArrayValue($array)
    {
        return array_values($array)[random_int(0, (count($array) - 1))];
    }
}
