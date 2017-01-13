<?php

/**
 * This file is part of the Setup package.
 *
 * (c) Sitewards GmbH
 */

namespace Sitewards\Setup\Domain\Page;

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
    public function testSuccessfulDeserialization()
    {
        /** @var Page $page */
        $page = $this->serializer->deserialize(
            '{
                "identifier": "test-id",
                "title": "Test Title",
                "active": true,
                "content": "Test Page Content"
            }',
            Page::class,
            'json'
        );
        $this->assertEquals('test-id', $page->getIdentifier());
        $this->assertEquals('Test Title', $page->getTitle());
        $this->assertTrue($page->getActive());
        $this->assertEquals('Test Page Content', $page->getContent());
    }

    /**
     * Test to make sure that strings work
     */
    public function testSuccessfulSerialization()
    {
        /** @var Page $page */
        $page = new Page(
            'test-id',
            'Test Title',
            'Test Page Content',
            true
        );
        $pageJson = $this->serializer->serialize($page, 'json');
        $this->assertEquals(
            '{"identifier":"test-id","title":"Test Title","content":"Test Page Content","active":true}',
            $pageJson
        );
    }
}
