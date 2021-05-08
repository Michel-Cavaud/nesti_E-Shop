<?php

namespace App\Controller;

use App\Repository\RecettesRepository;
use App\Repository\CategoriesRepository;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class RecettesController extends AbstractController
{
    protected $data;

    #[Route('/recettes', name: 'recettes')]
    public function index(RecettesRepository $repo, CategoriesRepository $repo2): Response
    {
        $this->data['btnMenu'] = ['text-noir hover:text-cyanclair', 'hover:text-noir text-cyanclair', 'text-noir hover:text-cyanclair'];
        $this->data['LIEN_IMAGES_RECETTES'] = $_ENV['LIEN_IMAGES_RECETTES'];

        $categories = $repo2->findAll();
        $recettes = $repo->findBy(['etatRecettes' => 'a']);
        foreach ($categories as $categorie) {
            $this->data['recettes'][$categorie->getId()] = [];
            foreach ($recettes as $recette) {
                foreach ($recette->getListCategories() as $categorieRecette) {
                    if ($categorieRecette->getIdCategories()->getId() == $categorie->getId()) {
                        $this->data['recettes'][$categorie->getId()][] = $recette;
                    }
                }
            }
        }
        $this->data['categories'] = $categories;

        //dd($this->data);
        return $this->render('recettes/index.html.twig', $this->data);
    }
}
