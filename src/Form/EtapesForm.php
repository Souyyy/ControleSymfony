<?php

namespace App\Form;

use App\Entity\Etapes;
use App\Entity\RendusActivites;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\Extension\Core\Type\UrlType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;

class EtapesForm extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('descriptif', TextType::class, [
                'label' => 'Descriptif',
                'attr' => ['class' => 'form-input'],
            ])
            ->add('consignes', TextareaType::class, [
                'label' => 'Consignes',
                'attr' => ['class' => 'form-textarea'],
            ])
            ->add('position_dans_le_parcours', TextType::class, [
                'label' => 'Position dans le parcours',
                'attr' => ['class' => 'form-input'],
            ])
            ->add('save', SubmitType::class, [
                'label' => 'Enregistrer',
                'attr' => ['class' => 'btn btn-primary'],
            ]);
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Etapes::class,
        ]);
    }
}
