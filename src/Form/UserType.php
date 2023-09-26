<?php

namespace App\Form;

use App\Entity\User;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\BirthdayType;

class UserType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('email', null, [
                'label' => 'Adresse e-mail',
            ])
            ->add('password', null, [
                'label' => 'Mot de passe',
            ])
            ->add('firstname', null, [
                'label' => 'Prénom',
            ])
            ->add('lastname', null, [
                'label' => 'Nom de famille',
            ])
            ->add('username', null, [
                'label' => 'Nom d\'utilisateur',
            ])
            ->add('isMan', ChoiceType::class, [ // Utilisez ChoiceType pour un choix
                'label' => 'Sexe',
                'choices' => [
                    'Homme' => true,
                    'Femme' => false,
                ],
                'expanded' => true, // Pour afficher les deux choix comme des boutons radio
                'multiple' => false, // Pour n'autoriser qu'un seul choix
            ])
            ->add('birthdayDate', BirthdayType::class, [
                'widget' => 'single_text',
                'format' => 'yyyy-MM-dd',
                'label' => 'Date de naissance',
            ]);
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => User::class,
        ]);
    }
}
