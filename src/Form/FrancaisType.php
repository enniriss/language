<?php

namespace App\Form;

use App\Entity\Arabe;
use App\Entity\Francais;
use App\Entity\Japonais;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\CheckboxType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\Extension\Core\Type\TextType;

class FrancaisType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('classe', ChoiceType::class, [
                'choices' => ["Verbe" => 0, 
                "Nom propre" => "Nom propre", 
                "Nom commun" => "Nom commun", 
                "Déterminant" => "Déterminant", 
                "Pronom" => "Pronom", 
                "Préposition" => "Préposition", 
                "Conjonction" => "Conjonction"],
    'required' => false,
            ])
            ->add('mot', TextType::class, [
                'required' => false,
            ])
            ->add('image')
            ->add('japonais', EntityType::class, [
                'required' => false,
                'class' => Japonais::class,
'choice_label' => 'mot',
'multiple' => true,
            ])
            ->add('arabe', EntityType::class, [
                'required' => false,
                'class' => Arabe::class,
'choice_label' => 'mot',
'multiple' => true,
            ])
        ;

    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Francais::class,
        ]);
    }
}
