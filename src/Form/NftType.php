<?php

namespace App\Form;

use App\Entity\Nft;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\Extension\Core\Type\BirthdayType;

class NftType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('name', null, [
                'label' => 'Nom',
            ])
            ->add('creator', null, [
                'label' => 'Créateur',
            ])
            ->add('creationDate', BirthdayType::class, [
                'label' => 'Date de création',
                'widget' => 'single_text',
                'format' => 'yyyy-MM-dd', 
               
            ])
            
            ->add('firstDateSale', BirthdayType::class, [
                'label' => 'Date de première vente',
                'widget' => 'single_text',
                'format' => 'yyyy-MM-dd',
               
            ])
            
            ->add('lastDateSale', BirthdayType::class, [
                'label' => 'Date de dernière vente',
                'widget' => 'single_text',
                'format' => 'yyyy-MM-dd',
               
            ])
            ->add('identificationKey', null, [
                'label' => 'Clé d\'identification',
            ])
            ->add('nftPath', null, [
                'label' => 'Chemin du Nft',
            ])
            ->add('price', null, [
                'label' => 'Prix en ETH',
            ])
          
            ->add('quantity', null, [
                'label' => 'Quantitée',
            ])
            ->add('view', null, [
                'label' => 'Nombre de vues',
            ])
            ->add('likes', null, [
                'label' => 'Nombre de "j\'aime"',
            ])
            ->add('favoris', null, [
                'label' => 'Nombre de fois mit en favori',
            ])
            ->add('description', null, [
                'label' => 'Description',
            ])
            ->add('anthology', EntityType::class, [
                'class' => 'App\Entity\Anthology',
                'choice_label' => 'name',
                'label' => 'Collection',
            ])
            ->add('subCategory', EntityType::class, [
                'class' => 'App\Entity\subCategory',
                'choice_label' => 'name',
                'label' => 'Sous-catégorie',
            ])
            ->add('owner', EntityType::class, [
                'class' => 'App\Entity\user',
                'choice_label' => 'username',
                'label' => 'Propriétaire',
                
            ]);
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Nft::class,
        ]);
    }
}
