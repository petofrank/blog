<?php

namespace App\Form;

use App\DTO\CommentDTO;
use App\Entity\Author;
use App\Entity\Post;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\Form\FormInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class CommentType extends AbstractType
{
    /**
     * @param FormBuilderInterface $builder
     * @param array $options
     * @return void
     */
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('author', EntityType::class, array(
                'class' => Author::class,
                'choice_label' => 'username'
            ))
            ->add('content', TextType::class, ['row_attr' => ['class' => 'group-control']])
        ;
    }

    /**
     * @param OptionsResolver $resolver
     * @return void
     */
    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => CommentDTO::class,
            'empty_data' => function (FormInterface $form) {
                    return new CommentDTO("", new \DateTime(), new Post(), new Author());
            }
        ]);
    }
}
