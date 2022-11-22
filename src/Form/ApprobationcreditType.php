<?php

namespace App\Form;

use App\Entity\Approbationcredit;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\DateType;
use Symfony\Component\Form\Extension\Core\Type\TextType;

class ApprobationcreditType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('dateap',DateType::class, [
                'widget' => 'single_text',
                'label'=>'Date validation'])
            ->add('description')
            ->add('montantapprouver',TextType::class,[
                'label'=>'Montant approuver',])
            ->add('personneap',TextType::class,[
                'label'=>'Personne approuver',])
            ->add('num_credit',TextType::class,[
                'label'=>'Numero Credit',])
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Approbationcredit::class,
        ]);
    }
}
