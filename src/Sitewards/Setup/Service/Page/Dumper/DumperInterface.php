<?php

namespace Sitewards\Setup\Service\Page\Dumper;

interface DumperInterface
{
    /**
     * @param array $identifier
     */
    public function setIdentifier(array $identifier = []);

    /**
     * @return void
     */
    public function execute();
}
