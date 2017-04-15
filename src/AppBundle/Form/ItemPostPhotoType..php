<?php
/**
 * Created by PhpStorm.
 * User: DaveRodri
 * Date: 4/15/17
 * Time: 2:40 AM
 */

namespace AppBundle\Form;

use AppBundle\Entity\ItemPostPhoto;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\FileType;


class ItemPostPhotoType extends AbstractType
{

    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            // ...
            ->add('itemPostPhoto', FileType::class, array('label' => 'Photo (image file)'))
            // ...
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => ItemPostPhoto::class,
        ));
    }
}