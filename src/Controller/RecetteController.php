<?php

namespace App\Controller;

use App\Repository\ProduitsRepository;
use App\Repository\RecettesRepository;
use App\Repository\UnitesDeMesureRepository;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use App\Repository\IngredientsRecettesRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class RecetteController extends AbstractController
{
    protected $data;

    #[Route('/recette/{id<[0-9]+>}', name: 'recette')]
    public function index(int $id, RecettesRepository $repo, IngredientsRecettesRepository $repo2, ProduitsRepository $repo3, UnitesDeMesureRepository $repo4): Response
    {
        $this->data['btnMenu'] = ['text-noir hover:text-cyanclair', 'hover:text-noir text-cyanclair', 'text-noir hover:text-cyanclair'];
        $this->data['LIEN_IMAGES_RECETTES'] = $_ENV['LIEN_IMAGES_RECETTES'];

        $recette = $repo->find($id);
        if ($recette == null || $recette->getEtatRecettes() != 'a') {
            return $this->redirectToRoute('home');
        }
        $recette->setTempsMn($this->formatTempsMn(date_format($recette->getTempsRecettes(), 'H:i')));

        //Ajout ingredients et produits dans la recette
        $ingredents = $repo2->findByidRecettes($recette->getId());
        foreach ($ingredents  as $ingredient) {
            $produit = $repo3->find($ingredient->getIdProduits());
            $recette->addIdProduitsRecette($produit->getNomProduits());

            $unite = $repo4->find($ingredient->getIdUnitesDeMesure());
            //contruit un ingrédient complet aavec quantité, unité et produit ex : 1 kg de farine
            $unIngredient = $ingredient->getQuantiteIngredientsRecette() . ' ' . $unite->getNomUnitesDeMesure() . ' '
                . $produit->getNomProduits();
            $recette->addIdIngredientsRecette($unIngredient);
        }
        $noteUser = [0, 0, 0, 0, 0, 0];
        $total = 0;
        $nbNote = 0;
        $moyenne = 0;
        foreach ($recette->GetDonneUneNotes() as $note) {
            switch ($note->getNoteSur5()) {
                case 1:
                    $noteUser[1]++;
                    $total++;
                    $nbNote++;
                    break;
                case 2:
                    $noteUser[2]++;
                    $total = $total + 2;
                    $nbNote++;
                    break;
                case 3:
                    $noteUser[3]++;
                    $total = $total + 3;
                    $nbNote++;
                    break;
                case 4:
                    $noteUser[4]++;
                    $total = $total + 4;
                    $nbNote++;
                    break;
                case 5:
                    $noteUser[5]++;
                    $total = $total + 5;
                    $nbNote++;
                    break;
                default:
                    break;
            }
        }
        if ($nbNote != 0) {
            $moyenne = $total / $nbNote;
        }

        $this->data['noteUser'] = $noteUser;
        $this->data['moyenne'] = $moyenne;
        $this->data['recette'] = $recette;
        return $this->render('recette/index.html.twig', $this->data);
    }

    /**
     * Temps recette en minute
     *
     * @param string $temps
     * @return temps recette en minutes
     */
    private function formatTempsMn(string $temps): ?string
    {
        $arrayTemps = explode(":", $temps);
        if ($arrayTemps[0] == '00') {
            $retour = $arrayTemps[1];
        } else {
            $retour = $arrayTemps[0] * 60 + $arrayTemps[1];
        }

        return $retour;
    }
}
