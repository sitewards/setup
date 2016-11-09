<?php

namespace Sitewards\Setup\Persistence;

interface PageRepositoryInterface
{
    public function findById($id);
}
