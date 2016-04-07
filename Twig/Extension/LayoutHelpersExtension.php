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

use ASF\WebsiteBundle\Entity\Manager\ASFWebsiteEntityManagerInterface;
use ASF\WebsiteBundle\Model\Config\ConfigInterface;
use Doctrine\Common\Collections\ArrayCollection;

/**
 * Website Layout Helpers Extension
 * 
 * @author Nicolas Claverie <info@artscore-studio.fr>
 *
 */
class LayoutHelpersExtension extends \Twig_Extension
{
    /**
     * @var ASFWebsiteEntityManagerInterface
     */
    protected $configManager;

    /**
     * @var ConfigInterface
     */
    protected $config;
    
    /**
     * @param ASFWebsiteEntityManagerInterface $configManager
     */
    public function __construct(ASFWebsiteEntityManagerInterface $configManager)
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

    	if ( $configAlias === null ) {
    		$params = $this->config->getParameters();
    	} else {
    		$config = $this->configManager->getRepository()->findOneBy(array('alias' => $configAlias));
    		if ( $config === null ) {
    			throw new \Exception(sprintf('The configuration with name "%s" not found.', $configAlias));
    		}
    		$params = $config->getParameters();
    	}
    	
    	if ( isset($params) ) {
    		foreach($params as $p) {
    			$parameters[$p->getName()] = $p->getValue();
    		}
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