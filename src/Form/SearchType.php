<?php

namespace App\Form;

use App\Entity\Search;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\TextType;

class SearchType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('searchTitre', TextType::class, ['required' => false, 'label' => 'Recherche', 'attr' => ['placeholder' => 'Cherchez dans les titres...'], ])
            ->add('searchPrix', TextType::class, ['required' => false, 'label' => 'Recherche', 'attr' => ['placeholder' => 'Cherchez dans les prix...'], ])
            ->add('searchCategorie', TextType::class, ['required' => false, 'label' => 'Recherche', 'attr' => ['placeholder' => 'Cherchez dans les categories...'], ])
            ->add('searchType', TextType::class, ['required' => false, 'label' => 'Recherche', 'attr' => ['placeholder' => 'Cherchez dans les types...'], ]);
        
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => Search::class,
            'method' => 'get',
            'csrf_protection' => false,
        ]);
    }

     public function getBlockPrefix()
    {
        return '';
    }
}
