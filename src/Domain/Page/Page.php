<?php

/**
 * This file is part of the Setup package.
 *
 * (c) Sitewards GmbH
 */

namespace Sitewards\Setup\Domain\Page;

use JMS\Serializer\Annotation\Type;

final class Page implements PageInterface
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
     * {@inheritdoc}
     */
    public function getIdentifier()
    {
        return $this->identifier;
    }

    /**
     * {@inheritdoc}
     */
    public function getTitle()
    {
        return $this->title;
    }

    /**
     * {@inheritdoc}
     */
    public function getContent()
    {
        return $this->content;
    }

    /**
     * {@inheritdoc}
     */
    public function getActive()
    {
        return $this->active;
    }
}
