<?php

namespace App\Form;

use App\Entity\Annonce;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;

use Vich\UploaderBundle\Form\Type\VichImageType;

class AnnonceType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('titre')
            ->add('description')
            ->add('prix')
            // ->add('photo')
            ->add('photoFile', VichImageType::class, [
            'required' => false,
            'allow_delete' => true,
            'delete_label' => 'Supprimer',
            'download_label' => true,
            'download_uri' => true,
            'image_uri' => true,
            'asset_helper' => true,])
            ->add('categorie', ChoiceType::class, ['placeholder' => 'catégorie de l\'annonce', 'choices' => ['Location' => 'location', 'Vente' => 'vente'], ])
            ->add('type', ChoiceType::class, ['placeholder' => 'type de bien', 'choices' => ['Maison' => 'maison', 'Appartement' => 'appartement'], ])
            // ->add('createdAt')
            // ->add('updatedAt')
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => Annonce::class,
        ]);
    }
}
