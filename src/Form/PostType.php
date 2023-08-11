<?php

namespace App\Form;

use App\DTO\PostDTO;
use App\Entity\Author;
use DateTime;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\Form\FormInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class PostType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('author', EntityType::class, [
                'class' => Author::class,
                'choice_label' => 'username'
            ])
            ->add('title', TextType::class, ['row_attr' => ['class' => 'group-control']])
            ->add('content', TextType::class, ['row_attr' => ['class' => 'group-control']])
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => PostDTO::class,
            'empty_data' => function (FormInterface $form) {
                return new PostDTO(
                    "",
                    "",
                    new DateTime(),
                    new Author()
                );
            },
        ]);
    }
}
