<?php

namespace AppBundle\Admin;

use AppBundle\Entity\Tank;
use Sonata\AdminBundle\Admin\AbstractAdmin;
use Sonata\AdminBundle\Datagrid\DatagridMapper;
use Sonata\AdminBundle\Datagrid\ListMapper;
use Sonata\AdminBundle\Form\FormMapper;
use Sonata\CoreBundle\Model\Metadata;

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
            ->add('imagefile', 'file', [
                'required' => false,
            ])
            ->add('description', 'textarea', [
                'required' => false,
            ]);
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
            ->add('original_name')
            ->add('catalogue_name')
            ->add('vendor.country', null, [
                'label' => 'Vendor',
            ]);
    }

    public function getObjectMetadata($object)
    {
        $imageUrl = '/uploads/'.$object->getImage();
        return new Metadata($object->getName(), $object->getOriginalname(), $imageUrl);
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
