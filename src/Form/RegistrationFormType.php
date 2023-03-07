<?php

namespace App\Form;

use App\Entity\Agence;
use App\Entity\CompteCaisse;
use App\Entity\User;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\CheckboxType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\PasswordType;
use Symfony\Component\Form\Extension\Core\Type\RepeatedType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\EmailType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Validator\Constraints\IsTrue;
use Symfony\Component\Validator\Constraints\Length;
use Symfony\Component\Validator\Constraints\NotBlank;

class RegistrationFormType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('nom',TextType::class,[
                'label' =>'Nom :',
                'attr' =>[
                    'class' => 'form-control'
                ],
                'required' => true,
                
            ])
            ->add('prenom',TextType::class,[
                'attr' =>[
                    'class' => 'form-control'
                ],
                'required' => true,
                'label' => 'Prenom : ',
            ])

            ->add('responsabilite',TextType::class,[
                'attr' =>[
                    'class' => 'form-control'
                ],
                'required' => true,
                'label' => 'Responsabilite :',
            ])
            ->add('email',EmailType::class,[
                'mapped' =>true,
                'attr' =>[
                    'class' => 'form-control'
                ],
                'required' => true,
                'label' => 'Email :',

            ])
            ->add('agreeTerms', CheckboxType::class, [
                'label' => 'Accepter le condition',
                'mapped' => false,
                'constraints' => [
                    new IsTrue([
                        'message' => 'You should agree to our terms.',
                    ]),
                ],
            ])

            ->add('password', RepeatedType::class, [
                'type' => PasswordType::class,
                'required' => true,
                'mapped' => true,
                'constraints' => new length(30,2),
                'invalid_message' =>"Le mot de passe et la confirmation doivent etre identique",
                'first_options' => [
                    'label' => 'Mot de passe :'
                ],
                'second_options' => [
                    'label' => 'Confirmer mot de passe : '
                    
                ],
                'attr' => ['autocomplete' => 'new-password'],
                'constraints' => [
                    new NotBlank([
                        'message' => 'Please enter a password',
                    ]),
                    new Length([
                        'min' => 6,
                        'minMessage' => 'Your password should be at least {{ limit }} characters',
                        // max length allowed by Symfony for security reasons
                        'max' => 4096,
                    ]),
                ],
                
            ])

            ->add('sexe',ChoiceType::class,[
                'label' => "Sexe : ",
                'choices'=>[ 
                    'Masculin'=>'masculin',
                    'Féminin'=>'féminin',
                ],
            ])
            ->add('agence',EntityType::class,[
                'class' => Agence::class,
                'choice_label' => function($agence){
                    return $agence->getCodeAgence()." ".$agence->getNomAgence();
                },
                'autocomplete' => true,
                'attr' => [
                    'class' => 'border-0',
                ],
                'label' => 'Agence :',
            ])

            ->add('caisse',EntityType::class,[
                'class' => CompteCaisse::class,
                'choice_label' => function($caisse){
                    return $caisse->getCodecaisse()." ".$caisse->getNomCaisse();
                },
                'autocomplete' => true,
                'attr' => [
                    'class' => 'border-0',
                ],
                'label' => 'Compte Caisse :',
            ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => User::class,
        ]);
    }
}
