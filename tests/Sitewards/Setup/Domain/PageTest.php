<?php

namespace Sitewards\Setup\Domain;

use Doctrine\Common\Annotations\AnnotationRegistry;

class PageTest extends \PHPUnit_Framework_TestCase
{
    /** @var \Jms\Serializer\Serializer */
    private $serializer;

    /**
     * Register the auto loader and build the serializer class we need
     */
    public function setUp()
    {
        AnnotationRegistry::registerAutoloadNamespace(
            'JMS\Serializer\Annotation',
            'vendor/jms/serializer/src'
        );

        $this->serializer = \JMS\Serializer\SerializerBuilder::create()->build();
    }

    /**
     * Unset the serializer after use
     */
    public function tearDown()
    {
        $this->serializer = null;
    }

    /**
     * Test to make sure that strings work
     */
    public function testSuccessfulSerilization()
    {
        /** @var Page $page */
        $page = $this->serializer->deserialize(
            '{
                "title": "test",
                "active": true,
                "content": "Test Page Content"
            }',
            Page::class,
            'json'
        );
        $this->assertEquals('test', $page->getTitle());
        $this->assertTrue($page->getActive());
        $this->assertEquals('Test Page Content', $page->getContent());
    }
}