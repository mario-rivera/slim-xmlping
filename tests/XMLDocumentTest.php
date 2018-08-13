<?php
require_once __DIR__.'/../vendor/autoload.php';

use PHPUnit\Framework\TestCase;
use App\XML\XMLDocument;

class XMLDocumentTest extends TestCase{

    private $instance;
    private $domMock;

    protected function setUp()
    {
        $this->instance = new XMLDocument();

        $this->domMock = $this->createMock(DOMDocument::class);
        $this->setProtectedProperty($this->instance, 'dom', $this->domMock);
    }

    public function test_getTypeElementValue_Ok_String(){

        $expectedResult = 'test_string';
        $method = new ReflectionMethod(XMLDocument::class, 'getTypeElementValue');
        $method->setAccessible(true);

        $domNodeListMock = $this->createMock(DOMNodeList::class);

        $this->domMock
            ->method('getElementsByTagName')
            ->willReturn($domNodeListMock);

        $domNodeListMock
            ->method('item')
            ->willReturn(new DomElement('type', $expectedResult));

        $result = $method->invoke($this->instance);

        $this->assertEquals($expectedResult, $result);
    }

    public function test_getTypeElementValue_Fail_Boolean(){

        $expectedResult = false;
        $method = new ReflectionMethod(XMLDocument::class, 'getTypeElementValue');
        $method->setAccessible(true);

        $domNodeListMock = $this->createMock(DOMNodeList::class);

        $this->domMock
            ->method('getElementsByTagName')
            ->willReturn($domNodeListMock);

        $domNodeListMock
            ->method('item')
            ->willReturn(null);

        $result = $method->invoke($this->instance);

        $this->assertEquals($expectedResult, $result);
    }

    public function test_getTagValue_Ok_String(){

        $expectedResult = 'test_string';

        $domNodeListMock = $this->createMock(DOMNodeList::class);

        $this->domMock
            ->expects($this->exactly(1))
            ->method('getElementsByTagName')
            ->with('tag')
            ->willReturn($domNodeListMock);

        $domNodeListMock
            ->method('item')
            ->willReturn(new DomElement('type', $expectedResult));

        $result = $this->instance->getTagValue('tag');

        $this->assertEquals($expectedResult, $result);
    }

    public function test_validateSchema_Ok_Boolean(){

        $expectedResult = true;

        $domNodeListMock = $this->createMock(DOMNodeList::class);

        $this->domMock
            ->expects($this->exactly(1))
            ->method('schemaValidate')
            ->with('schema')
            ->willReturn($expectedResult);

        $result = $this->instance->validateSchema('schema');

        $this->assertEquals($expectedResult, $result);
    }

    public function test_validateSchema_Fail_Boolean(){

        $expectedResult = false;

        $domNodeListMock = $this->createMock(DOMNodeList::class);

        $this->domMock
            ->expects($this->exactly(1))
            ->method('schemaValidate')
            ->with('schema')
            ->willReturn($expectedResult);

        $result = $this->instance->validateSchema('schema');

        $this->assertEquals($expectedResult, $result);
    }

    public function test_load_Ok_Boolean(){

        $expectedResult = true;

        $domNodeListMock = $this->createMock(DOMNodeList::class);

        $this->domMock
            ->expects($this->exactly(1))
            ->method('load')
            ->with('filename')
            ->willReturn($expectedResult);

        $result = $this->instance->load('filename');

        $this->assertEquals($expectedResult, $result);
    }

    public function test_loadXML_Ok_Boolean(){

        $expectedResult = true;

        $domNodeListMock = $this->createMock(DOMNodeList::class);

        $this->domMock
            ->expects($this->exactly(1))
            ->method('loadXML')
            ->with('xml')
            ->willReturn($expectedResult);

        $result = $this->instance->loadXML('xml');

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