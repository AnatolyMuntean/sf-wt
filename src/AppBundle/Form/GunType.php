<?php

namespace AppBundle\Form;

use AppBundle\Entity\Gun;
use AppBundle\Entity\Shell;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\FileType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
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
            ->add('ammo', EntityType::class, [
                'multiple' => true,
                'choices' => $options['all_shells'],
                'choice_label' => function ($shell) {
                    /** @var Shell $shell */
                    return $shell->getName();
                },
                'class' => Shell::class,
            ])
            ->add('description')
            ->add('imageFile', FileType::class, [
                'required' => false,
            ])
            ->add('Save', SubmitType::class, [
                'label' => 'Save',
            ]);
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => Gun::class,
        ]);

        $resolver->setRequired([
            'all_shells',
        ]);
    }
}
