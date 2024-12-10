<?php

namespace App\Form;

use App\Entity\Contact;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Validator\Constraints\Email;
use Symfony\Component\Validator\Constraints\NotBlank;

class ContactFormType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('email', null, [
                'attr' => ['class' => 'form-control form-group'], // Classe pour le champ email
                'label_attr' => ['class' => 'form-label'],         // Classe pour le label
                'constraints' => [
                    new NotBlank(), // Contrainte de champ obligatoire
                    new Email(),    // Contrainte format email
                ],
            ])
            ->add('motif', null, [
                'attr' => ['class' => 'form-control form-group'], // Classe pour le champ motif
                'label_attr' => ['class' => 'form-label'],         // Classe pour le label
            ])
            ->add('description', null, [
                'attr' => ['class' => 'form-control form-group form-description'], // Classe pour le champ description
                'label_attr' => ['class' => 'form-label'],         // Classe pour le label
            ]);
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Contact::class,
        ]);
    }
}
