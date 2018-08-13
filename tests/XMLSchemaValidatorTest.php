<?php
require_once __DIR__.'/../vendor/autoload.php';

use PHPUnit\Framework\TestCase;
use App\XML\XMLSchemaValidator;
use App\XML\interfaces\iXMLDocument;
use App\XML\errors\InvalidSchema;

class XMLSchemaValidatorTest extends TestCase{

    private $instance;
    private $xmlDocMock;

    protected function setUp()
    {
        $this->instance = new XMLSchemaValidator();
        $this->xmlDockMock = $this->createMock(iXMLDocument::class);
    }

    public function test_validate_Ok_Boolean(){

        $expectedResult = true;

        $this->xmlDockMock
            ->expects($this->exactly(1))
            ->method('getType')
            ->willReturn('string');

        $this->xmlDockMock
            ->expects($this->exactly(1))
            ->method('validateSchema')
            ->willReturn(true);

        $this->setProtectedProperty($this->instance, 'xsdPath', 'path');

        $result = $this->instance->validate($this->xmlDockMock);

        $this->assertEquals($expectedResult, $result);
    }

    public function test_validate_Fail_ThrowsException(){

        $this->xmlDockMock
            ->expects($this->exactly(1))
            ->method('getType')
            ->willReturn('string');

        $this->xmlDockMock
            ->expects($this->exactly(1))
            ->method('validateSchema')
            ->willReturn(false);

        $this->setProtectedProperty($this->instance, 'xsdPath', 'path');

        $this->expectException(InvalidSchema::class);
        $this->instance->validate($this->xmlDockMock);
    }

    private function setProtectedProperty($object, $property, $value)
    {
        $reflection = new ReflectionClass($object);
        $reflection_property = $reflection->getProperty($property);
        $reflection_property->setAccessible(true);
        $reflection_property->setValue($object, $value);
    }
}