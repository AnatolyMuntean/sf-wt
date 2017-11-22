<?php

namespace AppBundle\Admin;

use Sonata\AdminBundle\Admin\AbstractAdmin;
use Sonata\AdminBundle\Datagrid\DatagridMapper;
use Sonata\AdminBundle\Datagrid\ListMapper;
use Sonata\AdminBundle\Form\FormMapper;

class VendorAdmin extends AbstractAdmin
{
    protected function configureFormFields(FormMapper $form)
    {
        $form->add('country');
    }

    protected function configureDatagridFilters(DatagridMapper $filter)
    {
        $filter->add('country');
    }

    protected function configureListFields(ListMapper $list)
    {
        $list->addIdentifier('country');
    }

    public function toString($object)
    {
        return $object->getCountry();
    }
}
