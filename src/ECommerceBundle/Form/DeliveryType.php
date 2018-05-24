<?php

namespace ECommerceBundle\Form;

use ECommerceBundle\Entity\Delivery;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\DateTimeType;
use Symfony\Component\Form\Extension\Core\Type\DateType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\Form\FormEvent;
use Symfony\Component\Form\FormEvents;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\PropertyAccess\PropertyPath;
use Vich\UploaderBundle\Form\Type\VichImageType;

class DeliveryType extends AbstractType
{
    public function buildForm (FormBuilderInterface $builder, array $options)
    {
        $builder

            ->add('status',ChoiceType::class , array(
                'choices' =>array(
                    'Not Delivered'=>'false',
                    'Delivered'=>'true'

                )
            ))
            ->add('imageFile', VichImageType::class);

    }

    public function configureOptions (OptionsResolver $resolver)
    {

        $resolver->setDefaults(array(
            'data_class' => 'ECommerceBundle\Entity\Delivery'
        ));
    }

    public function getBlockPrefix ()
    {
        return 'ecommerce_bundle_delivery_type';
    }
}
