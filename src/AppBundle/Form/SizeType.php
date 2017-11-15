<?php

namespace AppBundle\Form;

use AppBundle\Entity\Size;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\IntegerType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class SizeType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder->add('height', IntegerType::class);
        $builder->add('width', IntegerType::class);
        $builder->add('length', IntegerType::class);
        $builder->add('lengthwithgun', IntegerType::class);
        $builder->add('clearance', IntegerType::class);
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
           'data_class' => Size::class,
        ]);
    }
}

