<?php
/*
 * This file is part of the Artscore Studio Framework package.
 *
 * (c) Nicolas Claverie <info@artscore-studio.fr>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */
namespace ASF\WebsiteBundle\DependencyInjection;

use Symfony\Component\Config\Definition\Builder\TreeBuilder;
use Symfony\Component\Config\Definition\ConfigurationInterface;

/**
 * This is the class that validates and merges configuration from your app/config files
 *
 * To learn more see {@link http://symfony.com/doc/current/cookbook/bundles/extension.html#cookbook-bundles-extension-config-class}
 */
class Configuration implements ConfigurationInterface
{
    /**
     * {@inheritdoc}
     */
    public function getConfigTreeBuilder()
    {
        $treeBuilder = new TreeBuilder();
        $rootNode = $treeBuilder->root('asf_website');

        // Here you should define the parameters that are allowed to
        // configure your bundle. See the documentation linked above for
        // more information on that topic.
        $rootNode
        	->children()
	        	->scalarNode('form_theme')
	        		->defaultValue('ASFWebsiteBundle:Form:fields.html.twig')
	        	->end()
        		->append($this->addConfigParameterNode())
        		->append($this->addConfigParameterParameterNode())
        	->end();
        
        return $treeBuilder;
    }
    
    /**
     * Add Website Config Entity Configuration
     */
    protected function addConfigParameterNode()
    {
    	$builder = new TreeBuilder();
    	$node = $builder->root('config');
    
    	$node
    		->treatTrueLike(array('form' => array(
    			'type' => "ASF\WebsiteBundle\Form\Type\ConfigType",
    			'name' => 'website_config_type'
    		)))
    		->treatFalseLike(array('form' => array(
    			'type' => "ASF\WebsiteBundle\Form\Type\ConfigType",
    			'name' => 'website_config_type'
    		)))
    		->addDefaultsIfNotSet()
    		->children()
    			->arrayNode('form')
    				->addDefaultsIfNotSet()
    				->children()
    					->scalarNode('type')
    						->defaultValue('ASF\WebsiteBundle\Form\Type\ConfigType')
    					->end()
    					->scalarNode('name')
    						->defaultValue('website_config_type')
    					->end()
    					->arrayNode('validation_groups')
    						->prototype('scalar')->end()
    						->defaultValue(array("Default"))
    					->end()
    				->end()
    			->end()
    		->end()
    	;
    
    	return $node;
    }
    
    /**
     * Add Website Config Parameter Entity Configuration
     */
    protected function addConfigParameterParameterNode()
    {
    	$builder = new TreeBuilder();
    	$node = $builder->root('parameter');
    
    	$node
	    	->treatTrueLike(array('form' => array(
	    		'type' => "ASF\WebsiteBundle\Form\Type\ParameterType",
	    		'name' => 'website_parameter_type'
	    	)))
	    	->treatFalseLike(array('form' => array(
	    		'type' => "ASF\WebsiteBundle\Form\Type\ParameterType",
	    		'name' => 'website_parameter_type'
	    	)))
	    	->addDefaultsIfNotSet()
	    	->children()
		    	->arrayNode('form')
		    	->addDefaultsIfNotSet()
		    	->children()
			    	->scalarNode('type')
			    		->defaultValue('ASF\WebsiteBundle\Form\Type\ParameterType')
			    	->end()
			    	->scalarNode('name')
			    		->defaultValue('website_parameter_type')
			    	->end()
			    	->arrayNode('validation_groups')
			    		->prototype('scalar')->end()
			    		->defaultValue(array("Default"))
			    	->end()
			    	->end()
		    	->end()
	    	->end()
    	;
    
    	return $node;
    }
}
