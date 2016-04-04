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
use ASF\WebsiteBundle\Form\DataTransformer\IdToGroupTransformer;

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
     * @var ASFWebsiteEntityManagerInterface
     */
    protected $parameterManager;
    
    /**
     * @var ASFWebsiteEntityManagerInterface
     */
    protected $groupManager;
    
    /**
     * @param ASFWebsiteEntityManagerInterface $parameterManager
     */
    public function __construct(ASFWebsiteEntityManagerInterface $parameterManager, ASFWebsiteEntityManagerInterface $groupManager)
    {
        $this->parameterManager = $parameterManager;
        $this->groupManager = $groupManager;
    }
    
	/**
	 * {@inheritDoc}
	 * @see \Symfony\Component\Form\AbstractType::buildForm()
	 */
	public function buildForm(FormBuilderInterface $builder, array $options)
	{
		$builder->add('alias', TextType::class, array(
			'label' => 'Alias',
			'required' => true
		))
		->add('value', TextType::class, array(
			'label' => 'Value',
			'required' => true,
		));
		
		$idToGroupTransformer = new IdToGroupTransformer($this->groupManager);
		$builder->add('group', HiddenType::class, array(
			'required' => true
		));
		
		$builder->get('group')->addModelTransformer($idToGroupTransformer);
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