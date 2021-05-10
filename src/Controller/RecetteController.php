<?php

namespace App\Controller;

use App\Entity\Recettes;
use App\Entity\Commentaires;
use App\Entity\DonneUneNote;
use App\Entity\Utilisateurs;
use App\Repository\ProduitsRepository;
use App\Repository\RecettesRepository;
use App\Repository\CommentairesRepository;
use App\Repository\DonneUneNoteRepository;
use App\Repository\UnitesDeMesureRepository;
use Symfony\Component\HttpFoundation\Request;
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

    #[Route('/recette/ajoutcommentaire', name: 'recette_setcommentaire', methods: ['POST'])]
    public function ajoutCommentaire(Request $request, CommentairesRepository $repo, DonneUneNoteRepository $repo2)
    {
        if ($request->isMethod('POST')) {
            $titre = $request->request->get('titreCommentaire');
            $contenu = $request->request->get('contenuCommentaire');
            $idRecette = $request->request->get('idRecette');
            $note = $request->request->get('note');

            $retour['success'] = true;
            if ($titre == '') {
                $retour['success'] = false;
                $retour['titreCommentaire'] = true;
            }
            if ($contenu == '') {
                $retour['success'] = false;
                $retour['contenuCommentaire'] = true;
            }
            if ($retour['success']) {

                $commentaire = new Commentaires();
                $commentaire->setTitreCommentaires($titre);
                $commentaire->setContenuCommentaires($contenu);

                $recette = new Recettes();
                $recette->setId($idRecette);
                $commentaire->setIdrecettes($recette);

                $user = new Utilisateurs();
                $user->setId($this->getUser()->getId());
                $commentaire->setIdUtilisateurs($user);

                $repo->insertCommentaires($commentaire);

                if ($note != 0) {
                    $noteObj = new DonneUneNote();
                    $noteObj->setNoteSur5($note);

                    $noteObj->setIdrecettes($recette);

                    $noteObj->setIdUtilisateurs($user);

                    $repo2->insertCommentaires($noteObj);
                }
            }



            $response = new Response(json_encode($retour));
            $response->headers->set('Content-Type', 'application/json');
            return $response;
        }
    }
}
