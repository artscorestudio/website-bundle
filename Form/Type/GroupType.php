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

use ASF\WebsiteBundle\Entity\Manager\ASFWebsiteEntityManagerInterface;

use Symfony\Component\Form\Extension\Core\Type\TextType;
use ASF\LayoutBundle\Form\Type\BaseCollectionType;

/**
 * Parameter Form
 * 
 * @author Nicolas Claverie <info@artscore-studio.fr>
 *
 */
class GroupType extends AbstractType
{
    /**
     * @var ASFWebsiteEntityManagerInterface
     */
    protected $groupManager;
    
    /**
     * @param ASFWebsiteEntityManagerInterface $groupManager
     */
    public function __construct(ASFWebsiteEntityManagerInterface $groupManager)
    {
        $this->groupManager = $groupManager;
    }
    
	/**
	 * {@inheritDoc}
	 * @see \Symfony\Component\Form\AbstractType::buildForm()
	 */
	public function buildForm(FormBuilderInterface $builder, array $options)
	{
		$builder->add('name', TextType::class, array(
			'label' => 'Name',
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
		));
	}
	
	/**
	 * {@inheritDoc}
	 * @see \Symfony\Component\Form\AbstractType::configureOptions()
	 */
	public function configureOptions(OptionsResolver $resolver)
	{
		$resolver->setDefaults(array(
			'data_class' => $this->groupManager->getClassName(),
			'translation_domain' => 'asf_website'
		));
	}
	
	/**
	 * {@inheritDoc}
	 * @see \Symfony\Component\Form\AbstractType::getName()
	 */
	public function getName()
	{
		return 'website_group_parameter_type';
	}
}