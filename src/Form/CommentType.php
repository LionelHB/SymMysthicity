<?php

namespace App\Form;

use App\Entity\Comment;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\Extension\Core\Type\BirthdayType;


class CommentType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('note', null, [
                'label' => 'Commentaire',
            ])
            ->add('creationDate', BirthdayType::class, [
                'label' => 'Date de création',
                'widget' => 'single_text',
                'format' => 'yyyy-MM-dd', 
               
            ])
            ->add('nft', EntityType::class, [
                'class' => 'App\Entity\Nft',
                'choice_label' => 'name',
                'label' => 'nom',
            ]);
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Comment::class,
        ]);
    }
}
