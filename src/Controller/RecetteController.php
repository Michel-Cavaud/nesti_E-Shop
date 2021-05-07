<?php

namespace App\Controller;

use App\Entity\Recettes;
use App\Entity\Commentaires;
use App\Entity\Utilisateurs;
use App\Repository\ProduitsRepository;
use App\Repository\RecettesRepository;
use Doctrine\ORM\EntityManagerInterface;
use App\Repository\CommentairesRepository;
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

    #[Route('/recette/ajoutcommentaire', name: 'recette_setcommentaire', methods: ['POST'])]
    public function ajoutCommentaire(Request $request, CommentairesRepository $repo)
    {
        if ($request->isMethod('POST')) {
            $titre = $request->request->get('titreCommentaire');
            $contenu = $request->request->get('contenuCommentaire');
            $idRecette = $request->request->get('idRecette');
            $note = $request->request->get('note');
            dd($note);

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
            }

            $response = new Response(json_encode($retour));
            $response->headers->set('Content-Type', 'application/json');
            return $response;
        }
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
