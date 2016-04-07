# ASFWebsite Bundle entities

WzebsiteBundle allows you to create and manage website configuration. A website configuration is a set of parameters for dynamically change their values in a backend interface. As you will see, there are not entities that can be directly persisted in this bundle. This bundle provides a model that you can use, the bundle also provides interfaces.

So, for persistance of the entities, you have to create your own bundle who inherit from WebsiteBundle.

```php
<?php
namespace Acme\WebsiteBundle;

use Symfony\Component\HttpKernel\Bundle\Bundle;

class AcmeWebsiteBundle extends Bundle
{
	public function getParent()
	{
		return 'ASFWebsiteBundle';
	}
}
```

For more information about bundle inheritance, check [Symfony documentation][1].

## ConfigModel and ConfigInterface

You have an abstract class on the top of the hierarchy : *ConfigModel* :

```php
<?php
// @ASFWebsiteBundle/Model/Config/ConfigModel.php
namespace ASF\WebsiteBundle\Model\Config;

abstract class ConfigModel implements ConfigInterface { // [...] }
```

As you can see, this class implements *ConfigInterface*. If you do not use this class, ensure that your entities implement this interface. This interface ensures that your entity may use forms and other services from the bundle. It define the class properties used for relations between bundle's entities.

```php
<?php
// @ASFWebsiteBundle/Model/Config/ConfigInterface.php
namespace ASF\WebsiteBundle\Model\Config;

interface ConfigInterface
{
	/**
	 * @return string
	 */
	public function getAlias();
	
	/**
	 * @param string $alias
	 * @return \ASF\WebsiteBundle\Model\Config\ConfigInterface
	 */
	public function setAlias($alias);
	
	/**
	 * @return ArrayCollection
	 */
	public function getParameters();
	
	/**
	 * @param \ASF\WebsiteBundle\Model\Config\ParameterInterface $parameter
	 * @return \ASF\WebsiteBundle\Model\Config\ConfigInterface
	 */
	public function addParameter(ParameterInterface $parameter);
	
	/**
	 * @param \ASF\WebsiteBundle\Model\Config\ParameterInterface $parameter
	 * @return \ASF\WebsiteBundle\Model\Config\ConfigInterface
	 */
	public function removeParameter(ParameterInterface $parameter);

	/**
	 * @return boolean
	 */
	public function getIsDefault();
	
	/**
	 * @param boolean $isDefault
	 * @return \ASF\WebsiteBundle\Model\Config\ConfigInterface
	 */
	public function setIsDefault($isDefault);
}
```

## ParameterModel and ParameterInterface

You have an abstract class on the top of the hierarchy : *ParameterModel* :

```php
<?php
// @ASFWebsiteBundle/Model/Config/ParameterModel.php
namespace ASF\WebsiteBundle\Model\Config;

abstract class ParameterModel implements ParameterInterface { // [...] }
```

As you can see, this class implements *ParameterInterface*. If you do not use this class, ensure that your entities implement this interface. This interface ensures that your entity may use forms and other services from the bundle. It define the class properties used for relations between bundle's entities.

```php
<?php
// @ASFWebsiteBundle/Model/Config/ParameterInterface.php
namespace ASF\WebsiteBundle\Model\Config;

interface ParameterInterface
{
	/**
	 * @return integer
	 */
	public function getId();
	
	/**
	 * @return string
	 */
	public function getName();
	
	/**
	 * @param string $name
	 * @return \ASF\WebsiteBundle\Model\Config\ParameterInterface
	 */
	public function setName($name);
	
	/**
	 * @return mixed
	 */
	public function getValue();
	
	/**
	 * @param mixed $value
	 * @return \ASF\WebsiteBundle\Model\Config\ParameterInterface
	 */
	public function setValue($value);
	
	/**
	 * @return \ASF\WebsiteBundle\Model\Config\ConfigInterface
	 */
	public function getConfig();
	
	/**
	 * @param ConfigInterface $config
	 * @return \ASF\WebsiteBundle\Model\Config\ParameterInterface
	 */
	public function setConfig(ConfigInterface $config);
}
```

[1]: http://symfony.com/doc/current/cookbook/bundles/inheritance.html

