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
use Doctrine\Common\Collections\ArrayCollection;

/**
 * Website Extension for layout
 * 
 * @author Nicolas Claverie <info@artscore-studio.fr>
 *
 */
class WebsiteExtension extends \Twig_Extension
{
    /**
     * @var ASFWebsiteEntityManagerInterface
     */
    protected $websiteConfigManager;

    /**
     * @var ArrayCollection
     */
    protected $config;
    
    /**
     * @param ASFWebsiteEntityManagerInterface $websiteConfigManager
     */
    public function __construct(ASFWebsiteEntityManagerInterface $websiteConfigManager, $defaultConfigId)
    {
        $this->websiteConfigManager = $websiteConfigManager;
        
        $group = $this->websiteConfigManager->getRepository()->findOneBy(array('id' => $defaultConfigId));
        foreach($group->getParameters() as $parameter) {
        	$this->config[$parameter->getAlias()] = $parameter->getValue();
        }
    }
    
    /**
     * {@inheritDoc}
     * @see Twig_Extension::getFunctions()
     */
    public function getFunctions()
    {
        return array(
            new \Twig_SimpleFunction('get_metas', array($this, 'getMetas'), array(
                'needs_environment' => true,
                'is_safe' => array('html')
            ))
        );
    }
    
    /**
     * Return the metas
     */
    public function getMetas(\Twig_Environment $environment, $key)
    {
    	if ( !isset($this->config['meta-'.$key]) ) {
    		throw new \Exception(sprintf('The parameter with key "%s" does not exists.', $key));
    	}
        return $this->config['meta-'.$key];
    }
    
    /**
     * {@inheritDoc}
     * @see Twig_ExtensionInterface::getName()
     */
    public function getName()
    {
        return 'asf_layout_tinymce';
    }
}