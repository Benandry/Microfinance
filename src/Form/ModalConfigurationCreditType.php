<?php

namespace App\Form;

use App\Entity\ProduitCredit;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class ModalConfigurationCreditType extends AbstractType
{

    private $entityManager;

    public function __construct(EntityManagerInterface $entityManager)
    {
        $this->entityManager=$entityManager;
    }



    public function buildForm(FormBuilderInterface $builder, array $options):void
    {

        $entityManager=$options['em'];
        $query = $entityManager->createQuery(
            'SELECT
            p
            FROM 
            App\Entity\ProduitCredit p
            -- LEFT JOIN
            -- App\Entity\ConfigurationCredit c
            -- WITH
            -- WHERE
            -- p.id = c.IdProduit
            -- c.IdProduit is null
            '
        );

        $builder
        ->add('ProduitCredit',EntityType::class,[
            'class'=>ProduitCredit::class,
            'placeholder'=>'Choisir Produit Credit',
            'choices'=>$query->getResult(),
            'choice_label'=>'NomProduitCredit',
            'autocomplete'=>true
        ]);
        

    
    }

    public function configureOptions(OptionsResolver $resolver):void
    {
        $resolver->setDefaults([
            'em'=>null
        ]);
    }

}