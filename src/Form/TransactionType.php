<?php

namespace App\Form;

use App\Entity\CompteCaisse;
use App\Entity\Transaction;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\DateType;
use Symfony\Component\Form\Extension\Core\Type\IntegerType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class TransactionType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $user = $this->security->getUser()->getId();
        $em = $options['em'];
        $query = " SELECT 
                c 
                FROM App\Entity\CompteCaisse c
                JOIN c.users u
                WHERE u.id = $user
                ";
        $stmt = $em->createQuery($query)->getResult();
        // dd($stmt);

        $builder
            ->add('compteCaisse',EntityType::class,[
                'class' => CompteCaisse::class,
                'choice_label' => function($caisse){
                    return $caisse->getCodecaisse()." -- ".$caisse->getNomCaisse();
                },
                'placeholder' => "Choisissez le compte caisse ",
                'query_builder'=>function($caisse){
                    return $caisse->createQueryBuilder('c')
                                ->join('c.users','u')
                                ->where('u.id = c.users');
                },
                'label' => "Compte caisse ",
                'autocomplete' => true,
                'attr' => [
                    'class' => 'border-0'
                ]
            ])
            ->add('PieceComptable')
            ->add('typeClient',TextType::class,[
                'attr'=>[
                    'class'=>'form-control'
                ]
            ])
            ->add('DateTransaction',DateType::class,[
                'widget'=>'single_text',
            ])
            ->add('Montant',IntegerType::class,[
                'attr'=>[
                    'class'=>'form-control'
                ],
                'label'=>'Montant',
                ])
            ->add('montant_bruite',IntegerType::class,[
            'label' => "Montant du depot",
            'mapped' => false,
            'attr'=>[
                'class'=>'form-control'
                ]
             ])
            ->add('codeepargneclient',TextType::class,[
                'label'=>'Code client'
            ])

            ->add('solde',TextType::class,[
                'label'=>'Solde de compte'
            ])

            ->add('devise',TextType::class,[
                'label'=>'devise utiliser :',
                'mapped' => false,
            ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Transaction::class,
        ]);
    }
}