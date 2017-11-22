<?php

namespace AppBundle\Admin;

use Sonata\AdminBundle\Admin\AbstractAdmin;
use Sonata\AdminBundle\Datagrid\DatagridMapper;
use Sonata\AdminBundle\Datagrid\ListMapper;
use Sonata\AdminBundle\Form\FormMapper;

class EngineAdmin extends AbstractAdmin
{
    public function configureFormFields(FormMapper $form)
    {
        $form
            ->add('name')
            ->add('vendor', 'sonata_type_model', [
                'property' => 'country'
            ])
            ->add('horsepower')
            ->add('displacement')
            ->add('type')
            ->add('description');
    }

    public function configureDatagridFilters(DatagridMapper $filter)
    {
        $filter
            ->add('name')
            ->add('vendor.country', null, [
                'label' => 'Vendor',
            ])
            ->add('type');
    }

    public function configureListFields(ListMapper $list)
    {
        $list
            ->addIdentifier('name')
            ->add('vendor.country', null, [
                'label' => 'Vendor'
            ])
            ->add('type');
    }

    public function toString($object)
    {
        return $object->getName();
    }
}
