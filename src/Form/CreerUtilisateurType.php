<?php

namespace App\Form;

use App\Entity\Utilisateurs;
use Symfony\Component\Form\FormEvent;
use Symfony\Component\Form\FormEvents;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormInterface;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\EmailType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\PasswordType;


class CreerUtilisateurType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('username', TextType::class, [
                'required' => true,
                'label' => 'Identifiant'
            ])
            ->add('civiliteUtilisateurs', ChoiceType::class, [
                'choices' => [
                    'Madame' => 'Mme',
                    'Monsieur' => 'M.'
                ],
                'label' => 'Civilité'
            ])
            ->add('nomUtilisateurs', TextType::class, [
                'required' => true, 'label' => 'Nom'
            ])
            ->add('prenomUtilisateurs', TextType::class, [
                'required' => true,
                'label' => 'Prénom'
            ])
            ->add('emailUtilisateurs', EmailType::class, [
                'required' => true,
                'label' => 'Email'
            ])
            ->add('password', PasswordType::class, [
                'required' => true,
                'label' => 'Mot de passe'
            ])
            ->add('confirmPassword', PasswordType::class, [
                'required' => true,
                'label' => 'Confirmer le mot de passe'
            ])
            ->add('adresse1Utilisateurs', TextType::class, [
                'required' => true,
                'label' => 'Adresse'
            ])
            ->add('adresse2Utilisateurs', TextType::class, [
                'required' => false,
                'label' => 'Complément d\'adresse'
            ])

            ->add(
                'codePostalUtilisateurs',
                TextType::class,
                [
                    'required' => true,
                    'label' => 'Code postal'
                ],
                [
                    'attr' => [
                        'placeholder' => 'Code Postal',
                    ]
                ]

            )
            ->add('ville', ChoiceType::class, [

                'label' => 'Ville'
            ]);
        $formModifier = function (FormInterface $form, $ville) {
            //dd($ville);
            $form->add(
                'ville',
                ChoiceType::class,
                ['choices' => [
                    $ville => $ville
                ], 'label' => 'Ville']
            );
        };

        $builder->get('ville')->addEventListener(
            FormEvents::POST_SUBMIT,
            function (FormEvent $event) use ($formModifier) {
                $data = $event->getForm()->getData();
                $formModifier($event->getForm()->getParent(), $data);
            }
        );
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => Utilisateurs::class,
        ]);
    }
}
