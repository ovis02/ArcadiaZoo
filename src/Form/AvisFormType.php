<?php

namespace App\Form;

use App\Entity\Avis;
use Symfony\Component\Form\AbstractType;
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
                    'id' => 'pseudo', // ID pour le champ pseudo
                ],
                'label_attr' => ['class' => 'form-label'],
            ])
            ->add('email', null, [
                'attr' => [
                    'class' => 'form-control form-group',
                    'id' => 'email', // ID pour le champ email
                ],
                'label_attr' => ['class' => 'form-label'],
            ])
            ->add('commentaire', null, [
                'attr' => [
                    'class' => 'form-control form-group',
                    'id' => 'commentaire', // ID pour le champ commentaire
                    'rows' => 5,
                ],
                'label_attr' => ['class' => 'form-label'],
            ]);
         
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Avis::class,
        ]);
    }
}
