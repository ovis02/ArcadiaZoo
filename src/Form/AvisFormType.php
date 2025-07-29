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
                    'id' => 'pseudo',
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
        // Pas de champs "valide", "validePar", "date" directement geré dans le controller
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Avis::class,
        ]);
    }
}
