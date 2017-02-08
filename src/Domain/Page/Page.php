<?php

/**
 * This file is part of the Setup package.
 *
 * (c) Sitewards GmbH
 */

namespace Sitewards\Setup\Domain\Page;

use JMS\Serializer\Annotation\Type;

class Page
{
    /**
     * @var string
     *
     * @Type("string")
     */
    private $identifier;

    /**
     * @var string
     *
     * @Type("string")
     */
    private $title;

    /**
     * @var string
     *
     * @Type("string")
     */
    private $content;

    /**
     * @var bool
     *
     * @Type("boolean")
     */
    private $active;

    /**
     * @param string $identifier
     * @param string $title
     * @param string $content
     * @param boolean $active
     */
    public function __construct(
        $identifier,
        $title,
        $content,
        $active
    )
    {
        $this->identifier = $identifier;
        $this->title      = $title;
        $this->content    = $content;
        $this->active     = $active;
    }

    /**
     * @return string
     */
    public function getIdentifier()
    {
        return $this->identifier;
    }

    /**
     * @return string
     */
    public function getTitle()
    {
        return $this->title;
    }

    /**
     * @return string
     */
    public function getContent()
    {
        return $this->content;
    }

    /**
     * @return boolean
     */
    public function getActive()
    {
        return $this->active;
    }
}
