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

        $recette = $repo->find($id);
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
