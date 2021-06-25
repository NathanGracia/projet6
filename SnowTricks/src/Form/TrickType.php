<?php

namespace App\Form;

use App\Entity\Image;
use App\Entity\Trick;
use App\Repository\GroupRepository;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\CollectionType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class TrickType extends AbstractType
{

    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('title')
            ->add('description')
            ->add('created_at')
            ->add(
                'images',
                CollectionType::class,
                [
                    'entry_type' => TrickImageType::class,

                    'allow_add' => true,
                    'allow_delete' => true,
                    'attr' => [
                        'data-controller' => 'collection',
                        'data-name' => 'image',
                    ],
                    'by_reference' => false
                ]
            )
            ->add(
                'videos',
                CollectionType::class,
                [
                    'entry_type' => TrickVideoType::class,

                    'allow_add' => true,
                    'allow_delete' => true,
                    'attr' => [
                        'data-controller' => 'collection',
                        'data-name' => 'video',
                    ],
                    'by_reference' => false
                ]
            );

    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => Trick::class,
        ]);
    }
}
