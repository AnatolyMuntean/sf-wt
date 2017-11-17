<?php

namespace AppBundle\Form;

use AppBundle\Entity\Gun;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\IntegerType;
use Symfony\Component\Form\Extension\Core\Type\NumberType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class GunType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('name')
            ->add('shell')
            ->add('caliber')
            ->add('description')
            ->add('Save', SubmitType::class, [
                'label' => 'Save',
            ]);
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        return [
            'data_class' => Gun::class,
        ];
    }
}
