<?php

namespace App\Form;

use App\Entity\Annonce;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;

class AnnonceType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('titre')
            ->add('description')
            ->add('prix')
            ->add('photo')
            ->add('categorie', ChoiceType::class, ['placeholder' => 'catégorie de l\'annonce', 'choices' => ['location' => 'Location', 'vente' => 'Vente'], ])
            ->add('type', ChoiceType::class, ['placeholder' => 'type de bien', 'choices' => ['maison' => 'Maison', 'appartement' => 'Appartement'], ])
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
