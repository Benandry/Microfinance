<?php

namespace App\Form;

use App\Entity\Agence;
use App\Entity\User;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\CheckboxType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\EmailType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Validator\Constraints\IsTrue;

class UserEditType extends AbstractType
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
            ->add('agence',EntityType::class,[
                'class' => Agence::class,
                'choice_label' => 'NomAgence',
                'autocomplete' => true,
                'label' => 'Agence :'
            ])

            ->add('caisse',EntityType::class,[
                'class' => CompteCaisse::class,
                'choice_label' => function($caisse){
                    return $caisse->getCodecaisse()." ".$caisse->getNomCaisse();
                },
                'label' => false,
                 'multiple' => true,
                 'expanded' => true,
                 'required' => true
            ])
            ->add('sexe',ChoiceType::class,[
                'label' => "Sexe : ",
                'choices'=>[ 
                    'Masculin'=>'masculin',
                    'Féminin'=>'féminin',
                ],
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
