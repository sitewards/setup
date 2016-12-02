Sitewards Mage2 Cms Setup
=========================

A simple module that allows a developer to add cms pages, blocks and widgets via the command line to Magento2, Magento1 and other systems.
To define a cms page you must create a json file for the configuration and a html file for the content.

Current status will dump a single page when the files are copied over to Magento2 correclty.

TODO:

Extract `bin/setup` and `src/Sitewards/Setup/Persistence/PageRepositoryMagento2.php` into stand-a-lone Magento2Bridge repo.
This repo will need it's own composer.json, module.xml and registraion.php.
Build a requirment back to the main set-up repository.


Authors
-------

David Manners <david.manners@sitewards.com>,
Darko Poposki <darko.poposki@sitewards.com>