<?php

    namespace App\Controller\Credit\Filtrer;

    class Traitement {

        public function filtreApprobation(\DATETIME $date_arreter=null,\DATETIME $date_debut=null,\DATETIME $date_fin=null,$approRepo,string $status): array
        {
            $display_date1 =false;
            $display_date2 =false;

            $listeApprouver = [];

            if ($date_arreter != null) {
            $display_date1 =true;
                $listeApprouver = $approRepo->getDemandeApprouver($date_arreter,$status);
                //dd($listeApprouver);
            }
            elseif ($date_debut !=  null && $date_fin != null ) {
                $display_date2 =true;
                $listeApprouver = $approRepo->getDemandeApprouverDeuxDate($date_debut,$date_fin,$status);
            }
            else{
                $display = false;
            }

            return [
                'liste' => $listeApprouver,
                'date1' => $display_date1,
                'date2' => $display_date2
            ];

        }
    }