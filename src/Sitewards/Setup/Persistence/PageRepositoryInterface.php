<?php

namespace Sitewards\Setup\Persistence;

interface PageRepositoryInterface
{
    public function findByIds(array $ids);
    public function findAll();
}
