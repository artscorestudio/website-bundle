<?php
/*
 * This file is part of the Artscore Studio Framework package.
 *
 * (c) Nicolas Claverie <info@artscore-studio.fr>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */
namespace ASF\WebsiteBundle\Form\Type;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

use ASF\WebsiteBundle\Utils\Manager\DefaultManagerInterface;

use Symfony\Component\Form\Extension\Core\Type\TextType;
use ASF\LayoutBundle\Form\Type\BaseCollectionType;
use Symfony\Component\Form\Extension\Core\Type\CheckboxType;

/**
 * Website Config Form
 * 
 * @author Nicolas Claverie <info@artscore-studio.fr>
 *
 */
class ConfigType extends AbstractType
{
    /**
     * @var DefaultManagerInterface
     */
    protected $configManager;
    
    /**
     * @param DefaultManagerInterface $configManager
     */
    public function __construct(DefaultManagerInterface $configManager)
    {
        $this->configManager = $configManager;
    }
    
	/**
	 * {@inheritDoc}
	 * @see \Symfony\Component\Form\AbstractType::buildForm()
	 */
	public function buildForm(FormBuilderInterface $builder, array $options)
	{
		$builder->add('name', TextType::class, array(
			'label' => 'Config name',
			'required' => true
		))
		->add('alias', TextType::class, array(
			'label' => 'Alias (interal use)',
			'required' => true 
		))
		->add('parameters', BaseCollectionType::class, array(
			'entry_type' => ParameterType::class,
			'label' => 'List of parameters',
			'allow_add' => true,
			'allow_delete' => true,
			'prototype' => true,
			'containerId' => 'parameters-collection'
		))
		->add('isDefault', CheckboxType::class, array(
			'label' => 'Configuration par défaut'
		));
	}
	
	/**
	 * {@inheritDoc}
	 * @see \Symfony\Component\Form\AbstractType::configureOptions()
	 */
	public function configureOptions(OptionsResolver $resolver)
	{
		$resolver->setDefaults(array(
			'data_class' => $this->configManager->getClassName(),
			'translation_domain' => 'asf_website'
		));
	}
	
	/**
	 * {@inheritDoc}
	 * @see \Symfony\Component\Form\AbstractType::getName()
	 */
	public function getName()
	{
		return 'website_config_type';
	}
}