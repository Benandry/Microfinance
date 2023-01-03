<?php

namespace App\Form;

use App\Entity\Commune;
use App\Repository\CommuneRepository;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\UX\Autocomplete\Form\AsEntityAutocompleteField;
use Symfony\UX\Autocomplete\Form\ParentEntityAutocompleteType;

#[AsEntityAutocompleteField]
class CommuneAutocompleteField extends AbstractType
{
    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'class' => Commune::class,
            'placeholder' => 'Choisissez le nom de commune du client',
            'choice_label' => 'NomCommune',

            'query_builder' => function(CommuneRepository $communeRepository) {
                return $communeRepository->createQueryBuilder('commune');
            },
            //'security' => 'ROLE_SOMETHING',
        ]);
    }

    public function getParent(): string
    {
        return ParentEntityAutocompleteType::class;
    }
}
