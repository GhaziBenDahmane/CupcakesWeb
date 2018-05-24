<?php

namespace AppBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\EmailType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Vich\UploaderBundle\Form\Type\VichFileType;

class addContactType extends AbstractType
{
    public function buildForm (FormBuilderInterface $builder, array $options)
    {

        $builder

            ->add('tel')
            ->add('firstName')
            ->add('message')
            ->add('adress')
            ->add('email',EmailType::class)
            ->add('imageFile',VichFileType::class);

    }

    public function configureOptions (OptionsResolver $resolver)
    {

    }

    public function getBlockPrefix ()
    {
        return 'app_bundleadd_contact_type';
    }
}
