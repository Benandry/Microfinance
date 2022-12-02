warning: in the working copy of 'src/Entity/CreditIndividuel.php', LF will be replaced by CRLF the next time Git touches it
warning: in the working copy of 'src/Entity/DemandeCredit.php', LF will be replaced by CRLF the next time Git touches it
warning: in the working copy of 'src/Entity/ProduitCredit.php', LF will be replaced by CRLF the next time Git touches it
warning: in the working copy of 'src/Form/ConfigurationGeneralCreditType.php', LF will be replaced by CRLF the next time Git touches it
warning: in the working copy of 'src/Form/CreditIndividuelType.php', LF will be replaced by CRLF the next time Git touches it
warning: in the working copy of 'src/Form/DemandeCreditType.php', LF will be replaced by CRLF the next time Git touches it
warning: in the working copy of 'src/Repository/CreditIndividuelRepository.php', LF will be replaced by CRLF the next time Git touches it
warning: in the working copy of 'templates/configuration_general_credit/new.html.twig', LF will be replaced by CRLF the next time Git touches it
warning: in the working copy of 'templates/credit_individuel/_form.html.twig', LF will be replaced by CRLF the next time Git touches it
warning: in the working copy of 'templates/demande_credit/_form.html.twig', LF will be replaced by CRLF the next time Git touches it
[1mdiff --git a/assets/api/credit.js b/assets/api/credit.js[m
[1mindex 037f598..a8fe8f0 100644[m
[1m--- a/assets/api/credit.js[m
[1m+++ b/assets/api/credit.js[m
[36m@@ -32,5 +32,38 @@[m [m$(document).ready(function(){[m
                 $('#demande_credit_NumeroCredit').val('G'+codeagence+pad_last_id);[m
             }[m
         })[m
[32m+[m
[32m+[m[32m        // Ici on utilise l'api pour recuperer tous les informatins du configuraion dans[m
[32m+[m[32m        // la base de donnees[m
[32m+[m[41m        [m
[32m+[m[32m        $('#demande_credit_ProduitCredit').on('change',function(){[m
[32m+[m
[32m+[m[32m            var url ='/api/credit/'+$(this).val();[m
[32m+[m
[32m+[m[32m            $.ajax({[m
[32m+[m[32m                url:url,[m
[32m+[m[32m                method:"GET",[m
[32m+[m[32m                dataType:"json",[m
[32m+[m[32m                contentType : "application/json; charset=utf-8",[m
[32m+[m[32m                success : function(result){[m
[32m+[m[32m                    for(let i=0;i<result.length;i++){[m
[32m+[m
[32m+[m[32m                        var element= result[i];[m
[32m+[m
[32m+[m[32m                        console.log(element);[m
[32m+[m
[32m+[m[32m                        // document.getElementById('demande_credit_NombreTranche').innerHTML=parseInt(element.Tranche)[m
[32m+[m[32m                        var tranche=parseInt(element.Tranche);[m
[32m+[m[32m                        var montantminimum=parseInt(element.MontantMinimumCredit)[m
[32m+[m[32m                        var montantmaximum=parseInt(element.MontantMaximumCredit)[m
[32m+[m[32m                        var tauxinteretannuel=parseInt(element.TauxInteretAnnuel)[m
[32m+[m[32m                        console.log(tranche);[m
[32m+[m[32m                        $('#demande_credit_NombreTranche').val(tranche);[m
[32m+[m[32m                        $('#demande_credit_Montant').val('Min: '+montantminimum+' || Max:'+montantmaximum);[m
[32m+[m[32m                        $('#demande_credit_TauxInteretAnnuel').val(tauxinteretannuel + ' %');[m
[32m+[m[32m                    }[m
[32m+[m[32m                }[m
[32m+[m[32m            })[m
[32m+[m[32m        })[m
         [m
 })[m
\ No newline at end of file[m
[1mdiff --git a/src/Entity/CreditIndividuel.php b/src/Entity/CreditIndividuel.php[m
[1mindex 37c291e..ffb584b 100644[m
[1m--- a/src/Entity/CreditIndividuel.php[m
[1m+++ b/src/Entity/CreditIndividuel.php[m
[36m@@ -67,6 +67,9 @@[m [mclass CreditIndividuel[m
     #[ORM\Column][m
     private ?int $PeriodeMaximumCredit = null;[m
 [m
[32m+[m[32m    #[ORM\ManyToOne(inversedBy: 'creditIndividuels')][m
[32m+[m[32m    private ?ProduitCredit $ProduitCredit = null;[m
[32m+[m
     public function getId(): ?int[m
     {[m
         return $this->id;[m
[36m@@ -287,4 +290,16 @@[m [mclass CreditIndividuel[m
 [m
         return $this;[m
     }[m
[32m+[m
[32m+[m[32m    public function getProduitCredit(): ?ProduitCredit[m
[32m+[m[32m    {[m
[32m+[m[32m        return $this->ProduitCredit;[m
[32m+[m[32m    }[m
[32m+[m
[32m+[m[32m    public function setProduitCredit(?ProduitCredit $ProduitCredit): self[m
[32m+[m[32m    {[m
[32m+[m[32m        $this->ProduitCredit = $ProduitCredit;[m
[32m+[m
[32m+[m[32m        return $this;[m
[32m+[m[32m    }[m
 }[m
[1mdiff --git a/src/Entity/DemandeCredit.php b/src/Entity/DemandeCredit.php[m
[1mindex 4adf378..2b24e13 100644[m
[1m--- a/src/Entity/DemandeCredit.php[m
[1m+++ b/src/Entity/DemandeCredit.php[m
[36m@@ -122,6 +122,9 @@[m [mclass DemandeCredit[m
     #[ORM\Column][m
     private ?float $MontantFixeParTranche = null;[m
 [m
[32m+[m[32m    #[ORM\ManyToOne(inversedBy: 'demandeCredits')][m
[32m+[m[32m    private ?ProduitCredit $ProduitCredit = null;[m
[32m+[m
     public function getId(): ?int[m
     {[m
         return $this->id;[m
[36m@@ -563,4 +566,16 @@[m [mclass DemandeCredit[m
     {[m
         return $this->getId();[m
     }[m
[32m+[m
[32m+[m[32m    public function getProduitCredit(): ?ProduitCredit[m
[32m+[m[32m    {[m
[32m+[m[32m        return $this->ProduitCredit;[m
[32m+[m[32m    }[m
[32m+[m
[32m+[m[32m    public function setProduitCredit(?ProduitCredit $ProduitCredit): self[m
[32m+[m[32m    {[m
[32m+[m[32m        $this->ProduitCredit = $ProduitCredit;[m
[32m+[m
[32m+[m[32m        return $this;[m
[32m+[m[32m    }[m
 }[m
[1mdiff --git a/src/Entity/ProduitCredit.php b/src/Entity/ProduitCredit.php[m
[1mindex b2daa84..c51d4d0 100644[m
[1m--- a/src/Entity/ProduitCredit.php[m
[1m+++ b/src/Entity/ProduitCredit.php[m
[36m@@ -24,9 +24,17 @@[m [mclass ProduitCredit[m
     #[ORM\OneToMany(mappedBy: 'ProduitCredit', targetEntity: ConfigurationGeneralCredit::class)][m
     private Collection $configurationGeneralCredits;[m
 [m
[32m+[m[32m    #[ORM\OneToMany(mappedBy: 'ProduitCredit', targetEntity: CreditIndividuel::class)][m
[32m+[m[32m    private Collection $creditIndividuels;[m
[32m+[m
[32m+[m[32m    #[ORM\OneToMany(mappedBy: 'ProduitCredit', targetEntity: DemandeCredit::class)][m
[32m+[m[32m    private Collection $demandeCredits;[m
[32m+[m
     public function __construct()[m
     {[m
         $this->configurationGeneralCredits = new ArrayCollection();[m
[32m+[m[32m        $this->creditIndividuels = new ArrayCollection();[m
[32m+[m[32m        $this->demandeCredits = new ArrayCollection();[m
     }[m
 [m
     public function getId(): ?int[m
[36m@@ -92,4 +100,64 @@[m [mclass ProduitCredit[m
     {[m
         return $this->getId();[m
     }[m
[32m+[m
[32m+[m[32m    /**[m
[32m+[m[32m     * @return Collection<int, CreditIndividuel>[m
[32m+[m[32m     */[m
[32m+[m[32m    public function getCreditIndividuels(): Collection[m
[32m+[m[32m    {[m
[32m+[m[32m        return $this->creditIndividuels;[m
[32m+[m[32m    }[m
[32m+[m
[32m+[m[32m    public function addCreditIndividuel(CreditIndividuel $creditIndividuel): self[m
[32m+[m[32m    {[m
[32m+[m[32m        if (!$this->creditIndividuels->contains($creditIndividuel)) {[m
[32m+[m[32m            $this->creditIndividuels[] = $creditIndividuel;[m
[32m+[m[32m            $creditIndividuel->setProduitCredit($this);[m
[32m+[m[32m        }[m
[32m+[m
[32m+[m[32m        return $this;[m
[32m+[m[32m    }[m
[32m+[m
[32m+[m[32m    public function removeCreditIndividuel(CreditIndividuel $creditIndividuel): self[m
[32m+[m[32m    {[m
[32m+[m[32m        if ($this->creditIndividuels->removeElement($creditIndividuel)) {[m
[32m+[m[32m            // set the owning side to null (unless already changed)[m
[32m+[m[32m            if ($creditIndividuel->getProduitCredit() === $this) {[m
[32m+[m[32m                $creditIndividuel->setProduitCredit(null);[m
[32m+[m[32m            }[m
[32m+[m[32m        }[m
[32m+[m
[32m+[m[32m        return $this;[m
[32m+[m[32m    }[m
[32m+[m
[32m+[m[32m    /**[m
[32m+[m[32m     * @return Collection<int, DemandeCredit>[m
[32m+[m[32m     */[m
[32m+[m[32m    public function getDemandeCredits(): Collection[m
[32m+[m[32m    {[m
[32m+[m[32m        return $this->demandeCredits;[m
[32m+[m[32m    }[m
[32m+[m
[32m+[m[32m    public function addDemandeCredit(DemandeCredit $demandeCredit): self[m
[32m+[m[32m    {[m
[32m+[m[32m        if (!$this->demandeCredits->contains($demandeCredit)) {[m
[32m+[m[32m            $this->demandeCredits[] = $demandeCredit;[m
[32m+[m[32m            $demandeCredit->setProduitCredit($this);[m
[32m+[m[32m        }[m
[32m+[m
[32m+[m[32m        return $this;[m
[32m+[m[32m    }[m
[32m+[m
[32m+[m[32m    public function removeDemandeCredit(DemandeCredit $demandeCredit): self[m
[32m+[m[32m    {[m
[32m+[m[32m        if ($this->demandeCredits->removeElement($demandeCredit)) {[m
[32m+[m[32m            // set the owning side to null (unless already changed)[m
[32m+[m[32m            if ($demandeCredit->getProduitCredit() === $this) {[m
[32m+[m[32m                $demandeCredit->setProduitCredit(null);[m
[32m+[m[32m            }[m
[32m+[m[32m        }[m
[32m+[m
[32m+[m[32m        return $this;[m
[32m+[m[32m    }[m
 }[m
[1mdiff --git a/src/Form/ConfigurationGeneralCreditType.php b/src/Form/ConfigurationGeneralCreditType.php[m
[1mindex e4e76bc..8817b49 100644[m
[1m--- a/src/Form/ConfigurationGeneralCreditType.php[m
[1m+++ b/src/Form/ConfigurationGeneralCreditType.php[m
[36m@@ -3,6 +3,8 @@[m
 namespace App\Form;[m
 [m
 use App\Entity\ConfigurationGeneralCredit;[m
[32m+[m[32muse App\Entity\ProduitCredit;[m
[32m+[m[32muse Symfony\Bridge\Doctrine\Form\Type\EntityType;[m
 use Symfony\Component\Form\AbstractType;[m
 use Symfony\Component\Form\FormBuilderInterface;[m
 use Symfony\Component\OptionsResolver\OptionsResolver;[m
[36m@@ -22,7 +24,13 @@[m [mclass ConfigurationGeneralCreditType extends AbstractType[m
             ->add('ExclurePrdtLimttionDmdeEtDecaissDeuxiemeCrdt')[m
             ->add('AutorisationDecaissementPartiellement')[m
             ->add('AcrivePrioriteRemboursementCredit')[m
[31m-            ->add('ProduitCredit')[m
[32m+[m[32m            ->add('ProduitCredit',EntityType::class,[[m
[32m+[m[32m                'class'=>ProduitCredit::class,[m
[32m+[m[32m                'choice_label'=>'NomProduitCredit',[m
[32m+[m[32m                'mapped'=>true,[m
[32m+[m[32m                'by_reference'=>true,[m
[32m+[m[32m                'placeholder'=>'Produit Credit'[m
[32m+[m[32m            ])[m
             ->add('Devise')[m
         ;[m
     }[m
[1mdiff --git a/src/Form/CreditIndividuelType.php b/src/Form/CreditIndividuelType.php[m
[1mindex f6ffe32..0c48496 100644[m
[1m--- a/src/Form/CreditIndividuelType.php[m
[1m+++ b/src/Form/CreditIndividuelType.php[m
[36m@@ -3,6 +3,8 @@[m
 namespace App\Form;[m
 [m
 use App\Entity\CreditIndividuel;[m
[32m+[m[32muse App\Entity\ProduitCredit;[m
[32m+[m[32muse Symfony\Bridge\Doctrine\Form\Type\EntityType;[m
 use Symfony\Component\Form\AbstractType;[m
 use Symfony\Component\Form\Extension\Core\Type\ChoiceType;[m
 use Symfony\Component\Form\Extension\Core\Type\IntegerType;[m
[36m@@ -14,6 +16,16 @@[m [mclass CreditIndividuelType extends AbstractType[m
     public function buildForm(FormBuilderInterface $builder, array $options): void[m
     {[m
         $builder[m
[32m+[m[32m            ->add('ProduitCredit',EntityType::class,[[m
[32m+[m[32m                'class'=>ProduitCredit::class,[m
[32m+[m[32m                'choice_label'=>'NomProduitCredit',[m
[32m+[m[32m                'mapped'=>true,[m
[32m+[m[32m                'by_reference'=>true,[m
[32m+[m[32m                'attr'=>[[m
[32m+[m[32m                    'class'=>'form-control',[m
[32m+[m[32m                    'placeholder'=>'Produit Credit '[m
[32m+[m[32m                ][m
[32m+[m[32m            ])[m
             ->add('TauxInteretAnnuel',IntegerType::class)[m
             ->add('DifferementPayement',IntegerType::class)[m
             ->add('Tranche',IntegerType::class)[m
[1mdiff --git a/src/Form/DemandeCreditType.php b/src/Form/DemandeCreditType.php[m
[1mindex 7cf9f50..b3a9cae 100644[m
[1m--- a/src/Form/DemandeCreditType.php[m
[1m+++ b/src/Form/DemandeCreditType.php[m
[36m@@ -3,6 +3,7 @@[m
 namespace App\Form;[m
 [m
 use App\Entity\DemandeCredit;[m
[32m+[m[32muse App\Entity\ProduitCredit;[m
 use App\Entity\ProduitEpargne;[m
 use Symfony\Bridge\Doctrine\Form\Type\EntityType;[m
 use Symfony\Component\Form\AbstractType;[m
[36m@@ -71,6 +72,13 @@[m [mclass DemandeCreditType extends AbstractType[m
                 'class'=>ProduitEpargne::class,[m
                 'choice_label'=>'nomproduit'[m
             ])[m
[32m+[m[32m            ->add('ProduitCredit',EntityType::class,[[m
[32m+[m[32m                'class'=>ProduitCredit::class,[m
[32m+[m[32m                'choice_label'=>'NomProduitCredit',[m
[32m+[m[32m                'mapped'=>true,[m
[32m+[m[32m                'by_reference'=>true,[m
[32m+[m[32m                'placeholder'=>'Choisir Produit Credit'[m
[32m+[m[32m            ])[m
         ;[m
     }[m
 [m
[1mdiff --git a/src/Repository/CreditIndividuelRepository.php b/src/Repository/CreditIndividuelRepository.php[m
[1mindex c50018f..2b030a0 100644[m
[1m--- a/src/Repository/CreditIndividuelRepository.php[m
[1m+++ b/src/Repository/CreditIndividuelRepository.php[m
[36m@@ -39,6 +39,66 @@[m [mclass CreditIndividuelRepository extends ServiceEntityRepository[m
         }[m
     }[m
 [m
[32m+[m[32m    // Cette fonction permet de recuperer les informations sur les configuration credit[m
[32m+[m[32m    public function api_configuration($produit){[m
[32m+[m
[32m+[m[32m        $entityManager=$this->getEntityManager();[m
[32m+[m
[32m+[m[32m        $query=$entityManager->createQuery([m
[32m+[m[32m            'SELECT[m[41m [m
[32m+[m[32m            -- credit individuel[m
[32m+[m[32m            creditindividuel.TauxInteretAnnuel,[m
[32m+[m[32m            creditindividuel.DifferementPayement,[m
[32m+[m[32m            creditindividuel.Tranche,[m
[32m+[m[32m            creditindividuel.TypeTranche,[m
[32m+[m[32m            creditindividuel.CalculInteret,[m
[32m+[m[32m            creditindividuel.MontantMaximumCredit,[m
[32m+[m[32m            creditindividuel.MontantMinimumCredit,[m
[32m+[m[32m            creditindividuel.DelaisDeGraceMaxi,[m
[32m+[m[32m            creditindividuel.PaiementPrealableInteret,[m
[32m+[m[32m            creditindividuel.CalculIntertPourDiffere,[m
[32m+[m[32m            creditindividuel.IntaretDifferePaiementCapitalise,[m
[32m+[m[32m            creditindividuel.InteretPayerDiffere,[m
[32m+[m[32m            creditindividuel.TrancheDistinctInteret,[m
[32m+[m[32m            creditindividuel.InteretDeductDecaissement,[m
[32m+[m[32m            creditindividuel.CalculInteretJours,[m
[32m+[m[32m            creditindividuel.ForfaitPaiementPrealableInteret,[m
[32m+[m[32m            creditindividuel.PeriodeMinimumCredit,[m
[32m+[m[32m            creditindividuel.PeriodeMaximumCredit,[m
[32m+[m[32m            -- configuration general[m
[32m+[m[32m            configeneralcredit.ProduitLieEpargne,[m
[32m+[m[32m            configeneralcredit.NombreJourInteretAnnee,[m
[32m+[m[32m            configeneralcredit.NombreSemaineAnnee,[m
[32m+[m[32m            configeneralcredit.ProduitLieEpargne,[m
[32m+[m[32m            configeneralcredit.NombreJourInteretAnnee,[m
[32m+[m[32m            configeneralcredit.NombreSemaineAnnee,[m
[32m+[m[32m            configeneralcredit.RecalculDateEcheanceDecaissement,[m
[32m+[m[32m            configeneralcredit.TauxInteretVariableSoldeDegressif,[m
[32m+[m[32m            configeneralcredit.RecalculInteretRemboursementAmortissementDegressif,[m
[32m+[m[32m            configeneralcredit.MethodeSoldeDegressifComposeCalculInteret,[m
[32m+[m[32m            configeneralcredit.ExclurePrdtLimttionDmdeEtDecaissDeuxiemeCrdt,[m
[32m+[m[32m            configeneralcredit.AutorisationDecaissementPartiellement,[m
[32m+[m[32m            -- produit credit[m
[32m+[m[32m            produitcredit.NomProduitCredit[m
[32m+[m[32m            FROM[m
[32m+[m[32m            App\Entity\CreditIndividuel creditindividuel[m
[32m+[m[32m              INNER JOIN[m
[32m+[m[32m            App\Entity\ConfigurationGeneralCredit configeneralcredit[m
[32m+[m[32m              INNER JOIN[m
[32m+[m[32m            App\Entity\ProduitCredit produitcredit[m
[32m+[m[32m               WITH[m
[32m+[m[32m            produitcredit.id = configeneralcredit.ProduitCredit[m
[32m+[m[32m               AND[m
[32m+[m[32m            produitcredit.id = creditindividuel.ProduitCredit[m
[32m+[m[32m                WHERE[m
[32m+[m[32m             creditindividuel.ProduitCredit= :produit[m
[32m+[m[32m        