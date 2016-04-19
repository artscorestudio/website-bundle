<?php
/*
 * This file is part of the Artscore Studio Framework package.
 *
 * (c) Nicolas Claverie <info@artscore-studio.fr>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */
namespace ASF\WebsiteBundle\Twig\Extension;

use ASF\WebsiteBundle\Utils\Manager\DefaultManagerInterface;
use ASF\WebsiteBundle\Model\Config\ConfigInterface;

/**
 * Website Layout Helpers Extension
 * 
 * @author Nicolas Claverie <info@artscore-studio.fr>
 *
 */
class LayoutHelpersExtension extends \Twig_Extension
{
    /**
     * @var DefaultManagerInterface
     */
    protected $configManager;

    /**
     * @var ConfigInterface
     */
    protected $config;
    
    /**
     * @param DefaultManagerInterface $configManager
     */
    public function __construct(DefaultManagerInterface $configManager)
    {
        $this->configManager = $configManager;
    }
    
    /**
     * {@inheritDoc}
     * @see Twig_Extension::getFunctions()
     */
    public function getFunctions()
    {
        return array(
            new \Twig_SimpleFunction('asf_get_param', array($this, 'getParameter'), array(
                'needs_environment' => true,
                'is_safe' => array('html')
            ))
        );
    }
    
    /**
     * Return the website configuration parameter value
     */
    public function getParameter(\Twig_Environment $environment, $parameterName, $configAlias = null, $debug = false)
    {
    	$defaultConfig = $this->configManager->getRepository()->getDefaultConfiguration();
    	$this->config = count($defaultConfig) > 0 ? $defaultConfig[0] : null;
    	$parameters = array();

    	if ( $configAlias === null && $this->config !== null ) {
    		$params = $this->config->getParameters();
    	} elseif ( $this->config !== null ) {
    		$config = $this->configManager->getRepository()->findOneBy(array('alias' => $configAlias));
    		if ( $config === null ) {
    			throw new \Exception(sprintf('The configuration with name "%s" not found.', $configAlias));
    		}
    		$params = $config->getParameters();
    	}
    	
    	if ( !isset($params) ) {
    		return;
    	}
    	
   		foreach($params as $p) {
   			$parameters[$p->getName()] = $p->getValue();
   		}
    	
    	if ( $debug === true && !isset($parameters[$parameterName]) ) {
    		throw new \Exception(sprintf('The parameter with name "%s" not found.', $parameterName));
    	}
    	
        return isset($parameters[$parameterName]) ? $parameters[$parameterName] : '';
    }
    
    /**
     * {@inheritDoc}
     * @see Twig_ExtensionInterface::getName()
     */
    public function getName()
    {
        return 'asf_website_layout_helpers';
    }
}