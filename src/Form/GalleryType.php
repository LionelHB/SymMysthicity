<?php

namespace App\Form;

use App\Entity\Gallery;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\Extension\Core\Type\BirthdayType;



class GalleryType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('name', null, [
                'label' => 'Nom',
            ])
            
            ->add('description', null, [
                'label' => 'Description',
            ])
            ->add('creationDate', BirthdayType::class, [
                'label' => 'Date de création',
                'widget' => 'single_text',
                'format' => 'yyyy-MM-dd', 
               
            ])
            ->add('owner', EntityType::class, [
                'class' => 'App\Entity\User',
                'choice_label' => 'username',
                'label' => 'Propriétaire',
            ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Gallery::class,
        ]);
    }
}
