<?php

namespace App\Controller;

use App\Repository\ArticlesRepository;
use App\Repository\ProduitsRepository;
use App\Repository\RecettesRepository;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use App\Repository\IngredientsRecettesRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class ArticleController extends AbstractController
{

    protected $data;

    #[Route('/article/{id<[0-9]+>}', name: 'article')]
    public function index(int $id, ArticlesRepository $repo, RecettesRepository $repo2, IngredientsRecettesRepository $repo3, ProduitsRepository $repo4): Response
    {
        $this->data['btnMenu'] = ['text-noir hover:text-cyanclair', 'text-noir hover:text-cyanclair', 'hover:text-noir text-cyanclair'];
        $this->data['LIEN_IMAGES_RECETTES'] = $_ENV['LIEN_IMAGES_RECETTES'];

        $article = $repo->find($id);
        if ($article == null || $article->getEtatArticles() != 'a') {
            return $this->redirectToRoute('articles');
        }

        $this->data['recettes'] = [];
        $recettes = $repo2->findBy(['etatRecettes' => 'a']);
        //Ajout produits dans la recette
        foreach ($recettes as $recette) {
            $ingredents = $repo3->findByidRecettes($recette->getId());
            foreach ($ingredents  as $ingredient) {
                $produit = $repo4->find($ingredient->getIdProduits());
                if ($article->getidProduits()->getId() == $produit->getId()) {
                    $this->data['recettes'][] = $recette;
                }
            }
        }

        $this->data['article'] = $article;
        return $this->render('article/index.html.twig', $this->data);
    }
}
