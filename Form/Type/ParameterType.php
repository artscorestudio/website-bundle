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
use ASF\WebsiteBundle\Form\DataTransformer\IdToConfigTransformer;

use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\HiddenType;

/**
 * Parameter Form
 * 
 * @author Nicolas Claverie <info@artscore-studio.fr>
 *
 */
class ParameterType extends AbstractType
{
    /**
     * @var DefaultManagerInterface
     */
    protected $parameterManager;
    
    /**
     * @var DefaultManagerInterface
     */
    protected $configManager;
    
    /**
     * @param DefaultManagerInterface $parameterManager
     * @param DefaultManagerInterface $configManager
     */
    public function __construct(DefaultManagerInterface $parameterManager, DefaultManagerInterface $configManager)
    {
        $this->parameterManager = $parameterManager;
        $this->configManager = $configManager;
    }
    
	/**
	 * {@inheritDoc}
	 * @see \Symfony\Component\Form\AbstractType::buildForm()
	 */
	public function buildForm(FormBuilderInterface $builder, array $options)
	{
		$builder->add('name', TextType::class, array(
			'label' => 'Parameter name',
			'required' => true
		))
		->add('value', TextType::class, array(
			'label' => 'Parameter value',
			'required' => true,
		));
		
		$builder->add('config', HiddenType::class, array(
			'required' => true
		));
		
		$builder->get('config')->addModelTransformer(new IdToConfigTransformer($this->configManager));
	}
	
	/**
	 * {@inheritDoc}
	 * @see \Symfony\Component\Form\AbstractType::configureOptions()
	 */
	public function configureOptions(OptionsResolver $resolver)
	{
		$resolver->setDefaults(array(
			'data_class' => $this->parameterManager->getClassName(),
			'translation_domain' => 'asf_website'
		));
	}
	
	/**
	 * {@inheritDoc}
	 * @see \Symfony\Component\Form\AbstractType::getName()
	 */
	public function getName()
	{
		return 'website_parameter_type';
	}
}