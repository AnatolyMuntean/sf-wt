<?php

namespace AppBundle\Admin;

use AppBundle\Entity\Engine;
use AppBundle\Entity\Gun;
use AppBundle\Entity\Tank;
use AppBundle\Entity\VehicleType;
use AppBundle\Entity\Vendor;
use Sonata\AdminBundle\Admin\AbstractAdmin;
use Sonata\AdminBundle\Datagrid\DatagridMapper;
use Sonata\AdminBundle\Datagrid\ListMapper;
use Sonata\AdminBundle\Form\FormMapper;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;

class TankAdmin extends AbstractAdmin
{
    protected function configureFormFields(FormMapper $form)
    {
        $form
            ->add('name', 'text')
            ->add('type', EntityType::class, [
                'class' => VehicleType::class,
                'choice_label' => 'name',
            ])
            ->add('vendor', EntityType::class, [
                'class' => Vendor::class,
                'choice_label' => 'country',
            ])
            ->add('guns', EntityType::class, [
                'class' => Gun::class,
                'multiple' => true,
                'choice_label' => 'name'
            ])
            ->add('engine', EntityType::class, [
                'class' => Engine::class,
                'choice_label' => 'name',
            ])
            ->add('weight', 'integer');
    }

    protected function configureDatagridFilters(DatagridMapper $filter)
    {
        $filter->add('name');
    }

    protected function configureListFields(ListMapper $list)
    {
        $list
            ->addIdentifier('name')
            ->addIdentifier('original_name');
    }

    /**
     * @param Tank $object
     *
     * @return mixed
     */
    public function toString($object)
    {
        return $object->getName();
    }
}
