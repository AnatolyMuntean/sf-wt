<?php

namespace AppBundle\Admin;

use AppBundle\Entity\Gun;
use AppBundle\Entity\Shell;
use Sonata\AdminBundle\Admin\AbstractAdmin;
use Sonata\AdminBundle\Datagrid\DatagridMapper;
use Sonata\AdminBundle\Datagrid\ListMapper;
use Sonata\AdminBundle\Form\FormMapper;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\Extension\Core\Type\IntegerType;

class GunPerformanceAdmin extends AbstractAdmin
{
    public function configureFormFields(FormMapper $form)
    {
        $form
            ->add('name')
            ->add('gun', EntityType::class, [
                'class' => Gun::class,
                'choice_label' => 'name',
            ])
            ->add('shell', EntityType::class, [
                'class' => Shell::class,
                'choice_label' => 'name',
            ])
            ->add('at100', IntegerType::class, [
                'label' => 'At 100m',
            ])
            ->add('at250', IntegerType::class, [
                'label' => 'At 250m',
            ])
            ->add('at500', IntegerType::class, [
                'label' => 'At 500m',
            ])
            ->add('at1000', IntegerType::class, [
                'label' => 'At 1000m',
            ])
            ->add('at2000', IntegerType::class, [
                'label' => 'At 2000m',
            ]);
    }

    public function configureDatagridFilters(DatagridMapper $filter)
    {
        $filter
            ->add('name')
            ->add('gun.name')
            ->add('shell.name');
    }

    public function configureListFields(ListMapper $list)
    {
        $list
            ->addIdentifier('name')
            ->add('gun.name')
            ->add('shell.name');
    }

    public function toString($object)
    {
        $object->getName();
    }
}
