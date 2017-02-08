<?php

/**
 * This file is part of the Setup package.
 *
 * (c) Sitewards GmbH
 */

namespace Sitewards\Setup\Service\Page;

interface ExporterInterface
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
