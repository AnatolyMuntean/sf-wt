<?php

namespace AppBundle\Admin;

use Sonata\AdminBundle\Admin\AbstractAdmin;
use Sonata\AdminBundle\Datagrid\DatagridMapper;
use Sonata\AdminBundle\Datagrid\ListMapper;
use Sonata\AdminBundle\Form\FormMapper;

class ShellAdmin extends AbstractAdmin
{
    public function configureFormFields(FormMapper $form)
    {
        $form
            ->add('name')
            ->add('abbreviation');
    }

    public function configureDatagridFilters(DatagridMapper $filter)
    {
        $filter->add('name');
    }

    public function configureListFields(ListMapper $list)
    {
        $list
            ->addIdentifier('name')
            ->add('abbreviation');
    }

    public function toString($object)
    {
        return $object->getName();
    }
}
