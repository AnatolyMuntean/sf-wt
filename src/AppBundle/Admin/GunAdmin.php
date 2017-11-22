<?php

namespace AppBundle\Admin;

use AppBundle\Entity\Shell;
use AppBundle\Entity\Vendor;
use Sonata\AdminBundle\Admin\AbstractAdmin;
use Sonata\AdminBundle\Datagrid\DatagridMapper;
use Sonata\AdminBundle\Datagrid\ListMapper;
use Sonata\AdminBundle\Form\FormMapper;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;

class GunAdmin extends AbstractAdmin
{
    public function configureFormFields(FormMapper $form)
    {
        $form
            ->add('name')
            ->add('vendor', 'sonata_type_model', [
                'property' => 'country'
            ])
            ->add('ammo', 'sonata_type_model', [
                'property' => 'name',
                'multiple' => true,
            ])
            ->add('shell')
            ->add('caliber');
    }

    public function configureDatagridFilters(DatagridMapper $filter)
    {
        $filter
            ->add('name')
            ->add('vendor.country', null, [
                'label' => 'Vendor',
            ]);
    }

    public function configureListFields(ListMapper $list)
    {
        $list
            ->addIdentifier('name')
            ->addIdentifier('vendor', EntityType::class, [
                'class' => Vendor::class,
                'associated_property' => 'country',
            ]);
    }

    public function toString($object)
    {
        return $object->getName();
    }
}
