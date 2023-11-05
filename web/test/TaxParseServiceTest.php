<?php

namespace AgroTest;

use Agro\Exceptions\TaxException;
use Agro\Services\TaxParseService;
use PHPUnit\Framework\TestCase;

class TaxParseServiceTest extends TestCase
{
    /** @var string */
    private const EXCEPTION_MESSAGE = 'Невалидный формат для Tax номера!';

    /**
     * @dataProvider getDummyData
     * @throws TaxException
     */
    public function testParse(string $taxNumber, string $excepted): void
    {
        $taxService = new TaxParseService();
        $taxService->setTaxNumber($taxNumber);
        $taxService->setPattern(TaxParseService::DEFAULT_PATTERN);

        $this->assertEquals($excepted, $taxService->parse());
    }

    public function testParseException(): void
    {
        $taxService = new TaxParseService();
        $taxService->setTaxNumber('666666666');
        $taxService->setPattern(TaxParseService::DEFAULT_PATTERN);

        $this->expectException(TaxException::class);
        $this->expectExceptionMessage(self::EXCEPTION_MESSAGE);

        $taxService->parse();
    }

    /** @return array[] */
    public static function getDummyData(): array
    {
        return [
            ['GR565656', 'GR']
        ];
    }
}

