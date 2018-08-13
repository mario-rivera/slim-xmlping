<?php
require_once __DIR__.'/../vendor/autoload.php';

use PHPUnit\Framework\TestCase;
use App\XML\XMLResponseBuilder;

class XMLResponseBuilderTest extends TestCase{

    private $instance;
    private $domMock;

    protected function setUp()
    {
        $this->instance = new XMLResponseBuilder();

        $this->domMock = $this->createMock(DOMDocument::class);
        $this->setProtectedProperty($this->instance, 'dom', $this->domMock);
    }

    public function test_getResponse_String(){
        $expectedResult = 'xmlstring';

        $this->domMock
            ->method('saveXML')
            ->willReturn($expectedResult);
        
        $result = $this->instance->getResponse();

        $this->assertEquals($expectedResult, $result);
    }

    public function test_load_Ok_Boolean(){

        $expectedResult = true;

        $this->setProtectedProperty($this->instance, 'type', 'test');
        $this->setProtectedProperty($this->instance, 'xmlPath', 'test');

        $file = 'test' . DIRECTORY_SEPARATOR . 'test' . '.xml';

        $this->domMock
            ->expects($this->exactly(1))
            ->method('load')
            ->with($file, LIBXML_NOERROR)
            ->willReturn($expectedResult);
        
        $result = $this->instance->load();
        
        $this->assertEquals($expectedResult, $result);
    }

    public function test_load_Fail_Boolean(){

        $expectedResult = false;

        $this->setProtectedProperty($this->instance, 'type', 'test');
        $this->setProtectedProperty($this->instance, 'xmlPath', 'test');

        $this->domMock
            ->expects($this->exactly(1))
            ->method('load')
            ->willReturn($expectedResult);
        
        $result = $this->instance->load();
        
        $this->assertEquals($expectedResult, $result);
    }

    public function test_getXMLPath_String(){

        $expectedResult = 'string';

        $this->setProtectedProperty($this->instance, 'xmlPath', $expectedResult);
        
        $result = $this->instance->getXmlPath();
        
        $this->assertEquals($expectedResult, $result);
    }

    private function setProtectedProperty($object, $property, $value)
    {
        $reflection = new ReflectionClass($object);
        $reflection_property = $reflection->getProperty($property);
        $reflection_property->setAccessible(true);
        $reflection_property->setValue($object, $value);
    }
}