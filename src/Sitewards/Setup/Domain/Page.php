<?php

namespace Sitewards\Setup\Domain;

use JMS\Serializer\Annotation\Type;

class Page
{
    /**
     * @Type("string")
     */
    private $title;

    /**
     * @Type("string")
     */
    private $content;

    /**
     * @Type("boolean")
     */
    private $active;

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