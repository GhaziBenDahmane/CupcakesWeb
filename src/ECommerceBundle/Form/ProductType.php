<?php

namespace ECommerceBundle\Form;

use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\FileType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Vich\UploaderBundle\Form\Type\VichImageType;

class ProductType extends AbstractType
{
    /**
     * {@inheritdoc}
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('name')
            ->add('type')
            ->add('barcode')
            ->add('price')
            ->add('photo',FileType::class,array('label' => 'Product (Image)','data_class'=>null))
            ->add('promotion',EntityType::class,array('class'=>'ECommerceBundle\Entity\Promotion','choice_label'=>'discount'))
            ->add('description',\Symfony\Component\Form\Extension\Core\Type\TextType::class, array('label' => 'description'))
            ->add('submit', SubmitType::class, array('attr' => array('class' => 'save')));
    }
    
    /**
     * {@inheritdoc}
     */
    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'ECommerceBundle\Entity\Product'
        ));
    }

    /**
     * {@inheritdoc}
     */
    public function getBlockPrefix()
    {
        return 'ecommercebundle_product';
    }


}
