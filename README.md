# Sitewards Setup #

[![Build Status](https://travis-ci.org/sitewards/setup.svg?branch=master)](https://travis-ci.org/sitewards/setup)
[![Scrutinizer Code Quality](https://scrutinizer-ci.com/g/sitewards/setup/badges/quality-score.png?b=master)](https://scrutinizer-ci.com/g/sitewards/setup/?branch=master)

This is a module that allows a developer to import and export content and configuration via the command line to any framework, as long as a bridge module for that framework has been built.

## Architecture ##

The service layer in our generic Setup module implements the following:

1. An implementation of `src/Sitewards/Setup/Service/Page/ExporterInterface.php`,
 - Which is making a use of the PageRepository where we retrieve the requested page(s). We then serialize and dump this content to a file.
2. An implementation of `src/Sitewards/Setup/Service/Page/ImporterInterface.php`,
 - Which is making a use of the PageRepository where we try to store the given page(s), after deserializing the content we found inside the `pages.json` file.

Each bridge requires the following:

1. An implementation of `src/Sitewards/Setup/Application/BridgeInterface.php`,
 - The only required method currently is the `getPageRepository()` which serves as a factory method. The method should return your implementation of the `PageRepositoryInterface`. Although not required, we highly suggest that you as well bootstrap the system in use at this point. Please check the `initMagento()` methods in the Magento1 and Magento2 bridges to see a practical example of that.
2. An implementation of `src/Sitewards/Setup/Domain/Page/PageRepositoryInterface.php`,
 - The purpose of this implementation is to give a way to the Setup module to communicate with the underlying system. The `findByIds` and `findAll` methods are used for retrieving the page(s), no matter where they come from (database, filesystem, etc.). The `import` method is used for storing the page(s) into the system.
3. An implementation of `bin/setup`
 - This file acts as the bootstrap point for the bridge module where you would simply instantiate the application and feed it with your implementation of the `Sitewards\Setup\Application\BridgeInterface`

## Bridge ##

To build a bridge you need to use the interface `src/Sitewards/Setup/Domain/Page/PageRepositoryInterface.php` and create an implementation of this interface for your system of choice.

**Current bridges**

1. Magento 1 (https://github.com/sitewards/setup-mage1)
2. Magento 2 (https://github.com/sitewards/setup-mage2)

## Issues ##

To learn about issues, click [here](https://github.com/sitewards/setup/issues). To open an issue, click [here](https://github.com/sitewards/setup/issues/new).

## Authors ##

* David Manners <david.manners@sitewards.com>
* Darko Poposki <darko.poposki@sitewards.com>
