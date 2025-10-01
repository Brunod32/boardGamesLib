<?php

namespace App\Form;

use App\Entity\Category;
use App\Entity\Game;
use App\Entity\NbPlayer;

use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;

class GameType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('name')
            ->add('duration')
            ->add('lastDatePlayed')
            ->add('note', ChoiceType::class, [
                'choices' => array_combine(range(0, 10), range(0, 10)),
                'placeholder' => 'Sélectionnez une note',
                'required' => false, // La note est nullable dans votre entité
            ])
            ->add('nbPlayers', EntityType::class, [
                'class' => NbPlayer::class,
                'placeholder' => 'Sélectionnez un nombre de joueurs',
                'choice_label' => 'playersLabel',
            ])
            ->add('category', EntityType::class, [
                'class' => Category::class,
                'placeholder' => 'Sélectionnez une catégorie',
                'choice_label' => 'name',
            ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Game::class,
        ]);
    }
}
