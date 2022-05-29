<?php

namespace App\Form;

use App\Entity\Program;
use App\Entity\Season;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\IntegerType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class SeasonType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('number', IntegerType::class, [
                'label' => 'Saison n°'
            ])
            ->add('year', IntegerType::class, [
                'label' => 'Année'
            ])
            ->add('description', TextType::class, [
                'label' => 'Résumé'
            ])
            ->add('program', EntityType::class, [
                'class' => Program::class,
                'choice_label' => 'title',
                'label' => 'Série'
            ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Season::class,
        ]);
    }
}
