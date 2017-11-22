<?php

namespace AppBundle\Admin;

use Sonata\AdminBundle\Admin\AbstractAdmin;
use Sonata\AdminBundle\Datagrid\DatagridMapper;
use Sonata\AdminBundle\Datagrid\ListMapper;
use Sonata\AdminBundle\Form\FormMapper;
use Symfony\Component\Form\Extension\Core\Type\IntegerType;

class SizeAdmin extends AbstractAdmin
{
    public function configureFormFields(FormMapper $form)
    {
        $form
            ->add('name')
            ->add('height')
            ->add('width')
            ->add('length')
            ->add('lengthwithgun', IntegerType::class, [
                'label' => 'Length with gun',
            ])
            ->add('clearance');
    }

    public function configureDatagridFilters(DatagridMapper $filter)
    {

    }

    public function configureListFields(ListMapper $list)
    {
        $list->addIdentifier('name');
    }

    public function toString($object)
    {
        return $object->getName();
    }
}
