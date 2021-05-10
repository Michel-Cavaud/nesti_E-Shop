<?php

namespace App\Controller;

use App\Repository\ProduitsRepository;
use App\Repository\RecettesRepository;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use App\Repository\IngredientsRecettesRepository;
use Symfony\Component\Serializer\SerializerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class HomeController extends AbstractController
{
    protected $data;

    /**
     * @Route("/", name="home")
     */

    //#[Route('/', name: 'home')]
    public function index(SerializerInterface $serializer, RecettesRepository $repo, IngredientsRecettesRepository $repo2, ProduitsRepository $repo3): Response
    {

        $this->data['btnMenu'] = ['hover:text-noir text-cyanclair', 'text-noir hover:text-cyanclair', 'text-noir hover:text-cyanclair'];
        $this->data['LIEN_IMAGES_RECETTES'] = $_ENV['LIEN_IMAGES_RECETTES'];

        $recettes = $repo->findBy(['etatRecettes' => 'a']);

        //Ajout produits dans la recette
        foreach ($recettes as $recette) {
            $ingredents = $repo2->findByidRecettes($recette->getId());
            foreach ($ingredents  as $ingredient) {
                $produit = $repo3->find($ingredient->getIdProduits());
                $recette->addIdProduitsRecette($produit->getNomProduits());
            }
        }
        //créer le json
        $this->data['jsonContent'] = $serializer->serialize($recettes, 'json', ['groups' => 'json_recette']);
        $this->data['recettes'] = $recettes;

        return $this->render('home/index.html.twig', $this->data);
    }
}
