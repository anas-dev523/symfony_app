<?php

namespace App\Form;

use App\Entity\RetourExperience;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class RetourExperienceType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('contenu', TextareaType::class, [
                'label' => 'Partager votre retour',
            ])
            ->add('emoji', ChoiceType::class, [
                'label' => 'Humeur',
                'choices' => [
                    '😀 Super' => '😀',
                    '🙂 Bien' => '🙂',
                    '😐 Bof' => '😐',
                    '😕 Mitigé' => '😕',
                ],
                'placeholder' => 'Choisir un emoji',
            ]);
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => RetourExperience::class,
        ]);
    }
}

