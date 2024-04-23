<?php

namespace App\Form;

use App\Entity\Francais;
use App\Entity\Japonais;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\CheckboxType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class JaponaisType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('classe', TextType::class, [
                'required' => false,
            ])
            ->add('mot', TextType::class, [
                'required' => false,
            ])
            ->add('hiragana', TextType::class, [
                'required' => false,
            ])
            ->add('image', TextareaType::class, [
                'required' => false,
            ])
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
            'data_class' => Japonais::class,
        ]);
    }
}
