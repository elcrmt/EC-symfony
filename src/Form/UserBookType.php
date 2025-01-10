<?php

namespace App\Form;

use App\Entity\Book;
use App\Entity\Category;
use App\Entity\UserBook;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\CheckboxType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Doctrine\ORM\EntityRepository;

class UserBookType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('book', EntityType::class, [
                'class' => Book::class,
                'choice_label' => 'name',
                'placeholder' => 'Choisissez un livre',
                'required' => true,
                'label' => 'Livre',
                'query_builder' => function (EntityRepository $er) {
                    return $er->createQueryBuilder('b')
                        ->orderBy('b.name', 'ASC');
                },
                'attr' => [
                    'class' => 'select'
                ]
            ])
            ->add('category', EntityType::class, [
                'class' => Category::class,
                'choice_label' => 'name',
                'mapped' => false,
                'required' => false,
                'label' => 'Catégorie',
                'disabled' => true,
                'attr' => [
                    'class' => 'select',
                    'readonly' => true
                ]
            ])
            ->add('notes', TextareaType::class, [
                'required' => false,
                'label' => 'Mes notes',
                'attr' => [
                    'class' => 'textarea',
                    'placeholder' => 'Notez-ici les idées importantes de l\'oeuvre.'
                ]
            ])
            ->add('rating', ChoiceType::class, [
                'required' => false,
                'label' => 'Note',
                'choices' => [
                    '1 étoile' => '1',
                    '1.5 étoiles' => '1.5',
                    '2 étoiles' => '2',
                    '2.5 étoiles' => '2.5',
                    '3 étoiles' => '3',
                    '3.5 étoiles' => '3.5',
                    '4 étoiles' => '4',
                    '4.5 étoiles' => '4.5',
                    '5 étoiles' => '5',
                ],
                'attr' => [
                    'class' => 'select'
                ]
            ])
            ->add('isFinished', CheckboxType::class, [
                'required' => false,
                'label' => 'Lecture terminée',
                'label_attr' => [
                    'class' => 'switch-label font-normal text-gray-900'
                ],
                'attr' => [
                    'class' => 'switch-input'
                ]
            ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => UserBook::class,
            'csrf_protection' => false,
        ]);
    }
}
