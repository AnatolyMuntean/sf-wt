<?php

namespace AppBundle\Admin;

use AppBundle\Entity\Engine;
use AppBundle\Entity\Gun;
use AppBundle\Entity\Size;
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
            ->add('type', 'sonata_type_model', [
                'property' => 'name',
            ])
            ->add('vendor', 'sonata_type_model', [
                'property' => 'country',
            ])
            ->add('guns', 'sonata_type_model', [
                'property' => 'name',
                'multiple' => true,
            ])
            ->add('engine', 'sonata_type_model', [
                'property' => 'name',
            ])
            ->add('size', 'sonata_type_model', [
                'property' => 'name',
                'required' => false,
            ])
            ->add('catalogue_name')
            ->add('original_name')
            ->add('weight', 'integer')
            ->add('description', 'textarea');
    }

    protected function configureDatagridFilters(DatagridMapper $filter)
    {
        $filter
            ->add('name')
            ->add('original_name')
            ->add('catalogue_name');
    }

    protected function configureListFields(ListMapper $list)
    {
        $list
            ->addIdentifier('name')
            ->addIdentifier('original_name')
            ->addIdentifier('catalogue_name');
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
