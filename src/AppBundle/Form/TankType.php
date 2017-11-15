<?php

namespace AppBundle\Form;

use AppBundle\Entity\Gun;
use AppBundle\Entity\Tank;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\IntegerType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class TankType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('name', TextType::class)
            ->add('weight', IntegerType::class)
            ->add('original_name', TextType::class)
            ->add('production', ProductionType::class)
            ->add('guns', EntityType::class, [
                'multiple' => true,
                'choices' => $options['all_guns'],
                'choice_label' => function ($gun) {
                    /** @var Gun $gun */
                    return $gun->getName();
                },
                'class' => Gun::class,
            ])
            ->add('size', SizeType::class)
            ->add('Save', SubmitType::class, [
                'label' => 'Save',
            ]);
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => Tank::class,
            'all_guns' => [],
        ]);
    }
}
