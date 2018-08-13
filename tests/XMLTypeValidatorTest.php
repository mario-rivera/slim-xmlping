<?php
require_once __DIR__.'/../vendor/autoload.php';

use PHPUnit\Framework\TestCase;
use App\XML\XMLTypeValidator;

use App\XML\interfaces\iXMLDocument;
use App\XML\XMLTypes;
use App\XML\errors\InvalidType;

class XMLTypeValidatorTest extends TestCase{

    private $instance;
    private $xmlDocMock;

    protected function setUp()
    {
        $this->instance = new XMLTypeValidator();
        $this->xmlDockMock = $this->createMock(iXMLDocument::class);
    }

    public function test_validate_Ok_Boolean(){

        $expectedResult = true;

        $this->xmlDockMock
            ->expects($this->exactly(1))
            ->method('getType')
            ->willReturn(XMLTypes::PING_REQUEST);
        
        $result = $this->instance->validate($this->xmlDockMock);

        $this->assertEquals($expectedResult, $result);
    }

    public function test_validate_NoType_ThrowsException(){

        $this->xmlDockMock
            ->expects($this->exactly(1))
            ->method('getType')
            ->willReturn(null);
       
        $this->expectException(InvalidType::class);
        $result = $this->instance->validate($this->xmlDockMock);
    }

    public function test_validate_IncorrectType_ThrowsException(){

        $this->xmlDockMock
            ->expects($this->exactly(1))
            ->method('getType')
            ->willReturn('non_existent');
       
        $this->expectException(InvalidType::class);
        $result = $this->instance->validate($this->xmlDockMock);
    }

    public function test_validateType_Ok_Boolean(){

        $expectedResult = true;
        $type = 'SOME_TYPE';

        $this->xmlDockMock
            ->expects($this->exactly(1))
            ->method('getType')
            ->willReturn($type);
       
        $result = $this->instance->validateType($this->xmlDockMock, $type);

        $this->assertEquals($expectedResult, $result);
    }

    public function test_validateType_Fail_ThrowsException(){

        $type = 'SOME_TYPE';

        $this->xmlDockMock
            ->expects($this->exactly(1))
            ->method('getType')
            ->willReturn($type);
        
        $this->expectException(InvalidType::class);
        $this->instance->validateType($this->xmlDockMock, 'OTHER_TYPE');
    }
}