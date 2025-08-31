<?php

namespace App\Form;

use App\Entity\User;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\EmailType;
use Symfony\Component\Form\Extension\Core\Type\PasswordType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Validator\Constraints as Assert;

final class AdminUserType extends AbstractType
{
    public function buildForm(FormBuilderInterface $b, array $options): void
    {
        $b->add('email', EmailType::class, [
              'label' => 'Email (identifiant)',
              'attr'  => ['placeholder' => 'employe@zoo.com ou veterinaire@zoo.com'],
              'constraints' => [new Assert\NotBlank(), new Assert\Email()],
          ])
          ->add('plainPassword', PasswordType::class, [
              'label' => $options['is_edit'] ? 'Nouveau mot de passe (optionnel)' : 'Mot de passe',
              'mapped' => false,
              'required' => !$options['is_edit'],
              'constraints' => $options['is_edit'] ? [] : [new Assert\NotBlank(), new Assert\Length(min:8)],
          ])
          ->add('roles', ChoiceType::class, [
              'label' => 'Rôles',
              'expanded' => true,
              'multiple' => true,
              'choices' => [
                  'Employé' => 'ROLE_EMPLOYE',
                  'Vétérinaire' => 'ROLE_VETERINAIRE',
              ],
          ]);
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => User::class,
            'is_edit' => false,
        ]);
    }
}
