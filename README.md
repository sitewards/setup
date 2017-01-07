# Sitewards Setup #

This is a module that allows a developer to add and dumb content and configuration via the command line to a framework, as long as a bridge module for that framework has been built.

## Bridge ##

To build a bridge you need to use the interface `src/Sitewards/Setup/Domain/Page/PageRepositoryInterface.php` and create an implementation of this interface for your system of choice.

** Current bridges **

1. Magento 2 (https://bitbucket.org/dmanners/setup-mage2)

Authors
-------

* David Manners <david.manners@sitewards.com>
* Darko Poposki <darko.poposki@sitewards.com>