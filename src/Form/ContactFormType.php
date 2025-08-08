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
                'attr' => ['class' => 'form-control form-group'],
                'label_attr' => ['class' => 'form-label'],
                'constraints' => [
                    new NotBlank(),
                    new Email(),
                ],
            ])
            ->add('motif', null, [
                'attr' => ['class' => 'form-control form-group'],
                'label_attr' => ['class' => 'form-label'],
                'constraints' => [
                    new NotBlank(),
                ],
            ])
            ->add('messageContact', null, [
                'attr' => ['class' => 'form-control form-group form-description'],
                'label_attr' => ['class' => 'form-label'],
                'constraints' => [
                    new NotBlank(),
                ],
            ]);
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Contact::class,
        ]);
    }
}
