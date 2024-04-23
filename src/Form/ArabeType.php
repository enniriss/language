<?php

namespace App\Form;

use App\Entity\Arabe;
use App\Entity\Francais;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\TextType;

class ArabeType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
        ->add('classe', ChoiceType::class, [
            'choices' => ["Verbe" => 0, 
                "Nom propre" => "Nom propre", 
                "Nom commun" => "Nom commun", 
                "Pronom" => "Pronom", 
                "Préposition" => "Préposition", 
                "Conjonction" => "Conjonction"],
            'required' => false,
        ])
        ->add('mot', TextType::class, [
            'required' => false,
            'attr' => ['class' => 'arabe', 'style' => 'text-align: right'],
        ])
        ->add('image')
        
            ->add('francais', EntityType::class, [
                'label' => 'Mot Français',
                'required' => false,
                'class' => Francais::class,
'choice_label' => 'mot',
'multiple' => true,
            ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Arabe::class,
        ]);
    }
}
