<?php

namespace App\Form;

use App\Entity\Avis;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\IntegerType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class AvisFormType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('pseudo', null, [
                'attr' => [
                    'class' => 'form-control form-group',
                    'id' => 'pseudo',
                ],
                'label_attr' => ['class' => 'form-label'],
            ])
            ->add('note', IntegerType::class, [
                'label' => 'Note (1 à 5)',
                'attr' => [
                    'class' => 'form-control form-group',
                    'min' => 1,
                    'max' => 5,
                    'step' => 1,
                ],
                'label_attr' => ['class' => 'form-label'],
            ])
            ->add('message', null, [
                'attr' => [
                    'class' => 'form-control form-group',
                    'id' => 'commentaire',
                    'rows' => 5,
                ],
                'label_attr' => ['class' => 'form-label'],
            ]);
        // "valide", "validePar", et "date" sont toujours gérés côté contrôleur
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Avis::class,
        ]);
    }
}
