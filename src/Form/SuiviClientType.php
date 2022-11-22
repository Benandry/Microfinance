<?php

namespace App\Form;

use App\Entity\SuiviClient;
use Symfony\Component\Form\Extension\Core\Type\DateType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class SuiviClientType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('DateEntre',DateType::class, [
                'widget' => 'single_text',
                'label'=>'Date validation'])
            ->add('DateSortie',DateType::class, [
                'widget' => 'single_text',
                'label'=>'Date validation'])
            ->add('Utilisateur')
            ->add('menu_utiliser')
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => SuiviClient::class,
        ]);
    }
}
