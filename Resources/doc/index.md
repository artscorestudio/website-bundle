# Artscore Studio Website Bundle

Website Bundle is a Symfony 2/3 bundle for create and manage frontends in your Symfony 2/3 application. This package is a part of Artscore Studio Framework.

The goal of this bundle is to embedded a set of public website layouts based on Twitter Bootstrap and jQuery. This bundle is a child bundle of [ASFLayoutBundle](https://packagist.org/packages/artscorestudio/layout-bundle). 

> IMPORTANT NOTICE: This bundle is still under development. Any changes will be done without prior notice to consumers of this package. Of course this code will become stable at a certain point, but for now, use at your own risk.

> BE CARREFUL : This bundle does not include external libraries, you must install the libraries via Compoer, in accordance with best practices of Symfony documentation.

## Prerequisites

This version of the bundle requires :
* Symfony >= 2.8 / >= 3+
* [Assetic bundle >= 2.7](https://packagist.org/packages/symfony/assetic-bundle)
* [ASFCoreBundle >= 1](https://packagist.org/packages/artscorestudio/core-bundle)
* [ASFLayoutBundle dev-master](https://packagist.org/packages/artscorestudio/layout-bundle)

### Translations

If you wish to use default texts provided in this bundle, you have to make sure you have translator enabled in your config.

```yaml
# app/config/config.yml
framework:
    translator: ~
```

For more information about translations, check [Symfony documentation](https://symfony.com/doc/current/book/translation.html).

## Installation

### Step 1 : Download ASFWebsiteBundle using composer

Require the bundle with composer :

```bash
$ composer require artscorestudio/website-bundle "1.0.1"
```

Composer will install the bundle to your project's *vendor/artscorestudio/website-bundle* directory. It also install dependencies. 

### Step 2 : Enable the bundle

Enable the bundle in the kernel :

```php
// app/AppKernel.php

public function registerBundles()
{
	$bundles = array(
		// ...
		new ASF\WebsiteBundle\ASFWebsiteBundle()
		// ...
	);
}
```

### Step 3 : Import ASFWebsiteBundle routing files

Now that you have activated and configured the bundle, all that is left to do is import the ASFWebsiteBundle routing files.

By importing the routing files you will have ready made pages for things such as website homepage, etc.

```yaml
asf_website:
    resource: "@ASFWebsiteBundle/Resources/config/routing/routing.yml"
```

### Next Steps

Now you have completed the basic installation and configuration of the ASFWebsiteBundle, you are ready to learn about more advanced features and usages of the bundle.

The following documents are available :
* [Overriding Default ASFWebsiteBundle Templates](templates.md)
* [Overriding Default ASFWebsiteBundle Controllers](controllers.md)
* [Add new items in ASFWebsiteBundle menus](menus.md)
