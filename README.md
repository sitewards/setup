# Sitewards Setup #

This is a module that allows a developer to import and export content and configuration via the command line to any framework, as long as a bridge module for that framework has been built.

## Architecture ##

Each bridge requires the following:

1. An implementation of `src/Sitewards/Setup/Application/BridgeInterface.php`,
2. An implementation of `src/Sitewards/Setup/Domain/Page/PageRepositoryInterface.php`,
3. An implementation of `src/Sitewards/Setup/Service/Page/ExporterInterface.php`,
4. An implementation of `src/Sitewards/Setup/Service/Page/ImporterInterface.php`,

## Bridge ##

To build a bridge you need to use the interface `src/Sitewards/Setup/Domain/Page/PageRepositoryInterface.php` and create an implementation of this interface for your system of choice.

**Current bridges**

1. Magento 2 (https://github.com/sitewards/setup-mage2)

### Authors ###

* David Manners <david.manners@sitewards.com>
* Darko Poposki <darko.poposki@sitewards.com>
