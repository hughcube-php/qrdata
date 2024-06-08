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
    public function attributeDataProvider(): array
    {
        return [
            [$this->randomNonce(), $this->randomNonce()],
            [$this->randomNonce(), $this->randomNonce()],
            [$this->randomNonce(), $this->randomNonce()],

            [QrData::USER_KEY, $this->randomNonce()],
            [QrData::USER_SECRET, $this->randomNonce()],
            [QrData::SIGNATURE, $this->randomNonce()],
            [QrData::CREATED_AT, random_int(1, 99999999), true],
            [QrData::NONCE, $this->randomNonce(), true],
            [QrData::DATA, $this->randomNonce()],
            [QrData::LEVEL, $this->randomArrayValue(Level::all())],

            [QrData::LOGO, $this->randomNonce()],
            [QrData::LOGO_SIZE, random_int(1, 99999999)],
            [QrData::TYPE, $this->randomArrayValue(Type::all())],
            [QrData::SIZE, random_int(1, 99999999)],
            [QrData::ENCODING, $this->randomArrayValue(Encoding::all())],
            [QrData::MARGIN, random_int(1, 99999999)],
            [QrData::ROUND_BLOCK_SIZE_MODE, $this->randomArrayValue(RoundBlockSizeMode::all())],
            [QrData::FOREGROUND_COLOR, $this->randomNonce()],
            [QrData::BACKGROUND_COLOR, $this->randomNonce()],
            [QrData::LABEL_TEXT, $this->randomNonce()],
            [QrData::LABEL_FONT, $this->randomNonce()],
            [QrData::LABEL_ALIGNMENT, $this->randomNonce()],
            [QrData::LABEL_TEXT_COLOR, $this->randomNonce()],
        ];
    }

    /**
     * @return array
     * @throws Exception
     */
    public function dataProvider(): array
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
    protected function randomNonce(): string
    {
        return md5(random_bytes(100));
    }

    /**
     * @throws Exception
     */
    protected function randomArrayValue($array)
    {
        return array_values($array)[random_int(0, (count($array) - 1))];
    }
}
