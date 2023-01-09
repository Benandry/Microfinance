<?php

namespace App\Form;

use App\Entity\CompteEpargne;
use App\Repository\CompteEpargneRepository;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\UX\Autocomplete\Form\AsEntityAutocompleteField;
use Symfony\UX\Autocomplete\Form\ParentEntityAutocompleteType;

#[AsEntityAutocompleteField]
class CompteEpargneAutocompleteField extends AbstractType
{
    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'class' => CompteEpargne::class,
            'placeholder' => 'Choose a CompteEpargne',
            'choice_label' => 'codeepargne',

            'query_builder' => function(CompteEpargneRepository $compteEpargneRepository) {
                return $compteEpargneRepository->createQueryBuilder('compteEpargne');
            },
            //'security' => 'ROLE_SOMETHING',
        ]);
    }

    public function getParent(): string
    {
        return ParentEntityAutocompleteType::class;
    }
}
